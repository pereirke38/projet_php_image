<?php
require_once 'model/imageDAO.php';
require_once 'data.php';
class PhotoMatrix {
    
    protected $imageDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
    }
    
    function createMenu() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
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
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&imgId=$imgId&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=$nbImg&coeff=2";
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=$nbImg&coeff=0.5";
        return $data->menu;
    }
    
    function createMenuHeader() {
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        return $data->menuHeader;
    }
    #Retourne à la 1 + n images
    function First() {
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $firstImage = $this->imageDAO->getFirstImage();
        $data->tabData = $this->imageDAO->getImageList($firstImage, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupre et affiche les n suivantes images
    function Next() {
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $image = $this->imageDAO->getImage($imgId);
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    function Prev() {
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $image = $this->imageDAO->getImage($imgId);
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    #Affiche 1 image et aléatoire et les n suivantes
    function Random() {
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $image = $this->imageDAO->getRandomImage();
        $imgId = $image->getId();
        $_GET['imgId'] = $imgId;
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    } 
    
    #Affiche n+1 images
    function more() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["coeff"])) {
            $coeff = $_GET["coeff"];
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"] * $coeff;
            $_GET["nbImg"] = $nbImg;
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->tabData = $this->imageDAO->getImageList($this->imageDAO->getImage($imgId), $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require 'view/mainView.php';
    }
    
    #Affiche n-1 images
    function less() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["coeff"])) {
            $coeff = $_GET["coeff"];
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"] * $coeff;
            if($nbImg < 1) {
                $nbImg = 1;
            }
            $_GET["nbImg"] = $nbImg;
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
            $size = 480 / sqrt($nbImg);
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->tabData = $this->imageDAO->getImageList($this->imageDAO->getImage($imgId), $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require 'view/mainView.php';
    }
    
    function index() {
        
    }
}

