<? defined("_ACCESS_") or die('Restricted access'); ?>
<?
/**
 * @version		1.0
 * @package		HonoWeb->HonoCart
 * @.
 * @Website		.您好
 */
 ?>
<table class='search_container' width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5" height="6" class="box_top_left"><img src="<?=$SETUPFOLDER?>/images/box_top_left.gif" /></td>
    <td    class="box_top_bg">&nbsp;</td>
    <td width="5"  class="box_top_right"></td>
  </tr>
  <tr>
    <td  class="box_left">&nbsp;</td>
    <td class="search_td">

    	  <script language="javascript">
             
                function checkSearch() {
                    var form=document.getElementById("form1");
                   if(form.keyword.value=="")
                    {
                        alert("Please enter your keyword!");
                        form.keyword.focus();
                        return;
                    }
                    
                   form.action='<?=$SETUPFOLDER."/".$dispatch_page?>?menuid=206&level=2';
				   form.submit();
				   
			}
                
            </script>
     	<link href="<?=$SETUPFOLDER?>/modules/product_search/css/style.css" rel="stylesheet" type="text/css">
		<div class="product_search_com_mod_search">
             <div class="product_search_com_mod_search_Title">产品搜索</div>
              <div class="product_search_com_mod_search_line"></div>
             <div class="product_search_com_mod_search_Box">
             <p>
                 关键字
                   <input class="search_keyword_box" type="text"  name='keyword' id="keyword" value="<?=$keyword?>" />
             </p>
             <span><input type="button"  class="search_button" value="搜索" onclick="checkSearch()" />
             </span>
             <br />
             </div>
            
        </div>
    </td>
    <td  class="box_right">&nbsp;</td>
  </tr>
  <tr>
    <td height="6" class="box_bottom_left"></td>
    <td  class="box_bottom_bg">&nbsp;</td>
    <td class="box_bottom_right"></td>
  </tr>
</table>