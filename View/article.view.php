<div class="articleContent">
    <div id="articleTitle"><?= $var["article"]->getTitle() ?></div>
    <div id="articleSubContent"><?= $var["article"]->getContent() ?></div>
    <div class="commentDiv">
        <?php foreach($var["article"]->getComment() as $comment){?>
            <div id="commentAuthor"><?= $comment->getAuthor()->getUsername() ?></div>
            <div class="comment"><?= $comment->getContent() ?></div><?php
        } ?>
    </div>
</div>