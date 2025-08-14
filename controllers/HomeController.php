<?php
// controllers/HomeController.php

/**
 * Ce contrôleur gère les actions de base pour les pages publiques du site.
 */
class HomeController
{
    /**
     * Charge la vue de la page d'accueil.
     */
    public function index()
    {
        require_once __DIR__ . '/../views/accueil.php';
    }

    /**
     * Charge la vue de la page "À propos".
     */
    public function apropos()
    {
        require_once __DIR__ . '/../views/apropos.php';
    }

    /**
     * Charge la vue de la page de coaching.
     */
    public function coaching()
    {
        require_once __DIR__ . '/../views/coaching.php';
    }

    /**
     * Charge la vue des mentions légales.
     */
    public function mentionsLegales()
    {
        // J'ai conservé le nom de votre fichier de vue d'origine.
        require_once __DIR__ . '/../views/mentLegal.php';
    }

    /**
     * Charge la vue de la politique de confidentialité.
     */
    public function politiqueConfidentialite()
    {
        // J'ai conservé le nom de votre fichier de vue d'origine.
        require_once __DIR__ . '/../views/polConf.php';
    }

    /**
     * J'ai ajouté cette méthode qui manquait pour les conditions générales de vente.
     * Assurez-vous d'avoir un fichier de vue `cgv.php` dans votre dossier `views`.
     */
    public function conditionsGeneralesDeVente()
    {
        require_once __DIR__ . '/../views/cgv.php';
    }

    /**
     * Charge la vue de l'agenda.
     */
    public function agenda()
    {
        require_once __DIR__ . '/../views/agenda.php';
    }

    /**
     * Charge la vue de la page 404 en cas de page introuvable.
     */
    public function notFound()
    {
        require_once __DIR__ . '/../views/404.php';
    }
}
