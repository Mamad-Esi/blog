<?php require_once './part/header.php' ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?>

<?php

// session_start(); 

if (isset($_SESSION['auth'])) {
    header("Location: panel.php");
    exit();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = loginUser($email, $password);
    
    if ($user) {
        $_SESSION['auth'] = $user['email'];
        header("Location: panel.php");
        exit();
    } else {
        $errors['status'] = "ایمیل یا رمز عبور اشتباه است.";
    }
}


?>

<section class="py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border border-light-subtle rounded-3 shadow-sm">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="text-center mb-3">
                        <a href="#!">
                            <img src="images/logo.jpg" alt="BootstrapBrain Logo" width="175">
                        </a>
                    </div>
                    <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Login to admin panel in to your account</h2>
                    <?php if(count($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="#!">
                        <div class="row gy-2 overflow-hidden">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                    <label for="email" class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                    <label for="password" class="form-label">Password</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="d-grid my-3">
                                    <button class="btn btn-primary btn-lg" type="submit">Log in</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once './part/footer.php' ?>