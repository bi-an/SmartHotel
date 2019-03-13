<?php
   $roomno  = $_GET[roomno];
   $title = "空调遥控";
   include '../header.php';
   $mysql = SaeDB::getInstance();

   //连主库
   $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
   mysql_select_db(SAE_MYSQL_DB,$link);
   
   $sql = mysql_query("update z_roomstate set execute = '1' where room_id = $roomno",$link);     

   $sql=mysql_query("select air_id from z_roomstate  where room_id = $roomno",$link);
   $row=mysql_fetch_assoc($sql);
   $airid = $row['air_id'];
   
   $sql = mysql_query("update z_roomair set execute = '1' where air_id = $airid",$link);
   $sql=mysql_query("select * from z_roomair where air_id = $airid",$link);
   $airmenu=mysql_fetch_assoc($sql);
   
    mysql_close($link);
?>


<link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>
<link type="text/css" rel="stylesheet" href="css/air.css" />      
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
               <a class="menuItem fa fa-home fa-2x" onclick= "rback()"></a>
               <a class="menuItem fa fa-refresh fa-2x" onclick= "refresh()" style="float:right"></a>   
    		</div>
    	</div>
    </header>
    		
    <div id="screen">
        <div id="airheader">   </div> 
        <div>
            <span id="swing-lr"></span><span id="swing-ud"></span>
            <span id="sleep"></span>         
            <span id="temp"></span>
            <span id="model"></span>
        </div>
        <div id="echelon-left"><span id="fan_speed"></span></div>
        
    </div>
    
    <div id="push-button">
        <div><button onclick="handler('switch')" style="margin:60px 0 0 20%;width:60px;border-radius:50%;">开/关</button><button onclick="handler('model')" style="margin-left:20%;width:60px;border-radius:50%;">模式</button></div>
        <div><button onclick="handler('+')" style="margin:20px 0 0 33%;width:40px">+</button><button onclick="handler('-')" style="margin-left:5%;width:40px;">-</button></div>
        <div><button onclick="handler('swing')" style="margin:20px 0 20px 21%;border-radius:5px;">扫风</button><button onclick="handler('fan-speed')" style="margin:20px 0 20px 7%;border-radius:30%;">风速</button>
            <button onclick="handler('sleep')" style="margin:20px 0 20px 6%;border-radius:30%;">睡眠</button></div>
    </div>
    		
    <footer>
        <div class="m-buttongroup m-buttongroup-justified" style="width:100%;">
        </div>
    </footer> 
             
</div>
    
  
<script type="text/javascript"> 
             
     var airid = '<?php echo $airid;?>' ;
	
	var data=Array();  
	<?php foreach ($airmenu as $key => $value){?>
		data['<?php echo $key;?>'] = '<?php echo $value;?>';
    <?php }?>
	
     $(function() 
     {
         show();
         setInterval("getAirInfo()",1000);
     });
     
     function changeStr(nIndex)
     {
 		var strList = new Array();	
 		strList.push("<div id=\"echelon1\"></div>");
 		strList.push("<div id=\"echelon1\"></div><div id=\"echelon2\"></div>");
 		strList.push("<div id=\"echelon1\"></div><div id=\"echelon2\"></div><div id=\"echelon3\"></div>");
 		
 		$("#fan_speed").html(strList[nIndex%strList.length]);
     } 
   	
     var get_count = 0;
     
     function getAirInfo()
     {
       if(get_count < 10)
           get_count++;
       if(get_count==1){
           refresh(); 
       }              		
     }

    function show()
    {               
        $("#swing-lr").html("");
        $("#swing-ud").html("");
        $("#sleep").html("");
        $("#temp").html("");
        $("#model").html("");
        $("#fan_speed").html("");

        var str = "";
		if (data['state']==0){
   		}else {
   			if (data['model']=='cold'){
				str = "<i class=\"fa fa-snowflake-o fa-lg\" aria-hidden=\"true\"></i>";
   			}else if (data['model']=='heat'){
				str = "<i class=\"fa fa-sun-o fa-lg\" aria-hidden=\"true\"></i>";
   			}else if (data['model']=='auto'){
       			str = "<i class=\"fa fa-recycle fa-lg\" aria-hidden=\"true\"></i>";
   			}else{
				str = "<i class=\"fa fa-tint fa-lg\" aria-hidden=\"true\"></i>";
   			}
   			$("#model").append(str);  
   					

   			if (data['sleep']==1){
				str = "<i class=\"fa fa-moon-o fa-lg\" aria-hidden=\"true\"></i>";
   			}else {
				str = "";
   			}
			$("#sleep").append(str);       			

			str = "<span id='number'>"+data['temp']+"</span><span id='degree'>&#8451;</span>";
			$("#temp").append(str);
   		
			if (data['air_swing']=='left_right'){
				str="<i class=\"fa fa-exchange fa-lg\" aria-hidden=\"true\"></i>";
    			$("#swing-lr").append(str);
			}
			if (data['air_swing']=='up_down'){
				str="<i class=\"fa fa-long-arrow-up fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-long-arrow-down fa-lg\" aria-hidden=\"true\"></i>";
				$("#swing-ud").append(str);
			}			
   			if (data['air_swing']=='auto'){
   				var str1="",str2="";
				str1="<i class=\"fa fa-exchange fa-lg\" aria-hidden=\"true\"></i>";
				str2="<i class=\"fa fa-long-arrow-up fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-long-arrow-down fa-lg\" aria-hidden=\"true\"></i>";
    			$("#swing-lr").append(str1);
				$("#swing-ud").append(str2);
   	   		}

   			if (data['fan_speed']=='auto'){
   	   			var nIndex = 0;
   				objTimer = window.setInterval(function(){
   					if (data['fan_speed']=='auto' && data['state']==1){
   		          		changeStr(nIndex);
   		          		nIndex++;
   					}else {
   		         	 	clearInterval(objTimer);	
   		         	 	show();
   					}
   	          	},2000); 
   			}else if (data['fan_speed']=='strong'){
				str = "<div id=\"echelon1\"></div><div id=\"echelon2\"></div><div id=\"echelon3\"></div>";
				$("#fan_speed").append(str);
   			}else if (data['fan_speed']=='medium'){
				str = "<div id=\"echelon1\"></div><div id=\"echelon2\"></div>";
				$("#fan_speed").append(str);
   			}else{
				str = "<div id=\"echelon1\"></div>";
				$("#fan_speed").append(str);
   			}
    	}
    }
       
    function rback()
    {
	    window.location="index.php"; 
	}
     
    
    function refresh()
    {
        $.ajax({
                 type: "GET",
                 url: "airinfo.php",
                 data: "airid="+airid,
                 success: function(flag)
                 {
                	 flagObj = JSON.parse( flag );
                	 data['state'] = flagObj.state;
                	 data['sleep'] = flagObj.sleep;
                	 data['temp'] = flagObj.temp;
                	 data['model'] = flagObj.model;
                	 data['air_swing'] = flagObj.air_swing;
                	 data['fan_speed'] = flagObj.fan_speed;
                     show(); 
                 }
          }); 
    }

    function handler(handle)
    {
		if(handle == 'switch'){
			if(data['state'] == 0){
				$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,state:1}
				});
         		refresh();
			}else{
				$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,state:0}
				});
         		refresh();
			}
		}

		if(handle == 'model'){
			if(data['model']=='auto'){
				$.ajax({
                     type: "POST",
                     async:false,
                     url: "airsave.php",
                     data: {airid:airid,model:'cold'}
				});
          		refresh();
			}else if(data['model']=='cold'){
				$.ajax({
                     type: "POST",
                     async:false,
                     url: "airsave.php",
                     data: {airid:airid,model:'heat'}
          		}); 
          		refresh();
			}else if(data['model']=='heat'){
				$.ajax({
                     type: "POST",
                     async:false,
                     url: "airsave.php",
                     data: {airid:airid,model:'dry'}
          		}); 
          		refresh();
			}else {
				$.ajax({
                     type: "POST",
                     async:false,
                     url: "airsave.php",
                     data: {airid:airid,model:'auto'}
          		}); 
          		refresh();
			}
		}

		if(handle=='+'){
			if(data['temp']!=30){
    			var temp=++data['temp'];
    			$.ajax({
                    type: "POST",
                    async:false, 
                    url: "airsave.php",
                    data: {airid:airid,temp:temp}
    			});
         		refresh();
			}
		}

		if(handle=="-"){
			if(data['temp']!=16){
    			var temp=--data['temp'];
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,temp:temp}
    			});
         		refresh();
			}
		}

		if(handle=="swing"){
			if(data['air_swing']=='up_down'){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,air_swing:"left_right"}
    			});
         		refresh();
			}else if(data['air_swing']=='left_right'){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,air_swing:"auto"}
    			});
         		refresh();
			}else {
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,air_swing:"up_down"}
    			});
         		refresh();
			}
		}

		if(handle=="fan-speed"){
			if(data['fan_speed']=='weak'){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,fan_speed:'medium'}
    			});
         		refresh();
			}else if(data['fan_speed']=='medium'){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,fan_speed:'strong'}
    			});
         		refresh();	
			}else if(data['fan_speed']=="strong"){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,fan_speed:'auto'}
    			});
         		refresh();
			}else {
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,fan_speed:'weak'}
    			});
         		refresh();
			}
		}

		if(handle=="sleep"){
			if(data['sleep']==1){
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,sleep:0}
    			});
         		refresh();
			}else {
    			$.ajax({
                    type: "POST",
                    async:false,
                    url: "airsave.php",
                    data: {airid:airid,sleep:1}
    			});
         		refresh();
			}
		}
    }

 
</script>       
</body>	
</html>

