<div id="connexionCont">
    <div id="connexion">
        <form action="../connexion.php" method="GET">
            <h1>Connexion</h1>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="pass">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
        <form action="../newUser.php" method="POST">
            <h1>Inscription</h1>
            <div>
                <label for="name">Name</label>
                <input type="text" name="newName" id="name">
            </div>
            <div>
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>
</div>