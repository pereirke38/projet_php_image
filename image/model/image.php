<?php
  
  # Notion d'image
  class Image {
    private $id=0;
    //private $url="";
    private $path = "";
    private $userId = 0;
    
    /*function __construct($id,$url) {
      $this->id = $id;
      $this->url = $url;
    }*/
    
    /*function __construct($id,$path) {
        $this->id = $id;
        $this->path = $path;
    }*/
    
    function __construc(){}
    
    # Retourne l'URL de cette image
    /*function getURL() {
		return $this->url;
    }*/
    
    function getPath() {
        return $this->path;
    }
    function getId() {
      return $this->id;
    }
    function getUserId() {
        return $this->userId;
    }
  }
  
  
?>