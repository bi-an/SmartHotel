   
   <?php

          $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
          mysql_select_db(SAE_MYSQL_DB,$link);
          $sql=mysql_query("select roomno,nums,status,execute from t_roomcurtain where execute='1' ");
          $row=mysql_fetch_row($sql);
          
          if($row==false)
               echo "start.000.0.0.0";
          else
          {
              $roomno = $row[0];
              echo "start.",$row[0].".",$row[1].".",$row[2].".",$row[3];
              $sql = mysql_query("update t_roomcurtain set execute = '0' where roomno = $roomno ",$link);    
          }
          
          
          mysql_close($link);
    ?>

