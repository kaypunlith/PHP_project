<?php
   $cn=new mysqli("localhost","root","","php");
     $id=$_POST['txt-id'];
    $name =$_POST['txt-name']; 
    $od =$_POST['txt-od'];
    $status=$_POST['txt-status'];
    $img=$_POST['txt-photo'];
    $name_link="name_link";
    $editid=$_POST['edit-id'];
    $msg['dpl']=false;
    $msg['edit']=false;
    $sql="SELECT * FROM tbl_menu WHERE name='$name' && id!=$id";
    $res=$cn->query($sql);
    if($num=$res->num_rows>0){
        $msg['dpl']=true;
    }else{
       if($editid==0){
        $sql="INSERT INTO tbl_menu VALUES(null,'$name','$img','$od','$name_link','$status')";
        $cn->query($sql);
        $msg['id']=$cn->insert_id;
       }else{
        $sql="UPDATE tbl_menu SET name_link='$name_link',name='$name',img='$img',od='$od',status='$status' 
        WHERE id='$editid'";
        $cn->query($sql);
        $msg['edit']=true;
       }   
    }

    echo json_encode($msg);
?>