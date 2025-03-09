<?php
require_once "./fn/config.php";

function getPosts($perpage = 5 , $offset = 0 ) 
{
    $conn = connect();

    $sql = "SELECT * FROM posts LIMIT :perpage OFFSET :offset";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':perpage', $perpage, PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getCountAllPosts() 
{
    $conn = connect();

    $sql = "SELECT id FROM posts";
    $statement = $conn->query($sql);

    return $statement->rowCount();
}


function getPostById($postId) 
{
    $conn = connect();

    $sql = "SELECT * FROM posts WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':id', $postId, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}


// ino bebin yebar dighe 
function searchPosts($word) {
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE :word");
    
    $searchTerm = "%{$word}%";
  
    $stmt->bindParam(':word', $searchTerm, PDO::PARAM_STR);
    
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);


}

?>