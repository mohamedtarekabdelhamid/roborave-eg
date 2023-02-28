<?php

session_start();

require_once 'lib/data.php';

if (!isset($_SESSION['user'])) { header('LOCATION:login.php');exit; }
if (!isset($_GET['id'])) { header('LOCATION:all_events.php');exit; }

deleteEvent($_GET['id']);
header("LOCATION:all_events.php");exit;