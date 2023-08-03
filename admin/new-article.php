<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();

$category_ids = [];

$conn = require '../includes/db.php';

$categories = Category::getAll($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];

    if ($article->create($conn)) {

        $article->setCategories($conn, $category_ids);

        Url::redirect("/admin/article.php?id={$article->id}");

    }
}

?>
<?php require '../includes/header.php'; ?>

<div class="article">
    <h2 class="article-header">New article</h2>

    <?php require 'includes/article-form.php'; ?>
</div>

<?php require '../includes/footer.php'; ?>
