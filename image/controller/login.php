<?php
require_once 'model/imageDAO.php';
require_once 'model/utilisateurDAO.php';

class Login {
    
    protected $imageDAO;
    protected $utilisateurDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
        $this->utilisateurDAO = new utilisateurDAO();
    }
    
    #Accède au formulaire de connexion
    public function index() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $size = 480;
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
        if(isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->content = "loginView.php";
        require_once 'view/mainView.php';
    }
    
    #Gère la connexion
    public function login() {
        #On récupère l'id de la première image
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        #On vérifie que l'utilisateur a entré un pseudo et un mot de passe
        if(isset($_POST['pseudo']) && isset($_POST['password'])) {
            #On récupère un objet utilisateur à partir du pseudo entré
            $utilisateur = $this->utilisateurDAO->getUserByPseudo($_POST['pseudo']);
            #On vérifie si l'objet utilisateur est null et si le mot de passe entré correspond au mot de passe de l'utilisateur
            if($utilisateur != NULL && $_POST['password'] == $utilisateur->getPassword()){
                $_SESSION['id'] = $utilisateur->getId();
                $_SESSION['pseudo'] = $utilisateur->getPseudo();
                $data->menu['Home'] = "index.php";
                $data->menu['A Propos'] = "index.php?action=aPropos";
                $size = 480;
                $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
                if(!isset($_SESSION['id'])) {
                    $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                    $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
                } else {
                    $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
                }
                $data->content = "logedView.php";
                require_once 'view/mainView.php';
            #Si le pseuod n'existe pas ou si le mot de passe est incorecte 
            #on revoie l'utilisateur sur le formulaire en lui affichant un messsage d'erreur
            } else {
                $data->menu['Home'] = "index.php";
                $data->menu['A Propos'] = "index.php?action=aPropos";
                $size = 480;
                $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
                if(!isset($_SESSION['id'])) {
                    $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                    $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
                } else {
                    $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
                }
                $data->content = "loginView.php";
                #Création du message d'erreur
                $data->messageErreur = "Mauvais Pseudo ou mot de passe";
                require_once 'view/mainView.php';
            }
        #Si aucun pseudo ou mot de passe n'est entré
        #On renvoie l'utilisateur sur la page du formulaire avec un message d'erreur
        } else {
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $size = 480;
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
            if(!isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            $data->content = "loginView.php";
            $data->messageErreur = "Entrez un pseudo ou un mot de passe";
            require_once 'view/mainView.php';
        }
    }
    #Déconnecte l'utilisateur
    public function deconnexion() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        #On efface le contenu de $_SESSION
        $_SESSION = array();
        #On détruit la session
        session_destroy();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $size = 480;
        $data->menu['Voir Photos'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->content = "homeView.php";
        #Message pour avertir l'utilisateur
        $data->messageDeconnexion =  'Deconnexion !';
        require_once 'view/mainView.php';
    }
}