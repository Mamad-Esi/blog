<?php
require 'config.php';

$query = "SELECT posts.id, posts.title, posts.content, users.name AS author 
          FROM posts 
          JOIN users ON posts.user_id = users.id
          ORDER BY posts.id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>