<?php require_once './part/header_panel.php' ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?>

<?php

    session_start();

    if (!isset($_SESSION['auth'])) {
        header("Location: login.php");
        exit();
    }

    $users = getAllUsers();
    // var_dump($uds)
    
    // Number of pages and settings
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $perpage = 4;
    $offset = ($page - 1) * $perpage;

    $totalPages = ceil(getCountAllUsers() / $perpage);
    if ($page > $totalPages)
        // nemishe bezarim 404
        redirectto('index.php');
        
    $users = getUsers($perpage , $offset);

?>

<section class="mt-3">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">All Users</h1>
            <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron.</p>
            <a class="btn btn-primary btn-lg" href="<?= url('index.php') ?>">See website</a>
        </div>
    </div>
</section>

<section class="mt-3">
    <table class="table">
    <thead> 
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">password</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <!-- <td scope="col">ID</td> -->
                <!-- <td scope="col">username</td>
                <td scope="col">email</td>
                <td scope="col">Status</td>
                <td scope="col">date</td> -->

                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['password']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</section>


<!-- pagination -->
<section class="d-flex flex-wrap mt-3 justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- لینک صفحه قبلی -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- لینک‌های صفحات -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- لینک صفحه بعدی -->
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</section>

<?php require_once './part/footer.php' ?>