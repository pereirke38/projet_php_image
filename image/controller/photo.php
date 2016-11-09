<?php
require_once 'model/imageDAO.php';
class Photo {
        
    protected $imageDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
    }
    
    #Récupère la première image en base puis l'affiche
    function First() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&imgId=$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&$firstImageId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
        $data->imageURL = $this->imageDAO->getImage($firstImageId)->getPath();
        #Récpère l'id de l'image suivante
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getFirstImage())->getId();
        #Récupère l'id de l'image suivante
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getFirstImage())->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupère et affiche l'image suivante
    function next() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
    
    #Récupère et affiche l'image précedente
    function prev() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
    
    #Récupère et affiche une image au hasard
    function Random() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
           $imgId = $firstImageId;
        }
        #Récupération de l'image au hasard
        $img = $this->imageDAO->getRandomImage();
        #la variable $imgId prend la valeur de l'id de l'image choisieau hasard
        $imgId = $img->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
    
    #Effectue un zoom sur une image
    function zoom() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        if(isset($_GET['zoom'])){
            $size *= $_GET['zoom'];
            $_GET['size'] = $size;
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
    
    #Permet à un utilisateur connecté de supprimer une image lui appartenant
    function supprimer() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        } else {
            $size = 480;
        }
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
        #On verifie si l'utilisateur est connecté pour afficher les boutons qui lui permet d'ajouter ou de consulter ses images
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            #On vérifie que l'image affichée appartient bien à l'utilisateur
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
    
    #Affiche une image en fonction de son id
    #Si aucun id on affiche la première image
    function index() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        }   
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        }
        else {
            $this->First();
            $imgId = $firstImageId;
            $_GET["imgId"] = $firstImageId;
        }
        
        $data->menu['Home'] = "index.php";
        $data->menu['A Propos'] = "index.php?action=aPropos";
        $data->menu['First'] = "index.php?controller=photo&action=First&$firstImageId&size=$size";
        $data->menu['Random'] = "index.php?controller=photo&action=Random&imgId=$imgId&size=$size";
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
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
