<?php

session_start();

require_once 'lib/data.php';

if (!isset($_SESSION['user'])) { header('LOCATION:login.php');exit; }
if (!isset($_GET['id'])) { header('LOCATION:testimonials.php');exit; }

deleteTestimonial($_GET['id']);
header("LOCATION:testimonials.php");
exit;
