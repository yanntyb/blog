<?php
namespace Controller;

use Controller\Traits\RenderViewTrait;

class UserController {

    use RenderViewTrait;

    /**
     * Affiche la page home.
     */
    public function connexionPage() {
        $user = 'Anonymous';
        $var = [];
        if(isset($_GET["error"])) {
            if(isset($_GET["color"])){
                $color = $_GET["color"];
            }
            else{
                $color = "red";
            }
            $var = ["error" => $_GET["error"], "color" => $color];
        }

        $this->render('connexion', 'Connexion', $var);
    }

}