<?php

function database_connect() {
  return mysqli_connect('localhost', 'root', '', 'roborave');
}