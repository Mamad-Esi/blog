<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: login.php"); // هدایت به صفحه لاگین
    exit();
} else {
    // پاک کردن متغیرهای سشن
    session_unset(); // حذف تمام متغیرهای سشن
    
    // نابود کردن سشن
    session_destroy(); 

    // پاک کردن کوکی‌های سشن
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // هدایت به صفحه لاگین بعد از خروج
    header("Location: login.php");
    exit();
}
?>