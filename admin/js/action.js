$(document).ready(function(){
    var tblData = $('#tblData');
    var body = $('body');
    var loading = "<div class='loading'><i class='fa fa-spinner fa-spin'></i><br>Loading...</div>";
    var popup = "<div class='popup'>"+loading+"</div>";
    var frm = {
        "2":'frm-menu.php',
        "3":'frm-news.php',
    
    };
    var frmNo=2;
    var btnAction = "<input type='button' value='Edit' class='btnEdit'>";
    var s=0;
    var e=$('#limit-data-box').val();
    var curPage = $('#curPage');
    var totalPage =$('#totalPage');
    var totalItem = $('#totalItem');
    var txtsearchval=$("#txt-search-val");
    var box_search=$("#txt-search");
    var Opt='no';
    var trInd;
    var search_fiel={
       '2':{
        'id,=':'ID',
        'name,LIKE':'Name',
        'status,=':'Status'
       },
       '3':{
        'tbl_news.id,=':'ID',
        'tbl_news.name,LIKE':'Menu',
        'tbl_news.title,LIKE':'Title',
        'tbl_news.status,':'Status'
       }
    }
    //open form
    $('#btn-add').click(function(){
        body.append(popup);
        $(".popup").load("form/"+frm[frmNo], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find('.frm .head span').text( $('.page-title').text() );
                get_last_id();
                
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
     //close form
body.on('click','.frm #btnClose',function(){
    $('.popup').last().remove();
});
//show data
$('.sub-menu').on('click','li',function(){
    Opt='no';
    // alert(123);
    curPage.text(1);
    s=0
    var eThis = $(this);
    $('#btn-add').show();
    frmNo = eThis.data('frm');
    var title = eThis.find('a').text();
    $('.container-2').show();
    $('.page-title').text( title);
    var txt="<option value='0'></option>"
    for(optVal in search_fiel[frmNo]){
       txt+="<option value="+optVal+">"+search_fiel[frmNo][optVal]+"</option>"
    }
    // var optVal="<option value='id'>ID</option>"+
    //             "<option value='id'>Name</option>";
    ;
    box_search.html(txt);
    
    if(frmNo == 2){
        get_menu_list();
    }else if(frmNo == 3){
        get_news_list();
    }
   
});
//search data
$(".btn-search").click(function(){
    Opt='search';
    if(box_search.val()==0){
        alert(123);
        return;
    }else{
        if(txtsearchval.val()==''){
            txtsearchval.focus();
            return;
        }
    }
    if(frmNo == 2){
        get_menu_list();
    }else if(frmNo == 3){
        get_news_list();
    }
})
body.on('click','.frm .btn-save',function(){  
    var eThis = $(this);
    if(frmNo == 2){
        save_menu(eThis);
    }else if(frmNo == 3){
        save_news(eThis);
    }
});
//limit data
$("#limit-data-box").change(function(){
    e=$(this).val();
    if(frmNo == 2){
        get_menu_list();
    }else if(frmNo == 3){
        get_news_list();
    }
})
//btn next
$("#btnNext").click(function(){
    if(curPage.text()==totalPage.text()){
        alert("You can not click");
        return;
    }
     curPage.text(parseInt(curPage.text())+1)
      s=parseInt(s)+parseInt(e);
      if(frmNo == 2){
        get_menu_list();
    }else if(frmNo == 3){
        get_news_list();
    }
})
//btn back
$("#btnBack").click(function(){
    if(curPage.text()==1){
        return;
    }
     curPage.text(parseInt(curPage.text())-1)
      s=parseInt(s)-parseInt(e);
      if(frmNo == 2){
        get_menu_list();
    }else if(frmNo == 3){
        get_news_list();
    }
})
//save menu
function save_menu(eThis){
    var Parent = eThis.parents('.frm');
    var id = Parent.find('#txt-id');
    var name = Parent.find('#txt-name');
    var od = Parent.find('#txt-od');
    var photo = Parent.find('#txt-photo');
    var status = Parent.find('#txt-status');
    var imgBox = Parent.find('.img-box');
    var frm = eThis.closest('form.upl');
    var frm_data = new FormData(frm[0]);
    if(name.val() == ''){
        alert("Please input name");
        name.focus();
        return;
    }
    $.ajax({
        url:'action/save-menu.php',
        type:'POST',
        data:frm_data,
        contentType:false,
        cache:false,
        processData:false,
        dataType:"json",
        beforeSend:function(){
            body.append(popup);
        },
        success:function(data){ 
            if(data.dpl==true){
                alert("DPL name");
                name.focus();
                $('.popup').last().remove();
            }else{
              if(data.edit==true){
                tblData.find('tr:eq('+trInd+') td:eq(1)').text(name.val());
                tblData.find('tr:eq('+trInd+') td:eq(2) img').attr("src","img/"+photo.val());
                tblData.find('tr:eq('+trInd+') td:eq(3)').text(od.val());
                tblData.find('tr:eq('+trInd+') td:eq(4)').text(status.val());

              }else{
                var tr="<tr>"+
                    `<td>${data.id}</td>`+
                    `<td>${name.val()}</td>`+
                    `<td>
                        <img src="img/${photo.val()}" alt="${photo.val()}">
                     </td>`+
                    `<td>${od.val()}</td>`+
                    `<td>${status.val()}</td>`+
                    `<td>${btnAction}</td>`+
                "</tr>";
                tblData.find("tr:eq(0)").after(tr);  
                id.val(data.id+1);
                od.val(data.id+1);
                name.val('');
                name.focus();
                photo.val('');
               imgBox.css({"background-image":"url(img/plachoder.png)"});
              }
            }
            $('.popup').last().remove();
        }				
    }); 
}
//save new
function save_news(eThis){
       var Parent = eThis.parents('.frm');
        var id = Parent.find('#txt-id');
        var mid = Parent.find('#txt-menu');
        var mame = Parent.find('#txt-menu option:selected').text();
        var title = Parent.find('#txt-title');
        var od = Parent.find('#txt-od');
        var photo = Parent.find('#txt-photo');
        var status = Parent.find('#txt-status');
        var imgBox = Parent.find('.img-box');
        var des = Parent.find('#txt-des');
        if(mid.val()==0){
            alert("Please Select Menu");
            mid.focus();
            return;
        }else if(title.val()==''){
            alert("Please Enter Title");
            title.focus();
            return;
        }else if(photo.val()==''){
            alert("Please Add Photo.");
            return;
        }else if(des.val()==''){
            alert("Please Enter Description.");
            return;
        }
    var frm = eThis.closest('form.upl');
    var frm_data = new FormData(frm[0]);
    $.ajax({
        url:'action/save-news.php',
        type:'POST',
        data:frm_data,
        contentType:false,
        cache:false,
        processData:false,
        dataType:"json",
        beforeSend:function(){
        },
        success:function(data){ 
            var tr = "<tr>"+
            "<td>"+data.id+"</td>"+  
            "<td>"+data.postdata+"</td>"+ 
            "<td><span class='none'>"+mid.val()+"</span>"+mame+"</td>"+ 
            "<td>"+title.val()+"</td>"+ 
            "<td>"+od.val()+"</td>"+ 
            "<td>0</td>"+ 
            "<td>1</td>"+ 
            "<td>"+status.val()+"</td>"+ 
            "<td>"+btnAction+"</td>"+   
        "</tr>";
            tblData.find('tr:eq(0)').after(tr);
            id.val(data.$result+1);   
            mid.val(0);
            title.val('');
            des.val('');
            photo.val('');
            imgBox.css({"background-image":"url(style/bg-img.png)"});
            $('.popup').last().remove(); 
        }				
    }); 
 }

 //get last id
 function get_last_id(){
    $.ajax({
        url:'action/save-last-id.php',
        type:'POST',
        data:{'tbl':frmNo},
        // contentType:false,
        cache:false,
        // processData:false,
         dataType:"json",
        beforeSend:function(){

        },
        success:function(data){ 
            body.find(".frm #txt-id").val(parseInt(data.id)+1);
            body.find(".frm #txt-od").val(parseInt(data.id)+1);
        }			
    }); 
 }
//  get menu list
 function get_menu_list(){
    var trHead="<tr>"+
                "<th width='100'>ID</th>"+
                "<th>Name</th>"+
                "<th width='100'>Photo</th>"+
                "<th width='100'>OD</th>"+
                "<th width='100'>Status</th>"+
                "<th width='100'>Action</th>"+
            "</tr>";
            tblData.html(trHead);
    $.ajax({
        url:'action/get-menu-json.php',
        type:'POST',
        data:{'s':s,'e':e,'searchFld':box_search.val(),'searchVal':txtsearchval.val(),'Opt':Opt},
        // contentType:false,
        cache:false,
        // processData:false,
         dataType:"json",
        beforeSend:function(){
            body.append(popup);  
        },
        success:function(data){ 
            if(data.length==0){
                alert('No data');
                $('.popup').last().remove(); 
                return;

            }
            var txt='';
            for( i of data){
                txt+=`
                   <tr>
                      <td>${i.id}</td>
                      <td>${i.name}</td>
                      <td><img src="img/${i.img}" alt="${i.img}"></td>
                      <td>${i.od}</td>
                      <td>${i.status}</td>
                      <td>${btnAction}<td>
                   </tr>
                `
               
            }
            totalItem.text(data[0]['total']);
            totalPage.text(Math.ceil((data[0]['total'])/$("#limit-data-box").val()));
            tblData.html(trHead + txt);
            $('.popup').last().remove(); 
           
        }				
    }); 
}
function get_news_list(){
    var trHead="<tr>"+
            "<th width='50'>ID</th>"+
            "<th width='180'>PostDate</th>"+
            "<th width='150'>Menu</th>"+
            "<th>Title</th>"+
            "<th width='50'>OD</th>"+
            "<th width='50'>Click</th>"+
            "<th width='50'>UID</th>"+
            "<th width='50'>Status</th>"+
            "<th width='50'>Action</th>"+
        "</tr>";
            tblData.html(trHead);
            $.ajax({
                url:'action/get-news-json.php',
                type:'POST',
                data:{'s':s,'e':e,'searchFld':box_search.val(),'searchVal':txtsearchval.val(),'Opt':Opt},
                // contentType:false,
                cache:false,
                // processData:false,
                 dataType:"json",
                beforeSend:function(){
                    body.append(popup);  
                },
                success:function(data){ 
                    if(data.length==0){
                        alert('No data');
                        $('.popup').last().remove(); 
                        return;
        
                    }
                    var txt='';
                    for( i of data){
                        txt+=`
                           <tr>
                              <td>${i.id}</td>
                              <td>${i.postdate}</td>
                              <td>${i.menu}</td>
                              <td>${i.title}</td>
                              <td>${i.od}</td>
                              <td>${i.click}</td>
                              <td>${i.uid}</td>
                              <td>${i.status}</td>
                              <td>${btnAction}<td>
                           </tr>
                        `
                       
                    }
                    totalItem.text(data[0]['total']);
                    totalPage.text(Math.ceil((data[0]['total'])/$("#limit-data-box").val()));
                    tblData.html(trHead + txt);
                    $('.popup').last().remove(); 
                   
                }				
            }); 
}
body.on('click','table tr td .btnEdit',function(){
    var Parent=$(this).parents("tr");
    body.append(popup);
    $(".popup").load("form/"+frm[frmNo], function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                body.find('.frm .head span').text( $('.page-title').text() );
                if(frmNo == 2){
                    edit_menu_list(Parent);
                }else if(frmNo == 3){
                    edit_news_list(Parent);
                }
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
}) 
function edit_menu_list(Parent){
   var id=Parent.find("td:eq(0)").text().trim();
   var name=Parent.find("td:eq(1)").text().trim();
   var photo=Parent.find("td:eq(2) img").attr('alt');
    var od=Parent.find("td:eq(3)").text().trim();
    var status=Parent.find("td:eq(4)").text().trim();
    body.find(".frm #edit-id").val(id);
    body.find(".frm #txt-id").val(id);
    body.find(".frm #txt-name").val(name);
    body.find(".frm #txt-photo").val(photo);
    body.find(".frm #txt-od").val(od);
    body.find(".frm #txt-status").val(status);
    body.find(".frm .img-box").css({"background-image":"url(img/"+photo+")"})
    trInd=Parent.index();
}
function edit_news_list(){
   
}
   
 // upload img to server
    body.on("change",".frm .txt-file",function(){
    var eThis=$(this);
     var Parent = eThis.parents('.frm');
    var imgBox = Parent.find('.img-box');
    var photo=Parent.find("#txt-photo");
    var eThis=$(this);
    var frm = eThis.closest('form.upl');
    var frm_data = new FormData(frm[0]);
    $.ajax({
        url:'action/save-img.php',
        type:'POST',
        data:frm_data,
        contentType:false,
        cache:false,
        processData:false,
        dataType:"json",
        beforeSend:function(){
            body.append(popup);
        },
        success:function(data){ 
            photo.val(data.imgPath);
            $('.popup').last().remove();
              imgBox.css({"background-image":"url(img/"+data.imgPath+")"});
        }				
    }); 
 })
    
})