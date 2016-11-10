<?php
require_once 'model/imageDAO.php';
require_once 'data.php';
class Photo {
        
    protected $imageDAO;
    
    public function __construct() {
        $this->imageDAO = new imageDAO();
    }
    
    function createMenu() {
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        } else {
            $size = 480;
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
        $data->menu['More'] = "index.php?controller=photoMatrix&action=more&size=$size&imgId=$imgId&nbImg=1&coeff=2";
        $data->menu['Zoom +'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=1.25";
        $data->menu['Zoom -'] = "index.php?controller=photo&action=zoom&imgId=$imgId&size=$size&zoom=0.75";
        if (isset($_SESSION['id'])) {
            $data->menu['Mes Images'] = "index.php?controller=mesPhoto&action=index";
            $data->menu['Ajouter image'] = "index.php?controller=ajoutImage&action=index";
            if($_SESSION['id'] == $this->imageDAO->getUtilisateur($this->imageDAO->getImage($imgId))){
                $data->menu['Supprimer image'] = "index.php?controller=photo&action=supprimer&imgId=".$imgId;
            }
        }
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
    
    #Récupère la première image en base puis l'affiche
    function First() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
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
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupère et affiche l'image précedente
    function prev() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Récupère et affiche une image au hasard
    function Random() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        $img = $this->imageDAO->getRandomImage();
        $imgId = $img->getId();
        $_GET['imgId'] = $imgId;
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->NextImgId = $this->imageDAO->getNextImage($img)->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($img)->getId();
        $data->imageURL = $img->getPath();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Effectue un zoom sur une image
    function zoom() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["zoom"])) {
            $zoom = $_GET["zoom"];
        } else {
            $zoom = 1;
        }
        if(isset($_GET["size"])) {
            $size = $_GET["size"] * $zoom;
            $_GET["size"] = $size;
        } else {
            $size = 480 * $zoom;
            $_GET["size"] = $size;
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Permet à un utilisateur connecté de supprimer une image lui appartenant
    function supprimer() {
        $firstImageId = $this->imageDAO->getFirstImage()->getId();
        if(isset($_GET["imgId"])) {
            $imgId = $_GET["imgId"];
        } else {
            $imgId = $firstImageId;
        }
        if(isset($_GET["size"])){
            $size = $_GET["size"];
        } else {
            $size = 480;
        }
        $data = new Data();
        if($imgId < $this->imageDAO->size()) {
            $image = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId));
            $data->imageURL = $image->getPath();
            $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($image->getId()))->getId();
            $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($image->getId()))->getId();
        } else {
            $image = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId));
            $image->getPath();
            $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($image->getId()))->getId();
            $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($image->getId()))->getId();
        }
        $this->imageDAO->supprimerImage($imgId);
        $imgId = $image->getId();
        $_GET['imgId']= $imgId;
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->messageSupression = "Image supprimée";
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
    
    #Affiche une image en fonction de son id
    #Si aucun id on affiche la première image
    function index() {
        if(isset($_GET['imgId'])) {
            $imgId = $_GET['imgId'];
        } else {
            $imgId = $this->imageDAO->getFirstImage()->getId();
        }
        $data = new Data();
        $menus = $this->createMenu();
        $data->menu = $menus;
        $menus = $this->createMenuHeader();
        $data->menuHeader = $menus;
        $data->imageURL = $this->imageDAO->getImage($imgId)->getPath();
        $data->NextImgId = $this->imageDAO->getNextImage($this->imageDAO->getImage($imgId))->getId();
        $data->PrevImgId = $this->imageDAO->getPrevImage($this->imageDAO->getImage($imgId))->getId();
        $data->content = 'photoView.php';
        require_once 'view/mainView.php';
    }
}
