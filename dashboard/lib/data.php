<?php

require_once 'database.php';

// Portfolio

function selectPortfolioData($id) {
  $con = database_connect();
  $query = "SELECT * FROM `user` WHERE `user`.`id` = $id";
  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);
}

function updatePortfolio($name, $email, $password, $avatar, $user_id) {

  $con = database_connect();
  
  $query = "UPDATE `user` SET `id`= $user_id";

  if (!empty($name)) $query .= ", `name`='$name'";
  if (!empty($email)) $query .= ", `email`='$email'";
  if ($password != "da39a3ee5e6b4b0d3255bfef95601890afd80709") $query .= ", `password`='$password'";
  if (!empty($avatar)) $query .= ", `avatar`='$avatar' ";

  $query .= "WHERE `id` = $user_id";
  // echo $query;die;
  return (mysqli_query($con, $query) == 1) ? true : false;

}

// Home Page Functions

function selectHomePageData() {
  $con = database_connect();
  $query = "SELECT `landing_page`.`id`, `landing_page`.`logo`, `landing_page`.`icon`, `landing_page`.`slogan_first_line`, `landing_page`.`slogan_second_line`, `landing_page`.`description`, `landing_page`.`read_more_link`, `landing_page`.`last_update`, `landing_page`.`user_id`, `user`.`name`, `user`.`email`, `user`.`avatar` FROM `landing_page` INNER JOIN `user` ON `landing_page`.`user_id` = `user`.`id`";
  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);
}

function updateHomePageData($logo_name, $icon_name, $slogan_first_line, $slogan_second_line, $description, $read_more, $last_update, $user_id) {

  $con = database_connect();
  
  $query = "UPDATE `landing_page` SET `id`= 1";

  if (!empty($logo_name)) $query .= ", `logo`='$logo_name'";
  if (!empty($icon_name)) $query .= ", `icon`='$icon_name'";
  if (!empty($slogan_first_line)) $query .= ", `slogan_first_line`='$slogan_first_line'";
  if (!empty($slogan_second_line)) $query .= ", `slogan_second_line`='$slogan_second_line'";
  if (!empty($description)) $query .= ", `description`='$description'";
  if (!empty($read_more)) $query .= ", `read_more_link`='$read_more'";
  if (!empty($user_id)) $query .= ", `user_id`='$user_id', ";

  $query .= "`last_update`='$last_update' WHERE `id` = 1";

  return (mysqli_query($con, $query) == 1) ? true : false;

}

// Events Functions

function insertEvent($name, $starting_date, $ending_date, $event_info, $user_id) {
  $con = database_connect();

  $query = "INSERT INTO `event`(`name`, `starting_time`, `ending_time`, `event_info`, `user_id`) 
            VALUES 
            ('$name', '$starting_date', '$ending_date', '$event_info', $user_id)";
  mysqli_query($con, $query);
  
  

  return mysqli_affected_rows($con) == 1 ? true : false;
}

function selectEventsData() {
  $con = database_connect();

  $query = "SELECT `event`.`id`, `event`.`name` AS `event_name`, `event`.`starting_time`, `event`.`ending_time`, `event`.`event_info`, `event`.`user_id`, `user`.`name`, `user`.`email`, `user`.`avatar` FROM `event` INNER JOIN `user` ON `event`.`user_id` = `user`.`id`";
  $query_result = mysqli_query($con, $query);

  $data = [];

  while ($i = mysqli_fetch_assoc($query_result)) $data[] = $i;

  return $data;
}

function selectEventById($id) {
  $con = database_connect();

  $query = "SELECT `event`.`id`, `event`.`name` AS `event_name`, `event`.`starting_time`, `event`.`ending_time`, `event`.`event_info`, `event`.`user_id`, `user`.`name`, `user`.`email`, `user`.`avatar` FROM `event` INNER JOIN `user` ON `event`.`user_id` = `user`.`id` WHERE `event`.`id` = $id";
  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);
}

function updateEventData($event_id, $name, $starting_date, $ending_date, $event_link, $last_update, $user_id) {

  $con = database_connect();
  
  $query = "UPDATE `event` SET `id`= $event_id";

  if (!empty($name)) $query .= ", `name`='$name'";
  if (!empty($starting_date)) $query .= ", `starting_time`='$starting_date'";
  if (!empty($ending_date)) $query .= ", `ending_time`='$ending_date'";
  if (!empty($event_link)) $query .= ", `event_info`='$event_link'";
  if (!empty($user_id)) $query .= ", `user_id`='$user_id', ";

  $query .= "`last_update`='$last_update' WHERE `id` = $event_id";

  return (mysqli_query($con, $query) == 1) ? true : false;

}

function deleteEvent($id) {
  $con = database_connect();

  $query = "DELETE FROM `event` WHERE `id` = '$id'";
  $query_result = mysqli_query($con, $query);

  return mysqli_affected_rows($con) == 1 ? true : false;
}

// About Us Functions

function selectAboutData() {
  $con = database_connect();
  $query = "SELECT `about`.`id`, `about`.`description`, `about`.`video`, `about`.`last_update`, `about`.`user_id`, `user`.`name`, `user`.`email`, `user`.`avatar` FROM `about` INNER JOIN `user` ON `about`.`user_id` = `user`.`id`";

  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);
}

function updateAboutData($description, $video, $last_update, $user_id) {

  $con = database_connect();
  
  $query = "UPDATE `about` SET `id`= 1";

  if (!empty($description)) $query .= ", `description`='$description'";
  if (!empty($video)) $query .= ", `video`='$video'";
  if (!empty($user_id)) $query .= ", `user_id`='$user_id', ";

  $query .= "`last_update`='$last_update' WHERE `id` = 1";

  return (mysqli_query($con, $query) == 1) ? true : false;

}

// About Us Functions

function selectContactData() {
  $con = database_connect();
  $query = "SELECT `contact`.`id`, `contact`.`phone`, `contact`.`email`, `contact`.`location`, `contact`.`facebook`, `contact`.`twitter`, `contact`.`youtube`, `contact`.`last_update`, `contact`.`user_id`, `user`.`name`, `user`.`email` AS `user_email`, `user`.`avatar` FROM `contact` INNER JOIN `user` ON `contact`.`user_id` = `user`.`id`";

  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);
}

function updateContactData($phone, $email, $location, $facebook, $twitter, $youtube, $last_update, $user_id) {

  $con = database_connect();
  
  $query = "UPDATE `contact` SET `id`= 1";

  if (!empty($phone)) $query .= ", `phone`='$phone'";
  if (!empty($email)) $query .= ", `email`='$email'";
  if (!empty($location)) $query .= ", `location`='$location'";
  if (!empty($facebook)) $query .= ", `facebook`='$facebook'";
  if (!empty($twitter)) $query .= ", `twitter`='$twitter'";
  if (!empty($youtube)) $query .= ", `youtube`='$youtube'";
  if (!empty($user_id)) $query .= ", `user_id`='$user_id', ";

  $query .= "`last_update`='$last_update' WHERE `id` = 1";

  return (mysqli_query($con, $query) == 1) ? true : false;

}

// Testimonials Function

function insertRate($name, $feedback, $rate, $avatar) {
  $con = database_connect();

  $query = "INSERT INTO `testimonials`(`name`, `rate`, `description`, `avatar`) 
            VALUES 
            ('$name', '$rate', '$feedback', '$avatar')";

            // echo $query; die;

  mysqli_query($con, $query);

  return mysqli_affected_rows($con) == 1 ? true : false;
}

function selectTestimonialsData() {
  $con = database_connect();

  $query = "SELECT * FROM `testimonials`";
  $query_result = mysqli_query($con, $query);

  $data = [];

  while ($i = mysqli_fetch_assoc($query_result)) $data[] = $i;

  return $data;
}

function deleteTestimonial($id) {
  $con = database_connect();

  $query = "DELETE FROM `testimonials` WHERE `id` = '$id'";
  $query_result = mysqli_query($con, $query);

  return mysqli_affected_rows($con) == 1 ? true : false;
}

function acceptTestimonial($id) {

  $con = database_connect();
  
  $query = "UPDATE `testimonials` SET `accepted`= 1 WHERE `id` = $id";

  // echo $query;die;

  return (mysqli_query($con, $query) == 1) ? true : false;

}