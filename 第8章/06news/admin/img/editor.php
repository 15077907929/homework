<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$img_list=$db->get_one("select * from $met_img where id='$id'");
if(!$img_list){
okinfo('index.php',$lang[noid]);
}
$query = "SELECT * FROM $met_parameter where type=5 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}

$class1=$img_list[class1];
if($img_list[new_ok]==1)$new_ok="checked='checked'";
if($img_list[com_ok]==1)$com_ok="checked='checked'";
$class2[$img_list[class2]]="selected='selected'";
if($img_list[class3]!=0){
$query ="select * from $met_column where bigclass=$img_list[class2] order by no_order";
$result = $db->query($query);
while($class3_r= $db->fetch_array($result)){
$class3_list[]=$class3_r;
}
}
$class3[$img_list[class3]]="selected='selected'";

    $class2_ok=FALSE;
    $query = "SELECT * FROM $met_column where module=5 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 if($list[id]==$class1){$class1_name=$list[c_name];}
     if($list[bigclass]==$class1){
	 $column_list2[]=$list;
	 $class2_ok=TRUE;
	 }
	if($list[bigclass]!=0) $column_list[]=$list;
    }
	$i=0;
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
foreach($column_list as $key=>$vallist){
echo "subcat[".$i."] = new Array('".$vallist[c_name]."','".$vallist[bigclass]."','".$vallist[id]."');\n";
	 $i=$i+1;
}
echo "onecount=".$i.";\n";
echo "</script>";

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('img_editor');
footer();
?>