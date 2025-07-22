<?php
// controllers/HomeController.php

class HomeController {
    public function index() {
        require_once 'views/accueil.php'; // Votre page d'accueil
    }

    public function apropos() {
        require_once 'views/apropos.php'; // Vue 'À propos'
    }

    public function coaching() {
        require_once 'views/coaching.php'; // Vue 'Coaching'
    }

    public function mentionsLegales() {
        require_once 'views/mentLegal.php'; // Vue 'Mentions Légales'
    }

    public function politiqueConfidentialite() {
        require_once 'views/polConf.php'; // Vue 'Politique de Confidentialité'
    }
}