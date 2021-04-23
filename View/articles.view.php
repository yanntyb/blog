
<div class="articles">
    <?php
    if(isset($var['articles'])) {
        foreach ($var['articles'] as $article) { ?>
            <article id=article-"<?= $article->getId() ?>">
                <?= $article->getContent() ?>
                <span class="author"><?= $article->getUser()->getUsername() ?></span>
            </article> <?php
        }
    } ?>
</div>