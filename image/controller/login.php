<?php
session_start();
require_once 'model/imageDAO.php';
require_once 'model/utilisateurDAO.php';

class Login {
    
    protected $imageDAO;
    protected $utilisateurDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
        $this->utilisateurDAO = new utilisateurDAO();
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
        $data->content = "loginView.php";
        require_once 'view/mainView.php';
    }
    
    public function login() {
        if(isset($_POST['pseudo']) && isset($_POST['password'])) {
            $utilisateur = $this->utilisateurDAO->getUserByPseudo($_POST['pseudo']);
            if($utilisateur != NULL && $_POST['password'] == $utilisateur->getPassword()){
                $_SESSION['id'] = $utilisateur->getId();
                $_SESSION['pseudo'] = $utilisateur->getPseudo();
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
                $data->content = "logedView.php";
                require_once 'view/mainView.php';
            } else {
                $data->content = "logedView.php";
                echo 'Mauvais pseudo ou mot de passe';
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
                require_once 'view/mainView.php';
            }
        } else {
            echo 'Entrez un pseudo et un mot de passe';
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
                $data->content = "logedView.php";
            require_once 'view/mainView.php';
        }
    }
    public function deconnexion() {
        $_SESSION = array();
        session_destroy();
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
        $data->content = "homeView.php";
        echo 'Deconnexion !';
        require_once 'view/mainView.php';
    }
}