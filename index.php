<?php require_once "./part/header.php" ?>
<?php require_once "./part/slider.php" ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?>

<?php

// Number of pages and settings
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perpage = 4;
$offset = ($page - 1) * $perpage;

$totalPages = ceil(getCountAllPosts() / $perpage);
if ($page > $totalPages)
// nemishe bezarim 404
    redirectto('index.php');
    
$posts = getPosts($perpage , $offset);

?>

<!-- cart -->
<section class="d-flex flex-wrap mt-3 justify-content-center">
    <?php foreach($posts as $post): ?>
    <div class="card mx-2 mb-3" style="width: 19rem;">
        <img src="<?= asset($post['upload_images']) ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <p class="card-text"><?= exerpt($post['content']) ?></p>
            <a href="<?= url('single.php' , ['post' => $post['id']]) ?>" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <?php endforeach; ?>
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

<?php require_once "./part/footer.php" ?>