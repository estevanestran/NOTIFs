<?php 
session_start();
unset($_SESSION['id']);

header('Location:../view/index.html');

?>