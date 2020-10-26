<?php
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysql_connect("localhost","root","apmsetup") or
         die("Could not connect: " . mysql_error());
    //change to your database name
		@mysql_query("SET NAMES utf8");
		@mysql_query("set character_set_results=utf-8");
		mysql_select_db("renovo") or 
		     die("Could not select database: " . mysql_error());
	}
}
?>