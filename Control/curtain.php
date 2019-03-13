<?php
   $roomno  = $_GET[roomno];
   $title = "窗帘控制";
   include '../header.php';
   $mysql = SaeDB::getInstance();

   //连主库
   $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
   mysql_select_db(SAE_MYSQL_DB,$link);
   
   $sql = mysql_query("update z_roomstate set execute = '1' where room_id = $roomno",$link);     

   $sql=mysql_query("select curtain from z_roomstate  where room_id = $roomno",$link);
   $row=mysql_fetch_assoc($sql);
  
  mysql_close($link);
?>


    <link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="css/led.css"/>
       
    <link rel="stylesheet" type="text/css" href="./themes/color.css"> 
    <script type="text/javascript" src="./js/jquery.min.js"></script>  
    <script type="text/javascript" src="./js/jquery.easyui.min.js"></script> 
    <script type="text/javascript" src="./js/jquery.easyui.mobile.js"></script> 
</head>
<body>
	    <div id="p1" class="easyui-navpanel" >
		<header>
			<div class="m-toolbar">
				<div class="m-right">
	               <a href="#" class="menuItem fa fa-home fa-2x" onclick= "rback()"></a>
	               <a href="#" class="menuItem fa fa-refresh fa-2x refresh" onclick= "refresh()"></a>
	               
				</div>
				<div class="m-title">窗帘控制</div>
			</div>
		</header>
		
           <footer>
            <div class="m-buttongroup m-buttongroup-justified" style="width:100%;">
            
          </div>
        </footer> 
		<form action="curtainsave.php" method="post"> 
       	<ul id="list" class="m-list">
       		<p id = "curtain"></p>      
         </ul>
         <br><br>
          <input type="hidden" name="roomno" value="<?php echo $roomno;?>"/>
          <input type="submit" class="send" style="margin:0 0 0 30%;"/> 
          </form>
            
	</div>
    
  
    	<script type="text/javascript"> 
             
             var roomno = <?php echo $roomno; ?> ;  
			 var data = <?php echo $row['curtain'];?> ;
                     
             $(function() 
             {
                 show();
                 setInterval("getCurtainInfo()",1000);  
             });
            
             var get_count = 0;
             
             function getCurtainInfo()
             {
               if(get_count < 10)
                   get_count++;
               if(get_count==1){
                   refresh(); 
               }              		
            }

            function show()
            {               
                $("#curtain").html("");
            
                var str = '';
				if(data == 1)
                	str = "<li><span><input type='radio' name='curtainstate' value='1' checked/>开</span><span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='2'/>停<span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='0'/>关</li>";
				else if(data == 0)
                	str = "<li><span><input type='radio' name='curtainstate' value='1'/>开</span><span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='2'/>停<span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='0' checked/>关</li>";
				else
                	str = "<li><span><input type='radio' name='curtainstate' value='1'/>开</span><span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='2' checked/>停<span><input style= 'margin-left:60px' type='radio' name='curtainstate' value='0'/>关</li>";
                $("#curtain").append(str);     
            }
               
            function rback()
	        {
			    window.location="index.php"; 
			}
             
            
            function refresh()
            {
                $.ajax({
                         type: "GET",
                         url: "curtaininfo.php",
                         data: "roomno="+roomno,
                         success: function(flag)
                         {
// 						     data = flag;
                             show();   
                         }
                  }); 
            }
          
        </script>       
</body>	
</html>
