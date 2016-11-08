<?php
session_start();
require_once 'model/imageDAO.php';
require_once 'model/utilisateurDAO.php';

class Inscription {
    
    protected $imageDAO;
    protected $utilisateurDAO;
    
    public function __construct() {
        $this->imageDAO = new ImageDAO;
        $this->utilisateurDAO = new utilisateurDAO;
    }
    
    public function index() {
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $size = 480;
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        if(isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->content = "inscriptionView.php";
        require_once 'view/mainView.php';
    }
    
    public function inscription() {
        if(isset($_POST['pseudo']) && isset($_POST['password'])) {
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $size = 480;
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
            $this->utilisateurDAO->createUser($_POST['pseudo'], $_POST['password']);
            echo "Nouvel Utilisateur créé.";
            if(isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            $data->content = "homeView.php";
            require_once 'view/mainView.php';
        } else {
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $size = 480;
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
            print("<p>Veuillez entrer un pseudo et mot de passe.</p>");
            if(isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            $data->content = "inscriptionView.php";
            require_once 'view/mainView.php';
        }
    }
}