<?php
    session_start();
    require_once 'model/imageDAO.php';
    class mesPhoto {

        protected $imageDAO;

        public function __construct() {
            $this->imageDAO = new imageDAO();
        }
        
        public function index() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
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
            $data->iter = 0;
            $data->max = 24;
            $data->tabData = $this->imageDAO->getImageByUser($_SESSION['id']);
            if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
        public function next() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
            $size = 480/sqrt(20);
            $firstImageId = $this->imageDAO->getFirstImage()->getId();
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
            $data->iter = $max;
            $data->max = $max + 24;
            
            $data->tabData = $this->imageDAO->getImageByUser($_SESSION['id']);
            if($data->max  > count($data->tabData) && count($data->tabData) > 25) {
                $data->max = count($data->tabData);
            } else if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
                $data->iter = 0;
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
        public function prev() {
            if(isset($_GET["size"])){
                $size = $_GET["size"];
            }
            $size = 480/sqrt(20);
            $firstImageId = $this->imageDAO->getFirstImage()->getId();
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
            if($data->max  <= 24) {
                $data->max = 24;
                $data->iter = 0;
            } else {
                $data->iter = $data->max -24;
            }
            if($data->max > count($data->tabData)){
                $data->max = count($data->tabData);
            }
            $data->content = 'mesPhotoView.php';
            require_once 'view/mainView.php';
        }
    }
?>