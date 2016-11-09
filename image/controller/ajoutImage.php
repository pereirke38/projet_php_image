<?php
# Récupération de l'objet data
require_once 'data.php';
#Récupération de imageDAO
require_once 'model/imageDAO.php';

#Controller gérant l'ajout d'images
class AjoutImage {

    public function __construct() {
        $this->imageDAO = new imageDAO();
    }

    function index() {
        #Création d'un objet Data
        $data = new Data();
        #Création du bouton Home du menu
        $data->menu['Home'] = "index.php";
        #Création du bouton A Propos du menu
        $data->menu['A Propos'] = "index.php?action=aPropos";
        # définition de la taille par défaut des images
        $size = 480;
        #Créer le bouton Voir Photos du menu qui permet d'accéder aux photos
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
        #On récupère la vue correspondante
        $data->content = 'ajoutView.php';
        #On rappelle la vue principale
        require_once "view/mainView.php";
    }
    
    #Fonction qui gère l'upload d'images
    function upload() {
        #Création d'un objet Data
        $data = new Data();

        // Gère l'upload d'image
        if (isset($_FILES)){
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $extension_upload = strtolower(  substr(  strrchr($_FILES['newPicture']['name'], '.')  ,1)  );
            if ( in_array($extension_upload, $extensions_valides) ) {
                $random = md5(uniqid(rand(), true));
                $nom = $_SERVER['DOCUMENT_ROOT']."/jons/uploadedPictures/".$random.".".$extension_upload;
                $resultat = move_uploaded_file($_FILES['newPicture']['tmp_name'],$nom);
                if ($resultat) {
                    $ok = $this->imageDAO->addImage("jons/uploadedPictures/".$random.".".$extension_upload, 'Images personnelles', '', $_SESSION['id']);
                    if ($ok){
                        $data->msgUpload = "Image envoyée avec succès";
                    } else {
                        $data->msgUpload = "Erreur lors de l'enregistrement de la photo en base de donnée";
                    }
                } else {
                    $data->msgUpload = "Erreur lors de la copie du fichier sur le serveur";
                }
            } else {
                $data->msgUpload = "Le type de fichier n'est pas valide";
            }
        }
        #Création du bouton Home du menu
        $data->menu['Home'] = "index.php";
        #Création du bouton A propos du menu
        $data->menu['A Propos'] = "index.php?action=aPropos";
        # définition de la taille par défaut des images
        $size = 480;
        #Créer le bouton Voir Photos du menu qui permet d'accéder aux photos
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
        #On récupère la vue correspondante
        $data->content = 'ajoutView.php';
        #On appelle la vue principale
        require_once "view/mainView.php";
    }
}