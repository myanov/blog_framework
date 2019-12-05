<?php foreach($articles as $article): ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4"><?= $article['title'] ?></h1>
        <p class="lead"><?= $article['text'] ?></p>
    </div>
</div>
<?php endforeach; ?>
