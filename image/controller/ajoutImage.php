<?php
session_start();
require_once 'data.php';
require_once 'model/imageDAO.php';

class AjoutImage {

    public function __construct() {
        $this->imageDAO = new imageDAO();
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
        $data->content = 'ajoutView.php';
        require_once "view/mainView.php";
    }

    function upload() {
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
        $data->content = 'ajoutView.php';
        require_once "view/mainView.php";
    }
}