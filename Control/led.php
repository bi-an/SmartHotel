<?php
   $roomno  = $_GET[roomno];
   $title = "房灯开关";
   include '../header.php';
   $mysql = SaeDB::getInstance();

    //获取light对应的中文名
   $sql = "SELECT * FROM  z_devicename";
   $data = $mysql->getData( $sql );
   $device = array();
   foreach ($data as $no=>$array){
        $key=$array['Ename'];
        $value=$array['Cname'];
        $device[$key]=$value;   
   }

   //连主库
   $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
   mysql_select_db(SAE_MYSQL_DB,$link);
   
//    $sql=mysql_query("select led_living,led_toilet,led_bedroom,led_bedside,led_entrance from z_roomstate  where room_id = $roomno",$link);
   $sql=mysql_query("select * from z_roomstate  where room_id = $roomno",$link);
   $results = array();
   $row=mysql_fetch_assoc($sql);
   foreach ($row as $key => $value){
       if(strstr($key,'led')){
           $results[$key] = $value;
       }
   }
  

  mysql_close($link);
?>


<!--     <link rel="stylesheet" type="text/css" href="./themes/metro/easyui.css">   -->
<!--     <link rel="stylesheet" type="text/css" href="./themes/mobile.css">   -->
    <link rel="stylesheet" type="text/css" href="./themes/icon.css">  
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
			       <!-- <a href="#" class="easyui-linkbutton m-back"  onclick= "rback()"  data-options="plain:true,outline:true,back:false">返回</a>  -->
	               <a href="#" class="menuItem fa fa-home fa-2x" onclick= "rback()"></a>
	               <a href="#" class="menuItem fa fa-refresh fa-2x refresh" onclick= "refresh()"></a>
	               
				</div>
				<div class="m-title"> 房灯开关</div>
			</div>
		</header>
		
           <footer>
            <div class="m-buttongroup m-buttongroup-justified" style="width:100%;">
            
          </div>
        </footer> 
		<form action="ledsave.php" method="post"> 
       	<ul id="list" class="m-list">
       		<p id = "tt3"></p>      
         </ul>
         <br><br>
          <input type="hidden" name="roomno" value="<?php echo $roomno;?>"/>
          <input type="submit" class="send" style="margin:0 0 0 30%;"/> 
          </form>
            
	</div>
    
  
    	<script type="text/javascript"> 
             
             var roomno = '<?php echo $roomno; ?>' ; 
       
              var data= <?php echo json_encode($results);?>; //***注意不要用引号,如果用了json存储的数组就成字符串了。另外如果有键名要以对象的形式弹出如readpoint.id 
              
			var  lednum;
             
             $(function() 
             {
                 show();
                 setInterval("getLEDInfo()",1000);  
             });
            
             var get_count = 0;
             
             function getLEDInfo()
             {
               if(get_count < 10)
                   get_count++;
               if(get_count==1){
                   refresh(); 
               }              		
            }

            function show()
            {               
                $("#tt3").html("");
            
                var str = '';
                <?php foreach ($results as $key => $value){if($value==1){?>
                str="<li class='radioSpan'><span><font  size='3px' color='blue'><?php echo $device[$key];?></font></span><input style= 'margin-left:60px'  type='radio' name='<?php echo $key;?>'  value='1' checked>开 <input  style= 'margin-left:40px' type='radio' name='<?php echo $key;?>'  value='0' >关 </li>";
                <?php }else{?> 
                str="<li class='radioSpan'><span><font  size='3px' color='blue'><?php echo $device[$key];?></font></span><input style= 'margin-left:60px'  type='radio' name='<?php echo $key;?>'  value='1' >开 <input  style= 'margin-left:40px' type='radio' name='<?php echo $key;?>'  value='0' checked>关 </li>";
                <?php }?>
                $("#tt3").append(str);    <?php }?>            
            }
               
            function rback()
	        {
			    window.location="index.php"; 
			}
             
            
            function refresh()
            {
//                 $.ajax({
//                          type: "GET",
//                          url: "ledinfo.php",
//                          data: "roomno="+roomno,
//                          success: function(flag)
//                          {
//                              show();   
//                          }
//                   }); 
            	show();
            }
          
        </script>       
</body>	
</html>
