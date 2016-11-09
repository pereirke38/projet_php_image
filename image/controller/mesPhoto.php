<?php
    require_once 'model/imageDAO.php';
    class mesPhoto {

        protected $imageDAO;

        public function __construct() {
            $this->imageDAO = new imageDAO();
        }
        
        #Affiche la première page des images de l'utilisateur
        public function index() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
            #Calcul de la taille de l'image
            $size = 480/sqrt(20);
            $firstImageId = $this->imageDAO->getFirstImage()->getId();
            if(isset($_GET["imgId"])) {
                $imgId = $_GET["imgId"];
            } else {
                $imgId = $firstImageId;
            }
             if(isset($_GET["nbImg"])) {
                $nbImg = $_GET["nbImg"];
            }
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&&size=$size";
            if(!isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            #Variable d'iteration
            $data->iter = 0;
            #Nombre d'images à afficher par pages
            $data->max = 24;
            #Tableau contenant les images d'un utilisateur
            $data->tabData = $this->imageDAO->getImageByUser($_SESSION['id']);
            #Si l'utilisateur a moin de 24 images on ajuste le nombre d'image à afficher
            if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
        
        #Permet de passer à la page suivante de l'album de l'utilisateur
        public function next() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
            $size = 480/sqrt(20);
            $firstImageId = $this->imageDAO->getFirstImage()->getId();
            #On récupère le nombre maximale pour l'iteration
            if(isset($_GET['max'])) {
                $max = $_GET["max"];
            }
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&size=$size";
            if(!isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            #iter prend l'ancienne valeur de max
            $data->iter = $max;
            #On augmente max de 24 pour continuer à afficher 24 images
            $data->max = $max + 24;
            
            $data->tabData = $this->imageDAO->getImageByUser($_SESSION['id']);
            #On vérifie si la valeur max est supérieure à la taille du tableau tabData
            #et si la taille dutableau est supérieure à 25
            #si oui max prend la valeur de la taille du tableau
            if($data->max  > count($data->tabData) && count($data->tabData) > 25) {
                $data->max = count($data->tabData);
            #Si la valeure de max est supérieure à la taille du tableau
            #et si la taille du tableau est inférieure à 25
            #max prend comme valeure la taille du tableau et iter prends pour valeur 0
            } else if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
                $data->iter = 0;
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
        
        #Permet à l'utilisateur d'accéder à la page précédente de son album
        public function prev() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
            $size = 480/sqrt(20);
            $firstImageId = $this->imageDAO->getFirstImage()->getId();
            #On récupère la valeure de max
            if(isset($_GET['max'])) {
                $max = $_GET["max"];
            }
            $data->menu['Home'] = "index.php";
            $data->menu['A Propos'] = "index.php?action=aPropos";
            $data->menu['Voir Photos'] = "index.php?controller=photo&action=index&size=$size";
            if(!isset($_SESSION['id'])) {
                $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
                $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
            } else {
                $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
            }
            $data->max = $max - 24;
            
            $data->tabData = $this->imageDAO->getImageByUser($_SESSION['id']);
            #Si max < 24 cela veut dire que l'on doit afficher les 24 premieres images
            if($data->max  <= 24) {
                $data->max = 24;
                $data->iter = 0;
            #sinon iter prend pour valeur max - 24
            } else {
                $data->iter = $data->max -24;
            }
            #Si l'utilisateur à moin de 24 images
            if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
    }
?>