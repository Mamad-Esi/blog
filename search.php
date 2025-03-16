<?php require_once "./part/header.php" ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?> 


<?php

if (!isset($_GET['word']) or empty($_GET['word']))
{
    redirectTo('index.php');
}

// Number of pages and settings
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perpage = 4;
$offset = ($page - 1) * $perpage;

$totalPages = ceil(getCountAllPosts() / $perpage);
if ($page > $totalPages)
    // nemishe bezarim 404
    redirectto('index.php');
    
// $posts = getPosts($perpage , $offset);

$results = [];
if (isset($_GET['word'])) {
    $word = trim($_GET['word']);
    $results = searchPosts($word , 4, $offset);
}

if (isset($_GET['cat'])) {
    $cat = trim($_GET['cat']);
    $results = getPostsByCategory($cat);
}

// گرفتن تعداد کل نتایج جستجو
$total_results = getCountAllPosts($word);
$total_pages = ceil($total_results / $perpage);

// اگر صفحه‌ای درخواست شود که از تعداد کل صفحات بیشتر باشد، کاربر به صفحه اصلی هدایت شود
if ($page > $total_pages && $total_pages > 0) {
    redirectTo('index.php');
}

// دریافت نتایج جستجو با محدودیت صفحه‌بندی
$posts = searchPosts($word, $perpage, $offset);

?>

<!-- cart -->
<section class="d-flex flex-wrap mt-3 justify-content-center">
    <?php foreach($results as $post): ?>
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
<?php if ($total_results > $perpage): ?> 
    <section class="d-flex flex-wrap mt-3 justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?word=<?= urlencode($word) ?>&page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?word=<?= urlencode($word) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?word=<?= urlencode($word) ?>&page=<?= min($total_pages, $page + 1) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
<?php endif; ?>

<?php require_once "./part/footer.php" ?>