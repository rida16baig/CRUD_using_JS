<?php

include '../crud.php';

$usersData = file_get_contents('php://input');

$json_data = json_decode($usersData, true);

$result = $get->create('users', $json_data);

echo json_encode($result);