<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>
<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>

<div class="article">
    <article>
        <h2 class="article-header"><?= htmlspecialchars($article[0]['title']); ?></h2>

        <?php if ($article[0]['published_at']) : ?>
            <time><?= $article[0]['published_at'] ?></time>
        <?php else : ?>
            Unpublished
        <?php endif; ?>

        <?php if ($article[0]['category_name']) : ?>
            <p class="categories">Categories:
                <?php foreach ($article as $a) : ?>
                    <?= htmlspecialchars($a['category_name']); ?>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <?php if ($article[0]['image_file']) : ?>
            <img class="image-in-article" src="/uploads/<?= $article[0]['image_file']; ?>">
        <?php endif; ?>

        <p><?= htmlspecialchars($article[0]['content']); ?></p>
    </article>

    <div class="admin-buttons">
        <button class="btn">
            <a class="edit" href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
        </button>

        <button class="btn">
            <a class="delete" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
        </button>
        
        <button class="btn">
            <a class="edit-img" href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit image</a>
        </button>
    </div>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

</div>

<?php require '../includes/footer.php'; ?>
