<?php
       $roomno  = $_GET[roomno];
       // 连主库
       $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
       mysql_select_db(SAE_MYSQL_DB,$link);
       $sql=mysql_query("select sos,clean_room,silence,ask_service,check_out from z_roomservice where room_id = $roomno ");
       $row=mysql_fetch_row($sql);
       $soshelp  = $row[0];
       $cleanroom = $row[1];       
       $silence = $row[2];       
       $askservice = $row[3];
       $checkout = $row[4];
       mysql_close($link);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">  
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>酒店客控</title>  
    <link rel="stylesheet" type="text/css" href="./themes/metro/easyui.css">  
    <link rel="stylesheet" type="text/css" href="./themes/mobile.css">  
    <link rel="stylesheet" type="text/css" href="./themes/icon.css">  
     <link rel="stylesheet" type="text/css" href="./themes/color.css"> 
    <script type="text/javascript" src="./js/jquery.min.js"></script>  
    <script type="text/javascript" src="./js/jquery.easyui.min.js"></script> 
    <script type="text/javascript" src="./js/jquery.easyui.mobile.js"></script> 
</head>
<body>
	    <div id="p2" class="easyui-navpanel" >
		<header>
			<div class="m-toolbar">
				<div class="m-right">
					<a href="#" class="easyui-linkbutton m-back"  onclick= "rback()"  data-options="plain:true,outline:true,back:true">返回</a>
				</div>
				<div class="m-title">服务呼叫</div>
			</div>
		</header>
		<ul class="m-list" style="height:40px" >
		   <li>
					<span><font  size="3px" color="blue"> 请即清理</font></span>
				<div class="m-right"><input id="cleanroom" class="easyui-switchbutton"></div>
			</li>
			<li>
				<span><font  size="3px" color="blue"> 请勿打扰</font></span>
				<div class="m-right"><input id="silence" class="easyui-switchbutton"  data-options="checked:true"></div>
			</li>
		    <li>
				<span><font  size="3px" color="blue"> 请求服务</font></span>
				<div class="m-right"><input id="askservice" class="easyui-switchbutton"></div>
			</li>
			<li>
				<span><font  size="3px" color="blue"> 退房请求</font></span>
                <div class='m-right'><input id='checkout' class='easyui-switchbutton'></div>
                  
			</li>
			
            <li>
				<span><font  size="3px" color="red"> 紧急呼救</font></span>
				<div class="m-right"><input id="soshelp" class="easyui-switchbutton"  data-options="checked:false"></div>
			</li>
           
          </ul>
            
	</div>
    
    	<script type="text/javascript"> 
              var roomno = '<?php echo $roomno;?>' ;
           
              $(function()
               {   
					show();
                  
                   var checkout = <?php echo $checkout; ?> ;
                   var onOff1;
                   if(checkout=='1')
                       onOff1 = true;
                   else
                       onOff1 = false;
                   $('#checkout').switchbutton({  
                                                 checked: onOff1,  
                                                 onChange: function(checked)
                                                 {  
                                                   if (checked == true)
                                                   {  
                                                       $.ajax({
                                                                type: "POST",
                                                                url: "servicesave.php",
                                                                data: {"roomno":roomno,"checkout":1},
                                                                success: function(msg)
                                                                {
                                                                      //alert(msg);
                                                                }
                                                             }); 
                                                    }  
                                                   if (checked == false)
                                                   {  
                                                        $.ajax({
                                                                 type: "POST",
                                                                 url: "servicesave.php",
                                                                 data: {"roomno":roomno,"checkout":0},
                                                                 success: function(msg)
                                                                 {
                                                                    //alert(msg);
                                                                 }
                                                              }); 
                                                   }
                                                 }  
                                             })  
              
                   var cleanroom = <?php echo $cleanroom; ?> ;
                   var onOff2;
                   if(cleanroom=='1')
                       onOff2 = true;
                   else
                       onOff2 = false;
                   $('#cleanroom').switchbutton({  
                                                 checked: onOff2,  
                                                 onChange: function(checked)
                                                 {  
                                                   if (checked == true)
                                                   {  
                                                       $.ajax({
                                                                type: "POST",
                                                                url: "servicesave.php",
                                                                data: {"roomno":roomno,"cleanroom":1},
                                                                success: function(msg)
                                                                {
                                                                     // alert(msg);
                                                                }
                                                             }); 
                                                    }  
                                                   if (checked == false)
                                                   {  
                                                        $.ajax({
                                                                 type: "POST",
                                                                 url: "servicesave.php",
                                                                 data: {"roomno":roomno,"cleanroom":0},
                                                                 success: function(msg)
                                                                 {
                                                                   // alert(msg);
                                                                 }
                                                              }); 
                                                   }
                                                 }  
                                             })  
                  
                  
                   
                   var silence = <?php echo $silence; ?> ;
                   var onOff4;
                   if(silence=='1')
                       onOff4 = true;
                   else
                       onOff4 = false;
                   $('#silence').switchbutton({  
                                                 checked: onOff4,  
                                                 onChange: function(checked)
                                                 {  
                                                   if (checked == true)
                                                   {  
                                                       $.ajax({
                                                                type: "POST",
                                                                url: "servicesave.php",
                                                                data: {"roomno":roomno,"silence":1},
                                                                success: function(msg)
                                                                {
                                                                     //alert(msg);
                                                                }
                                                             }); 
                                                    }  
                                                   if (checked == false)
                                                   {  
                                                        $.ajax({
                                                                 type: "POST",
                                                                 url: "servicesave.php",
                                                                 data: {"roomno":roomno,"silence":0},
                                                                 success: function(msg)
                                                                 {
                                                                   //alert(msg);
                                                                 }
                                                              }); 
                                                   }
                                                 }  
                                             })  
                   
                   var askservice = <?php echo $askservice; ?> ;
                   var onOff5;
                   if(askservice=='1')
                       onOff5 = true;
                   else
                       onOff5 = false;
                   $('#askservice').switchbutton({  
                                                 checked: onOff5,  
                                                 onChange: function(checked)
                                                 {  
                                                   if (checked == true)
                                                   {  
                                                       $.ajax({
                                                                type: "POST",
                                                                url: "servicesave.php",
                                                                data: {"roomno":roomno,"askservice":1},
                                                                success: function(msg)
                                                                {
                                                                   //   alert(msg);
                                                                }
                                                             }); 
                                                    }  
                                                   if (checked == false)
                                                   {  
                                                        $.ajax({
                                                                 type: "POST",
                                                                 url: "servicesave.php",
                                                                 data: {"roomno":roomno,"askservice":0},
                                                                 success: function(msg)
                                                                 {
                                                                   // alert(msg);
                                                                 }
                                                              }); 
                                                   }
                                                 }  
                                             })  
                  var soshelp = <?php echo $soshelp; ?> ;
                   var onOff6;
                   if(soshelp=='1')
                       onOff6 = true;
                   else
                       onOff6 = false;
                   $('#soshelp').switchbutton({  
                                                 checked: onOff6,  
                                                 onChange: function(checked)
                                                 {  
                                                   if (checked == true)
                                                   {  
                                                       $.ajax({
                                                                type: "POST",
                                                                url: "servicesave.php",
                                                                data: {roomno:roomno,soshelp:1},
                                                                success: function(msg)
                                                                {
                                                                     //alert(msg);                                                                    
                                                                }
                                                             }); 
                                                    }  
                                                   if (checked == false)
                                                   {  
                                                        $.ajax({
                                                                 type: "POST",
                                                                 url: "servicesave.php",
                                                                 data: {roomno:roomno,soshelp:0},
                                                                 success: function(msg)
                                                                 {
                                                                    //alert(msg);
                                                                 }
                                                              }); 
                                                   }
                                                 }  
                                             })  
               
               })               
             
              function rback()
	         {
			    window.location="index.php?roomno="+roomno; 
			 }

              function show()
              {
				if(soshelp == 1){
					$("#soshelp").attr("data-options","checked:true");
				}else {
					$("#soshelp").attr("data-options","checked:false");
				}
				if(cleanroom == 1){
					$("#cleanroom").prop("checked",true);
				}else {
					$("#cleanroom").prop("checked",false);
				}
				if(silence == 1){
					$("#silence").attr("checked","checked");
				}else {
					$("#silence").attr("checked","");
				}	
				if(askservice){
					$("#askservice").attr("checked","checked");
				}else {
					$("#askservice").attr("checked","");
				}
				if(checkout){
					$("#checkout").attr("checked","checked");
				}else {
					$("#checkout").attr("checked","");
				}
              }
            
        </script>       
</body>	
</html>
