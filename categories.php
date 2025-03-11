<?php require_once "./part/header.php" ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?> 


<?php

$perpage = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $perpage;

if (!isset($_GET['cat']) or empty($_GET['cat']))
{
    redirectTo('index.php');
}
$category = $_GET['cat'];

// دریافت تمام پست‌های این دسته‌بندی
$results = getPostsByCategory($category);

// اطمینان از اینکه مقدار یک آرایه است
if (!is_array($results)) {
    $results = [];
}

// تعداد کل پست‌های این دسته‌بندی
$total_results = count($results);

// محاسبه تعداد کل صفحات
$total_pages = ceil($total_results / $perpage);

// اگر صفحه‌ای درخواست شود که از تعداد کل صفحات بیشتر باشد، ریدایرکت شود
if ($page > $total_pages && $total_pages > 0) {
    redirectTo('index.php');
}

// دریافت پست‌های صفحه جاری با محدودیت صفحه‌بندی
$posts = array_slice($results, $offset, $perpage);

// if (empty($_GET)) {
//     echo "Query String وجود ندارد.";
// } else {
//     print_r($_GET);
// }

?>

<h3 class="pt-10"> this category is  <?= $category ?></h3>

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
<section class="d-flex flex-wrap mt-3 justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?cat=<?= urlencode($cat) ?>&page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?cat=<?= urlencode($cat) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="?cat=<?= urlencode($cat) ?>&page=<?= min($total_pages, $page + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</section>


<?php require_once "./part/footer.php" ?>