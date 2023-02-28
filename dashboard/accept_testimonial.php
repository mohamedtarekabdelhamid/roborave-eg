<?php

session_start();

require_once 'lib/data.php';

if (!isset($_SESSION['user'])) header('LOCATION:login.php');
if (!isset($_GET['id'])) header('LOCATION:testimonials.php');

acceptTestimonial($_GET['id']);
header("LOCATION:testimonials.php");exit;