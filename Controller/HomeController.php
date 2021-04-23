<?php

namespace Controller;

use Controller\Traits\RenderViewTrait;

class HomeController {

    use RenderViewTrait;

    /**
     * Affiche la page home.
     */
    public function homePage() {
        $user = 'Anonymous';
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }

        $this->render('home', 'Ma home page', [
            'user' => $user,
        ]);
    }

}