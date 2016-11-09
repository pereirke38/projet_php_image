<?php
require_once 'model/imageDAO.php';
class PhotoMatrix {
    
    protected $imageDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
    }
    
    #Retourne à la 1 + n images
    function First() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
         if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&imgId=$imgId&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=1&nbImg=".$nbImg*2;
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&imgId=$imgId&nbImg=".$nbImg/2;
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $firstImage = $this->imageDAO->getFirstImage();
        $data->tabData = $this->imageDAO->getImageList($firstImage, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupre et affiche les n suivantes images
    function Next() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
         if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&imgId=$imgId&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=".$nbImg*2;
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&imgId=$imgId&nbImg=".$nbImg/2;
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $image = $this->imageDAO->getImage($imgId);
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupère et affiche les n précédentes images
    function Prev() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
         if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&imgId=$imgId&size=$size&nbImg=.$nbImg&imgId=$imgId";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=".$nbImg*2;
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&imgId=$imgId&nbImg=".$nbImg/2;
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $image = $this->imageDAO->getImage($imgId);
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    }
    
    #Affiche 1 image et aléatoire et les n suivantes
    function Random() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
         if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        $image = $this->imageDAO->getRandomImage();
        $imgId = $image->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&imgId=$imgId&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=".$nbImg*2;
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&imgId=$imgId&nbImg=".$nbImg/2;
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->tabData = $this->imageDAO->getImageList($image, $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        require_once 'view/mainView.php';
    } 
    
    #Affiche n+1 images
    function more() {
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
        $size = 480 / sqrt($nbImg);
        $_GET["size"] = $size;
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->tabData = $this->imageDAO->getImageList($this->imageDAO->getImage($imgId), $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=".$nbImg*2;
        $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&size=$size&imgId=$imgId&nbImg=".$nbImg/2;
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        require 'view/mainView.php';
    }
    
    #Affiche n-1 images
    function less() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        if(isset($_GET["nbImg"])) {
            $nbImg = $_GET["nbImg"];
        }
        $size = 480 / sqrt($nbImg);
        $_GET["size"] = $size;
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photoMatrix&action=First&imgId=1&size=$size&nbImg=$nbImg";
        $data->menu['Random'] = "index.php?controller=photoMatrix&action=Random&size=$size&nbImg=$nbImg&imgId=$imgId";
        $data->tabData = $this->imageDAO->getImageList($this->imageDAO->getImage($imgId), $nbImg);
        $data->NextImgId = $this->imageDAO->jumpToImage($data->tabData[0], $nbImg)->getId();
        $data->PrevImgId = $this->imageDAO->jumpToImage($data->tabData[0], -$nbImg)->getId();
        $data->content = 'photoMatrixView.php';
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=".$nbImg*2;
        if ($nbImg/2 >= 1) {
            $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&size=$size&imgId=$imgId&nbImg=".$nbImg/2;
        } else {
            $data->menu['Less'] = "index.php?controller=photoMatrix&action=less&size=$size&imgId=$imgId&nbImg=1";
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        require 'view/mainView.php';
    }
    
    function index() {
        
    }
}

