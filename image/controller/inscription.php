<?php
#On importe la classe imageDAO
require_once 'model/imageDAO.php';
#On  importe la classe utilisateurDAO
require_once 'model/utilisateurDAO.php';

class Inscription {
    
    #Création d'un objet imageDAO
    protected $imageDAO;
    #Création d'un objet utilisateurDAO
    protected $utilisateurDAO;
    
    public function __construct() {
        $this->imageDAO = new ImageDAO;
        $this->utilisateurDAO = new utilisateurDAO;
    }
    
    #Fonction qui dirige l'utilisateur vers le formulaire d'inscription
    public function index() {
        #On crée le bouton Home du menu
        $data->menu['Home'] = "index.php";
        #On crée le bouton A propos du menu
        $data->menu['A Propos'] = "index.php?action=aPropos";
        #On définit la taille par défaut des images
        $size = 480;
        #On crée le boutoon Voir Photos qui permet d'accéder aux photos
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        #On vérifie qu'un utilisateur est connecté
        #Si aucun utilisateur est connecté on crée les boutons Identification est S'inscrire
        if(isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->content = "inscriptionView.php";
        require_once 'view/mainView.php';
    }
    
    #Fonction qui s'occupe de l'inscription
    public function inscription() {
        #On vérifie que l'utilisateur a bien entré un pseudo et un mot de passe
        if(isset($_POST['pseudo']) && isset($_POST['password'])) {
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $size = 480;
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
            #On appele la fonction createUser de utilisateurDAO pour créer le nouvel utilisateur dans la base de donnée
            $this->utilisateurDAO->createUser($_POST['pseudo'], $_POST['password']);
            #On crée un message pour informer l'utilisateur
            $data->logMessage =  "Nouvel Utilisateur créé.";
            if(isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            $data->content = "homeView.php";
            require_once 'view/mainView.php';
        #Si l'utilisateur n'a pas entré un pseudo ou un mot de passe
        #On le redirige vers le formulaire en lui indiquant l'erreur avec un message
        } else {
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $size = 480;
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
            #Message d'erreur à afficher à l'utilisateur
            $data->messageErreur = "Veuillez entrez un pseudo et un mot de passe";
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