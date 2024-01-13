<?php 
   $cn=new mysqli("localhost","root","","php");
   $cn->set_charset("utf8");
   $s=$_POST['s'];
   $e=$_POST['e'];
   $Opt=$_POST['Opt'];
   //count data
   $sqlTotal="SELECT COUNT(*) AS total FROM tbl_menu";
   $rsTotal=$cn->query($sqlTotal);
   $rowTotal=$rsTotal->fetch_array();
   $totla=$rowTotal[0];
   if($Opt=='search'){
      $searchVal=$_POST['searchVal'];
      $searchFld=explode(",",trim($_POST['searchFld']));//convert to aray
      $fld=$searchFld[0];
      $optor=$searchFld[1];
      $con="$fld=$searchVal";
      if($optor== "LIKE"){
         $con=$fld. ' LIKE ' ."'%$searchVal%'";
      }
      $sqlTotal="SELECT COUNT(*) AS total FROM tbl_menu WHERE $con";
      $sql="SELECT * FROM tbl_menu WHERE $con  ORDER BY id DESC LIMIT $s,$e";
   }else{
      $sql="SELECT * FROM tbl_menu ORDER BY id DESC LIMIT $s,$e";
   }
  //select data

   $res=$cn->query($sql);
   $data=array();
   if($res->num_rows>0){
    while($row=$res->fetch_array()){
         $data[]=array(
            "id"=>$row[0],
            "name"=>$row[1],
            "img"=>$row[2],
            "od"=>$row[3],
            "status"=>$row[5],
            "total"=>$totla,
         );
    }
   }
   echo json_encode($data);
?>