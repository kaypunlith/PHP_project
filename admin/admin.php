
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin 1.0</title>
    <link rel="stylesheet" href="icon/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
</head>
<body>
    <div class='bar1'>
        <div class='btn-menu'>

        </div>
        <div class='page-title'>
            Rean Web
        </div>
        <div class='user-box'>
            <span>Punlith</span>
            <i class="fas fa-sign-out-alt"></i>
        </div>
    </div>
    <div class="left-menu">
        <ul>
            <li>
                <a href="">
                <i class="fa-solid fa-users"></i>
                    User
                </a>
                <div class="sub-menu">
                    <ul>
                        <li>
                            <a href="">User list</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="">
                <i class="fa-solid fa-gear"></i>
                    Setup
                </a>
                <div class="sub-menu">
                <ul>
                    <li data-frm="2">
                        <a>Menu list</a>
                    </li>
                    <li data-frm="3">
                        <a data="3">News list</a>
                    </li>
                    <li data-frm="4">
                        <a>Ads list</a>
                    </li>
                </ul>
                </div>
               
            </li>
        </ul>
    </div>
    <div class='data-container'>
        <div class='container-2'>
            <ul>
                <li class='btn btn-1' id='btn-add'>
                    <i class="fas fa-plus"></i> Add
                </li>
            </ul>
            <ul class='search-box'>
                <li>
                    <input type="text" name="txt-search-val" id="txt-search-val">
                </li>
                <li>
                    <select name="txt-search" id="txt-search">
                        <option value="0"></option>
                        <!-- <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="status">Status</option> -->
                    </select>
                </li>
                <li class='btn-search'>
                    <i class='fas fa-search'></i>
                </li>
               
            </ul>
            <ul class='page-box'>
                <li class='btn btn-2 limit-box'>
                    <select name="" id="limit-data-box">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                </li>
                <li class='btn btn-2' id="btnBack">
                    <i class='fas fa-arrow-left'></i>
                </li>
                <li class='btn'>
                    <span id='curPage'>0</span> / <span id="totalPage">0</span> of <span id="totalItem">0</span>
                </li>
                <li class='btn btn-2' id="btnNext">
                    <i class='fas fa-arrow-right'></i>
                </li>
            </ul>
        </div>
        <table id='tblData' class='tblData'></table>
    </div>

</body>
  <script src="js/action.js">
   
  </script>
</html>