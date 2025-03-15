<?php require_once './part/header_panel.php' ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?>

<?php

    session_start();

    if (!isset($_SESSION['auth'])) {
        header("Location: login.php");
        exit();
    }

    
    // Number of pages and settings
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $perpage = 7;
    $offset = ($page - 1) * $perpage;

    $totalPages = ceil(getCountAllPosts() / $perpage);
    if ($page > $totalPages)
        // nemishe bezarim 404
        redirectto('panel.php');
        
    $posts = getPosts($perpage , $offset);


?>
    <!-- hero -->
    <section class="mt-3">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">AllPosts</h1>
                <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron.</p>
                <a class="btn btn-primary btn-lg" href="<?= url('index.php') ?>">See website</a>
            </div>
        </div>
    </section>

    <!-- cart -->
    <?php if (count($posts)): ?>
        <section class="mt-3">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <!-- <th scope="col">Author</th> -->
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo htmlspecialchars($post['id']); ?></td>
                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                    <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($post['status']) ? 'Active' : 'inactive'  ?></td>
                    <td>
                        <a href="#" class="mx-2 text-danger">delete</a>
                        <a href="#" class="mx-2">edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </section>
    <?php endif; ?>

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