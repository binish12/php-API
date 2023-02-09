<?php
 //Define your Server host name here.
 $HostName = "localhost:3307";
 
 //Define your MySQL Database Name here.
 $DatabaseName = "gymshala";
 
 //Define your Database User Name here.
 $HostUser = "root";
 
 //Define your Database Password here.
 $HostPass = ""; 
 $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
