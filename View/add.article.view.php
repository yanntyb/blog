<div id="addArticle">
    <div class="form-content">
        <form action="" method="post">
            <div>
                <input type="text" name="title" placeholder="title">
                <textarea name="content" id="content" cols="30" rows="20"></textarea>
            </div>
            <!-- Fake utilisateur pour rapidement démontrer le concept. -->
            <div>
                <input type="hidden" name="user" value="<?= $var["user"]->getId() ?>>"> <!-- ID 1 => John Doe en base de données. -->
                <input type="submit" value="Ajouter article">
            </div>
        </form>
    </div>
</div>