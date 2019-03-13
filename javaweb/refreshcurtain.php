   <?php

          $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
          mysql_select_db(SAE_MYSQL_DB,$link);
          $sql=mysql_query("select roomno,execute from t_refreshcurtain");
          $row=mysql_fetch_row($sql);
          if($row==false)
              echo"Not Found!";

          do
          {
             echo $row[0],$row[1];
          
          }   while($row=mysql_fetch_row($sql));
          $sql = mysql_query("update t_refreshcurtain set execute = '0' where execute = '1' ",$link);     
          mysql_close($link);
 
           
    ?>