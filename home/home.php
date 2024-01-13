<!DOCTYPE html>
<?php 
     $cn = new mysqli("localhost","root","","php");
     $cn->set_charset("utf8");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../home/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
     <div class="container-fluid menu-box">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 menu">
                    <ul>
                    <li>
                      <a href="">Home</a>
                    </li>
                       <?php 
                        $sql="SELECT * FROM tbl_menu WHERE status=1 ORDER BY od DESC";
                        $res=$cn->query($sql);
                        while($row=$res->fetch_array()){
                            ?>
                               <li>
                                    <a href=""><?php echo $row[1]?></a>
                                </li>      
                            <?php
                        }
                       ?>
                    </ul>
                </div>
            </div>
        </div>
     </div>
</body>
</html>