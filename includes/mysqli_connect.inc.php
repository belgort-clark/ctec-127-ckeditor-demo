<?php

$dbc = mysqli_connect("localhost","root","","ctec") OR
 die('<p>Could not connect to the MySQL Server: ' . mysqli_connect_error() . '</p>');

// set the encoding
mysqli_set_charset($dbc,'utf8');

?>