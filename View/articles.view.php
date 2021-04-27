
<div class="articles">
    <?php
    if(isset($var['articles'])) {
        foreach ($var['articles'] as $article) { ?>
            <article data-id= <?= $article->getId() ?>>
                <a href="?controller=articles&action=see&article=<?= $article->getId() ?>"><?= $article->getTitle() ?></a>
                <span class="author"><?= $article->getUser()->getUsername() ?></span><?php
                if($_SESSION["user"]->getAdmin() === 1){?>
                    <span class="close"><i class="fas fa-times"></i></span><?php
                }
                ?>
            </article> <?php
        }
    } ?>
</div>
<script src="./assets/js/article.js"></script>