<?php 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]cotizador3/";
header("Location: $actual_link");