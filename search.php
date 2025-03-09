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
    
$posts = getPosts($perpage , $offset);


$results = [];
if (isset($_GET['word'])) {
    $word = $_GET['word'];
    $results = searchPosts($word);
}

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


<?php require_once "./part/footer.php" ?>