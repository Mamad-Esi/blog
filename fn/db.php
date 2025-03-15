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


function getAllUsers() {
    $conn = connect();

    try {

        // اجرای کوئری برای دریافت تمام کاربران
        $stmt = $conn->query("SELECT * FROM user");

        // دریافت تمام کاربران در یک آرایه
        return $stmt->fetchAll();

    } catch (PDOException $e) {
        die("خطا در اتصال: " . $e->getMessage());
    }
}


// ---------all users count ----------
function getCountAllUsers()
{
    $conn = connect();
    $sql = "SELECT * FROM user";
    $statement = $conn->prepare($sql);
    $statement->execute();

    return $statement->rowCount();
}

// ALL USERS 
function getUsers($perpage = 5 , $offset = 0 ) 
{
    $conn = connect();
    $sql = "SELECT * FROM user LIMIT :perpage OFFSET :offset";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':perpage', $perpage, PDO::PARAM_INT);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


// log out
function logoutUser() {
    session_start(); // شروع سشن
    session_unset(); // حذف تمام متغیرهای سشن
    session_destroy(); // نابود کردن سشن
    header("Location: login.php"); // هدایت به صفحه لاگین
    exit();
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

    $sql = "SELECT posts.*, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories
            FROM posts
            LEFT JOIN categorires_post ON posts.id = categorires_post.post_id
            LEFT JOIN categories ON categorires_post.categories_id = categories.id
            WHERE posts.id = :id
            GROUP BY posts.id";
    
    $statement = $conn->prepare($sql);
    $statement->bindValue(':id', $postId, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}



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
    if ($user) {
        return $user; // لاگین موفقیت‌آمیز
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