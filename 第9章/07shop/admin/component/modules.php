<? include "../../db/Connect.php"?>
<? include "../../include/authorizemanager.php"?>
<?
/**
 * @version		1.0
 * @package		HonoWeb->HonoCMS
 * @copyright	Copyright (C) HonoWeb. All rights reserved.
 * @Website		www.honoweb.com.
 */
 ?>
<?
	
	$status=$_POST['status'];
	if($status=="remove")
	{
	    
		$sql="select count(1) as num from ".$TableModules."  where pid=".$id;
	    $row=$db->getRow($sql);
		$b=false;
		if(!empty($row[num]))
		{
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
			echo "<script language='javascript'>alert('this modules has submodules,please remove submodules first!');</script>";
			$b=true;
		}
		if($b==false)
		{
			 $sql="delete from ".$TableModules."  where id=".$id;
	    	$query=$db->query($sql);
		}
	}
	

?>
<html>
<head>
<title><?=$TitleName?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../css/css.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../js/check.js"></script>
<link href="../../css/date.css" rel="stylesheet" type="text/css">
<script src="../../js/ShowDate.js"></script>
<script language="javascript">
    init();
</script>
</head>
<body>
<form name="form1" method="post" >
  <table border="0" cellpadding="0"  cellspacing="0" class="firsttable">
    <tr>
      <td align="center" valign="top">
	  	<table   class="centertable">
      		<tr>
            	<td>&nbsp;
            	</td>
       		</tr>
        	<tr>
       		  <td align="center" valign="top">
				  <table class="containContentsTable">
              			<tr >
           				  <td colspan="2" > </td>
       				    </tr>
              			<tr>
              			  <td colspan="2"><input name="button" type='button' class='button' onClick="javascript:add()" value='添加'></td>
              			</tr>
              			<tr>
               				 <td colspan="2">
								 <?
									$sql="select * from ".$TableModules."  where pid=0 order by id " ;
									$query=$db->query($sql);
									$sql1="select  * from  ".$TableModules." where pid<>0  order by id " ;
									$result=$db->getAll($sql1);
									
									echo "<table  class='contentsTable'  border='0'  cellpadding='0'  cellspacing='1' >";
									echo "<tr class='tr1' align=center ><td >模块名称</td><td >描述</td><td >转发页面</td><td width=18%>访问权限</td><td width=20%>&nbsp;</td></tr>";
									while($object=$db->fetch_object($query))
									{
										$levelStr="";
										$level_num=1;
										echo "<tr   onMouseOver=\"old_bg=this.getAttribute('bgcolor');this.setAttribute('bgcolor', '".$T_Bgcolor[1]."', 0);\" onMouseOut=\"this.setAttribute('bgcolor', old_bg, 0);\" bgColor='".$T_Bgcolor[2]."'  align=center>";
										//echo "<td >".$object->id."</td>";
										echo "<td align='left'><input  style='display:none;'  type='checkbox' name=checkvalue value='$object->id'>$object->module_name</td>";
										echo "<td >".$object->description."</td>";
										echo "<td >".$T_Dispach[$object->dispach_page]."</td>";
										echo "<td >".$T_Access_Level[$object->access_level]."</td>";
										echo "<td align=center><a   href='javascript:remove($object->id)'>删除</a> <a href='javascript:edit($object->id)'>修改</a> <a href='modulesstyle.php?id=".$object->id."'>编辑样式</a></td></tr>";
										for($i=0;$i<count($result);$i++)
										{
											for($j=0;$j<$level_num;$j++)
												$levelStr.="----";
											if($object->id==$result[$i][pid])
											{
												echo "<tr   onMouseOver=\"old_bg=this.getAttribute('bgcolor');this.setAttribute('bgcolor', '".$T_Bgcolor[1]."', 0);\" onMouseOut=\"this.setAttribute('bgcolor', old_bg, 0);\" bgColor='".$T_Bgcolor[2]."'  align=center>";
												//echo "<td >".$result[$i][id]."</td>";
												echo "<td  align='left'>".$levelStr."<input style='display:none;'  type='checkbox' name=checkvalue value='".$result[$i][id]."'>".$result[$i]['module_name']."</td>";
												echo "<td >".$result[$i][description]."</td>";
												echo "<td >".$T_Dispach[$result[$i][dispach_page]]."</td>";
												echo "<td >".$T_Access_Level[$result[$i][access_level]]."</td>";
												echo "<td align=center><a   href='javascript:remove(".$result[$i][id].")'>删除</a> <a href='javascript:edit(".$result[$i][id].")'>修改</a> <a href='modulesstyle.php?id=".$result[$i][id]."'>编辑样式</a></td></tr>";
												subCategory($result,$result[$i][id]);
											}
											$levelStr="";
										}
									}
									echo "</table>";
									function subCategory($result,$id)
									{
										global $level_num,$T_Dispach;
										$level_num++;
										
										for($i=0;$i<count($result);$i++)
										{
											$levelStr="";
											for($j=0;$j<$level_num;$j++)
												$levelStr.="----";
											if($id==$result[$i][pid])
											{
												echo "<tr class='tr2' align=center>";
												//echo "<td >".$result[$i][id]."</td>";
												echo "<td  align='left'>".$levelStr."<input style='display:none;'  type='checkbox' name=checkvalue value='".$result[$i][id]."'>".$result[$i]['module_name']."</td>";
												echo "<td >".$result[$i][description]."</td>";
												echo "<td >".$T_Dispach[$result[$i][dispach_page]]."</td>";
												echo "<td >".$T_Access_Level[$result[$i][access_level]]."</td>";
												echo "<td align=center><a   href='javascript:remove(".$result[$i][id].")'>删除</a> <a href='javascript:edit(".$result[$i][id].")'>修改</a> <a href='modulesstyle.php?id=".$result[$i][id]."'>编辑样式</a></td></tr>";
												subCategory($result,$result[$i][id]);
												$levelStr="";
											}
										}
										$level_num--;
									}
									
								?>                			        </td>
              			</tr>
              			<tr>
						<td><input type='button' class='button' onClick="javascript:add()" value='添加'></td>
						<td align="right">&nbsp;</td>
              			</tr>
                      </table>
			  </td>
                  </tr>
				<tr>
                    <td></td>
				</tr>
              </table>
	      </td>
      </tr>
</table>
  <input type="hidden" name="status" value="">
  <input type="hidden" name="page" value=<?=$page?>>
  <input type="hidden" name="totalpage" value=<?=$page_num?>>
   <input type="hidden" name="id" value="">
   <input type="hidden" name="ids" value="">
      <input type="hidden" name="modulesid" value="">
</form>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
	function checkBoxAll()//全选
	{
		var form = form1;
		for(i=0; i<form.elements.length; i++)
		{
			if(form.elements[i].type=="checkbox" &&  form.elements[i].name=="checkvalue")
			{
				form.elements[i].checked = form.cboAll.checked;
			}
		}
	}

	function edit(id){
		var form=form1;
		location="modulesedit.php?id="+id;
	}

	function look(id){
		var form=form1;
		location="moduleslook.php?id="+id;
	}
	
	function remove(id){
		if(confirm("真的想要删除吗?")==true){
			var form=form1;
			form.id.value=id;
			form.status.value="remove";
			form.submit();
		}
	}
	
	 function editSortid(id){
  		var form=form1;
  		form.id.value=id;
		obj_description=document.getElementById("description_"+id);
		if(!isIntegerPlus(obj_description.value))
		{
			alert("Description 必须为整数r!");
			obj_description.focus();
			return;
		}
		form.status.value="statusSortid";
		form.submit();
  }
  
  function show(){
  	var form=form1;
  	
  	for(i=0; i<form.elements.length; i++)
    {
        if(form.elements[i].type=="checkbox" &&  form.elements[i].name=="checkvalue")
        {
                if(form.elements[i].checked==true)
		   {
			form.ids.value+=form.elements[i].value+".";
		   }
        }
    }
	if(form.ids.value=="")
    {
		alert("请选择一条记录!!");
		return;
	}
	form.status.value="show";
	form.submit();
  }
  
   function unshow(){
  	var form=form1;
  	
  	for(i=0; i<form.elements.length; i++)
    {
        if(form.elements[i].type=="checkbox" &&  form.elements[i].name=="checkvalue")
        {
                if(form.elements[i].checked==true)
		   {
			form.ids.value+=form.elements[i].value+".";
		   }
        }
    }
	if(form.ids.value=="")
    {
		alert("请选择记录!");
		return;
	}
	form.status.value="unshow";
	form.submit();
  }

  function config(modulesid){
     var form=form1;
     form.modulesid.value=modulesid;
	form.action="menu_modules.php";
	form.submit();
  }
  
	function removeSelect(){
		var form=form1;
		for(i=0; i<form.elements.length; i++)
		{
			if(form.elements[i].type=="checkbox" &&  form.elements[i].name=="checkvalue")
			{
				if(form.elements[i].checked==true)
				{
					form.ids.value+=form.elements[i].value+".";
				}
			}
		}
		if(form.ids.value=="")
		{
			alert("请选择记录!");
			return;
		}
		if(confirm("真的想要删除吗?")==false)
			return;
		form.status.value="removeSelect";
		form.submit();
	}

	function add(){
		location="modulesadd.php";
	}

	function query()
	{
		var form=form1;
		form.submit();
	}

	function first()
	{
		var form=form1;
		if(eval(form.page.value)==1)
			return;
		form.page.value=1;
		form.submit();
	}

	function next()
	{
		var form=form1;
		if(eval(form.page.value)>=eval(form.totalpage.value))
			return;
		form.page.value=eval(form.page.value)+1;
		form.submit();
	}

	function last()
	{
		var form=form1;
		if(eval(form.page.value)==eval(form.totalpage.value))
			return;
		form.page.value=eval(form.totalpage.value);
		form.submit();
	}

	function pre()
	{
		var form=form1;
		if(form.page.value<=1)
			return;
		form.page.value=eval(form.page.value)-1;
		form.submit();
	}

	function  goposition()
	{
		var form=form1;
		form.page.value=form.position.value;
		form.submit();
	}
</script>
<? $db->close_db();?>
 

