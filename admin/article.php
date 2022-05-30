<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';


if (isset(($_GET['id']))) {

    $article = Article::getWithCatigories($conn, $_GET['id']);
} else {

    $article = null;
}
?>

<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>

    <article>
        <h2><?= htmlspecialchars($article[0]['title']); ?></h2>

        <?php if ($article[0]['published_at']) : ?>
            <time><?= $article[0]['published_at']; ?></time>

        <?php else : ?>
            Unpublished

        <?php endif; ?>
        </time>


        <?php if ($article[0]['category_name']) : ?>
            <p>Categories:</p>

            <?php foreach ($article as $a) : ?>
                <?= htmlspecialchars($a['category_name']); ?>
            <?php endforeach; ?>

        <?php endif; ?>

        <?php if ($article[0]['image_file']) : ?>
            <img src="/uploads/<?= $article[0]['image_file'] ?>" alt="">
        <?php endif; ?>

        <p><?= htmlspecialchars($article[0]['content']); ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article[0]['article_id']; ?>">Edit</a>
    <a class="delete" href="delete-article.php?id=<?= $article[0]['article_id']; ?>">Delete</a>
    <a href="edit-article-image.php?id=<?= $article[0]['article_id']; ?>">Edit Image</a>

<?php else : ?>
    <p>No article found.</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>