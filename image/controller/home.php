<?php
session_start();
require_once 'data.php';

class Home {
    
    public function __construct() {
        
    }
    
    function aPropos(){
        $data = new Data();
        $data->content = "aProposView.php";
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $size = 480;
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&&size=$size";
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        require_once 'view/mainView.php';
    }
    
    function index() {
        $data = new Data();
        $data->content = "homeView.php";
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $size = 480;
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&size=$size";
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        require_once "view/mainView.php";
    }
}

