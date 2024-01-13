<?php 
   $cn=new mysqli("localhost","root","","php");
   $tbl=array(
     "2"=>"tbl_menu",
     "3"=>"tbl_news"
   );
   $frm=$_POST['tbl'];
    $sql = "SELECT id FROM ".$tbl[$frm]." ORDER BY id DESC";
    $res = $cn->query($sql);
    $msg['id']=0;
    if( $res->num_rows > 0 ){
        $row = $res->fetch_array();
        $msg['id'] = $row[0];
    }
   echo json_encode($msg);
?>