<?php 
   $cn=new mysqli("localhost","root","","php");
   $cn->set_charset("utf8");
   $s=$_POST['s'];
   $e=$_POST['e'];
   $Opt=$_POST['Opt'];
   //count data
   $sqlTotal="SELECT COUNT(*) AS total FROM tbl_news";
   $rsTotal=$cn->query($sqlTotal);
   $rowTotal=$rsTotal->fetch_array();
   $totla=$rowTotal[0];
   if($Opt=='search'){ //check condtion if search data
      $searchVal=$_POST['searchVal'];
      $searchFld=explode(",",trim($_POST['searchFld']));//convert to aray
      $fld=$searchFld[0];
      $optor=$searchFld[1];
      $con="$fld=$searchVal";  //check condition if cliend check data by id
      if($optor== "LIKE"){//check condition if cliend check data by name
         $con=$fld. ' LIKE ' ."'%$searchVal%'";
      }
      $sqlTotal="SELECT COUNT(*) AS total FROM tbl_news 
      INNER JOIN tbl_menu ON tbl_menu.id = tbl_news.menu_id WHERE $con"; //join table menu and news to finde total in table news
      $sql="SELECT tbl_news.id,tbl_news.post_date,tbl_menu.name,tbl_news.title,
      tbl_news.od,tbl_news.click,tbl_news.uid,tbl_news.status FROM tbl_news INNER JOIN tbl_menu ON tbl_menu.id=tbl_news.menu_id 
       WHERE $con  ORDER BY id DESC LIMIT $s,$e";  //join table menu and news to search data
   }else{
      $sql="SELECT tbl_news.id,tbl_news.post_date,tbl_menu.name,tbl_news.title,
      tbl_news.od,tbl_news.click,tbl_news.uid,tbl_news.status FROM tbl_news INNER JOIN tbl_menu ON tbl_menu.id=tbl_news.menu_id
       ORDER BY tbl_news.id DESC LIMIT $s,$e";// join table for select data form tbl_menu and news

   }
  //select data
   $res=$cn->query($sql);
   $data=array();
   if($res->num_rows>0){
    while($row=$res->fetch_array()){
        // select data json data
         $data[]=array(
            "id"=>$row[0],
            "postdate"  => date('d-M-Y h:iA',strtotime($row[1])),
            "menu"=>$row[2],
            "title"=>$row[3],
            "od"=>$row[4],
            "click"=>$row[5],
            "uid"=>$row[6],
            "status"=>$row[7],
            "total"=>$totla,
         );
    }
   }
   echo json_encode($data);
?>