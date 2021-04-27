<div id="navbar">
    <ul>
        <li><a href="?controller=articles">Articles</a></li>
        <li><a href="?controller=articles&action=new">New article</a></li><?php
        if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){?>
            <li><a href="../../deconnexion.php">Deconnection</a></li><?php
        }
        else{?>
            <li><a href="?">Connexion</a></li><?php
        }
        ?>
    </ul>
</div>