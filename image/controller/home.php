<?php
# Récupération de l'objet data
require_once 'data.php';

#Controller gérent la page d'accueil
class Home {
    
    public function __construct() {
        
    }
    
    #Permet d'accéder à la vue de A propos
    function aPropos(){
        #On récuère la vue correspondante
        $data->content = "aProposView.php";
        #Création du bouton Home du menu
        $data->menu['Home'] = "index.php";
        #Création du bouton A propos du menu
        $data->menu['A Propos'] = "index.php?action=aPropos";
        #Définition de la taille par défaut des images
        $size = 480;
        #Crée le bouton Voir Photos qui permet de visualiser les photos
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&&size=$size";
        #On vérifie qu'un utilisateur est connecté
        #Si aucun utilisateur est connecté on crée les boutons Identification est S'inscrire
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        #Sinon on crée un bouton déconnexion
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        #On récupère la vue principale
        require_once 'view/mainView.php';
    }
    
    #Redirige vers la page d'accueil
    function index() {
        #Création d'un objet Data
        $data = new Data();
        #On récupère la vue correspondante
        $data->content = "homeView.php";
        #On crée le bouton Home du menu
        $data->menu['Home'] = "index.php";
        #On crée le bouton A propos du menu
        $data->menu['A Propos'] = "index.php?action=aPropos";
        #On définit la taille par défaut des images
        $size = 480;
        #On crée le bouton Voir photos du menu qui permet de voir les photos
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&size=$size";
        #On vérifie qu'un utilisateur est connecté
        #Si aucun utilisateur est connecté on crée les boutons Identification est S'inscrire
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        #Sinon on crée un bouton déconnexion
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        #On récupère la vue principale
        require_once "view/mainView.php";
    }
}

