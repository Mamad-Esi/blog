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

function getCountAllPosts($word = '')
{
    $conn = connect();

    $sql = "SELECT id FROM posts WHERE title LIKE '%$word%'";
    $statement = $conn->query($sql);

    return $statement->rowCount();
}

// ------------- category ------------
function getPostsByCategory($category = '')
{   
    $conn = connect();

    $sql = "SELECT *
            FROM categorires_post AS cp
            JOIN categories AS c ON cp.categories_id = c.id
            JOIN posts AS p ON cp.post_id = p.id
            WHERE c.name LIKE :category";

    $statement = $conn->prepare($sql);
    $statement->execute(['category' => "%$category%"]);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
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
// function searchPosts($word) {
//     $conn = connect();
//     $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE :word");
    
//     $searchTerm = trim("%{$word}%");
  
//     $stmt->bindParam(':word', $searchTerm, PDO::PARAM_STR);
    
//     $stmt->execute();
    
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function searchPosts($word, $perpage, $offset) {
    $conn = connect();

    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE :word OR content LIKE :word LIMIT :offset, :perpage");
    $stmt->bindValue(':word', "%$word%", PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':perpage', $perpage, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// 
function loginUser($email, $password) {
    $conn = connect();

    // بررسی ایمیل در کوئری SQL
   $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1");
    $stmt->execute(['email' => $email, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // مقایسه رمز عبور به صورت متنی
    if ($user && $password === $user['password']) {
        $_SESSION['auth'] = $user;
        return true; // لاگین موفقیت‌آمیز
    } else {
        return false; // ناموفق
    }
}


function getPostsForPanel($pdo) {
    $conn = connect();

    $stmt = $pdo->query("SELECT posts.id, posts.title, posts.created_at, posts.status, admins.username 
                        FROM posts 
                        JOIN admins ON posts.author_id = admins.id 
                        ORDER BY posts.created_at DESC");
    return $stmt->fetchAll();
}

?>