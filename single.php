<?php require_once "./part/header.php" ?>
<?php require_once "./fn/functions.php" ?>
<?php require_once "./fn/db.php" ?>

<?php
$postId = $_GET['post'];
$post = getPostById($postId);

if (!$post) {
    echo "پست مورد نظر یافت نشد!";
}

?>

<section class="mt-4">
    <div class="d-flex flex-wrap justify-content-between">
        <div class="col-5">
            <img src="<?= asset($post['upload_images']) ?>" class="card-img-top" alt="...">
        </div>
        <div class="col-7">
            <div class="ps-4">
                <h1><?= $post['title'] ?></h1>
                <div>
                    <time class="pe-5 text-secondary"><?= $post['created_at'] ?></time>
                    <span class="ps-5 text-primary">Ali mohammadi</span>
                </div>
                <p class="mt-5"><?= $post['content'] ?></p>
            </div>
        </div>
    </div>
</section>

<?php require_once "./part/footer.php" ?>