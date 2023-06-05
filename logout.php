<?php

@include 'config-login.php';

session_start();
session_unset();
session_destroy();

header('location:Login Page.php');

?>