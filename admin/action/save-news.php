<?php
   $cn=new mysqli("localhost","root","","php");
   $menu = $_POST['txt-menu'];
   $title = $_POST['txt-title'];
   $img = $_POST['txt-photo'];
   $des = $_POST['txt-des'];
   $od = $_POST['txt-od'];
   $click = 0;
   $uid   = 0;
   $post_date = date("Y-m-d h:i:sa");
   $name_link =preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u","-",$name);
   $status = $_POST['txt-status'];
   $sql="INSERT INTO tbl_news VALUES (null,'$menu','$title','$img','$des','$od','$click','$uid','$post_date','$name_link','$status')";
    $cn->query($sql);
    $result['id']=$cn->insert_id;
    $result['postdata']=$post_date;
    echo json_encode($result)
?>
