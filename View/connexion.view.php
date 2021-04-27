<div id="connexionCont">
    <div id="connexion">
        <form action="../connexion.php" method="get">
            <div>
                <input type="text" name="name" placeholder="Name">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div>
                <input type="submit" value="connexion">
            </div>
        </form>
        <form action="../newUser.php" method="post">
            <div>
                <input type="text" name="name" placeholder="Name">
            </div>
            <div>
                <input type="password" name="password" id="pass" placeholder="Password">
            </div>
            <div>
                <input type="submit" value="inscription">
            </div>
        </form>
    </div>
</div>
<script src="./assets/js/connexion.js"></script>