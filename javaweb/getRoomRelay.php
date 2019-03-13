   <?php

          $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
          mysql_select_db(SAE_MYSQL_DB,$link);
          $sql=mysql_query("select roomno,ledstatus,lednums,execute from t_roomled");
          $row=mysql_fetch_row($sql);
          if($row==false)
              echo"Not Found!";

          do
          {
             echo "start.",$row[0].".",$row[1].".",$row[2].".",$row[3];
          
          }   while($row=mysql_fetch_row($sql));
          $sql = mysql_query("update t_roomled set execute = '0' where execute = '1' ",$link);     
          mysql_close($link);
 
           
    ?>