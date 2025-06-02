<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    'method' => $_SERVER['REQUEST_METHOD'],
    'post_data' => $_POST
]);
?>