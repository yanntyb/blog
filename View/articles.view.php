
<div class="articles">
    <?php
    if(isset($var['articles'])) {
        foreach ($var['articles'] as $article) { ?>
            <article id=article-"<?= $article->getId() ?>">
                <a href="?controller=articles&action=see&article=<?= $article->getId() ?>"><?= $article->getTitle() ?></a>
                <span class="author"><?= $article->getUser()->getUsername() ?></span>
            </article> <?php
        }
    } ?>
</div>