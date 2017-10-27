<?php
 session_start();
 print("<html><b>");
 $sid = session_id();
 print("Session ID returned by session_id(): ".$sid."\n");
 $sid = SID;
 print("Session ID returned by SID: ".$sid."\n");
 //$mysite = $_SESSION["mysite"];
 //print("Value of mysite has been retrieved: ".$mysite."\n");
 print("</b></html>\n");
?>