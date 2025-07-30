<?php
// controllers/HomeController.php

class HomeController {
    public function index() {
        require_once __DIR__ . '/../views/accueil.php';
    }

    public function apropos() {
        require_once __DIR__ . '/../views/apropos.php';
    }

    public function coaching() {
        require_once __DIR__ . '/../views/coaching.php';
    }

    public function mentionsLegales() {
        require_once __DIR__ . '/../views/mentLegal.php';
    }

    public function politiqueConfidentialite() {
        require_once __DIR__ . '/../views/polConf.php';
    }

    public function notFound() {
        require_once __DIR__ . '/../views/404.php';
    }

   
    public function agenda() {
        require_once __DIR__ . '/../views/agenda.php';
    }
}
