<div id="articleContent" data-id = "<?= $var["id"] ?>">
    <div id="articleTitle"><?= $var["article"]->getTitle() ?></div>
    <div id="articleSubContent"><?= $var["article"]->getContent() ?></div>
    <div id="commentDiv"></div>
</div>
<div id="commentForm">
    <form>
        <select id="user"><?php
            foreach($var["users"] as $user){?>
                <option value="<?= $user->getId() ?>"><?= $user->getUsername() ?></option><?php
            }?>
        </select>
        <textarea id="commentInput">
        </textarea>
        <input id="commentSubmit" type="submit">
    </form>
</div>
<script src="/assets/js/comment.js" type="module"></script>