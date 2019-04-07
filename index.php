<?php 

include'autoload.php';
session_start();

if (!isset($_SESSION[KEY.ID]))
{
  include'templates/login.php';
} 
else
{
  include'templates/home.php';
}



 ?>