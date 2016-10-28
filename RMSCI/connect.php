<?php

mysql_connect("", "", "") or 
    die("Could not connect: " . mysql_error());
mysql_select_db("db_rmsci") or die ("Could not select database");

?>