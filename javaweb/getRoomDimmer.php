   
   <?php

          $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
          mysql_select_db(SAE_MYSQL_DB,$link);
          $sql=mysql_query("select roomno,dimmerId,showState,execute from t_roomdimmer where execute='1' ");
          $row=mysql_fetch_row($sql);
          
          if($row==false)
               echo "start.000.0.0.0";
          else
          {
              $roomno = $row[0];
              $id     = $row[1];
              echo "start.",$row[0].".",$row[1].".",$row[2].".",$row[3];
              $sql = mysql_query("update t_roomdimmer set execute = '0' where roomno = $roomno and dimmerId = $id ",$link);    
          }
          
          
          mysql_close($link);
    ?>