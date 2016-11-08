<?php
session_start();
require_once 'model/imageDAO.php';
class Photo {
        
    protected $imageDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
    }
    
    function First() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=1&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getFirstImage()->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getFirstImage())->getId();
        $data->PrevImgId = $this->imageDAO->getNextImage($this->imageDAO->getFirstImage())->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    function next() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    function prev() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    function Random() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $img = $this->imageDAO->getRandomImage();
        $imgId = $img->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->NextImgId = $this->imageDAO->getNextImage($img)->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($img)->getId();
        $data->imageURL = $img->getPath();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    function zoom() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
        
    }
    
    function dezoom() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;  
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    function supprimer() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        } else {
            $size = 480;
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;  
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $this->imageDAO->supprimerImage($imgId);
        $data->content = 'supprimerView.php';
        require_once 'view/mainView.php';
    }
    
    function index() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        else {
            $this->First();
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=1&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=".$size*1.15;
        $data->menu['Zoom -'] = "index.php?controller=photo&action=dezoom&imgId=$imgId&size=".$size/1.15;
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
        if(!isset($_SESSION['id'])) {
            $data->menuHeader['Identification'] = "index.php?controller=login&action=index";
            $data->menuHeader['S\'inscrire'] = "index.php?controller=inscription&action=index";
        } else {
            $data->menuHeader['Déconnexion'] = "index.php?controller=login&action=deconnexion";
        }
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
}
