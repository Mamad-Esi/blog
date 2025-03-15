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
                <!-- ino bebin  -->
                <div class="mt-6">
                <?php
                    if (!empty($post['categories'])): // چک می‌کنیم که مقدار موجود باشد
                        $categories = explode(',', $post['categories']);
                        
                        if (!empty($categories[0])): // چک می‌کنیم که حداقل یک مقدار معتبر وجود داشته باشد
                            foreach ($categories as $category): ?>
                                <a href="<?= url('categories.php', ['cat' => trim($category)]) ?>" style="display: block;"><?= htmlspecialchars($category) ?></a>
                            <?php 
                            endforeach;
                        endif;
                    endif;
                ?>



                </div>
                <p class="mt-5"><?= $post['content'] ?></p>
            </div>
        </div>
    </div>
</section>

<?php require_once "./part/footer.php" ?>