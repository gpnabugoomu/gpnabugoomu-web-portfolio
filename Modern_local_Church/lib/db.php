<?php
function db(): mysqli {
  static $conn = null;
  if ($conn) return $conn;

  $cfg = require __DIR__ . '/../config/db.php';
  $conn = new mysqli($cfg['host'], $cfg['user'], $cfg['pass'], $cfg['name']);
  if ($conn->connect_error) {
    die('DB connection failed: ' . $conn->connect_error);
  }
  $conn->set_charset('utf8mb4');
  return $conn;
}

