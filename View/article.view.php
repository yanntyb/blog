<div id="articleDiv" data-id = "<?= $var["id"] ?>">
    <div id="articleContent">
        <div id="articleTitle"><?= $var["article"]->getTitle() ?></div>
        <div id="articleSubContent"><?= $var["article"]->getContent() ?></div><?php
        if($var["user"]->getAdmin() === 1){?>
            <i id="edit" class="far fa-edit"></i><?php
        }
        ?>
    </div>
    <span id="commentTitle">Commentaires</span>
    <div id="commentDiv"></div>
    <div id="commentForm">

        <form>
            <div>
                <input type="hidden" id="user" value="<?= $var["user"]->getId() ?>" >
                <textarea id="commentInput"></textarea>
            </div>
            <div>
                <input id="commentSubmit" type="submit">
            </div>
        </form>
    </div>
</div>
<script src="/assets/js/comment.js"></script>
<script src="/assets/js/article.js"></script>