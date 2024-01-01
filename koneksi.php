<?php
$host = "localhost"; // Nama hostnya
$username = "user"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "crud-foto"; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
$connect = mysqli_connect($host, $username, $password, $database);
