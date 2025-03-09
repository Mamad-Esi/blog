<?php
$host = 'localhost'; // آدرس سرور دیتابیس (معمولاً localhost)
$dbname = 'php'; // نام دیتابیس
$username = 'root'; // نام کاربری دیتابیس
$password = 'mamad.esi4030'; // رمز عبور دیتابیس



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ اتصال به پایگاه داده برقرار شد!";
} catch (PDOException $e) {
    echo "❌ خطا در اتصال به پایگاه داده: " . $e->getMessage();
}
?>
