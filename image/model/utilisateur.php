<?php
    #Notion d'utilisateur
    class Utilisateur {
        private $id = 0;
        private $pseudo = "";
        private $password = "";
        
        function __construct(){}
    
        function getId() {
            return $this->id;
        }

        function getPseudo() {
            return $this->pseudo;
        }

        function getPassword() {
            return $this->password;
        }
    }
?>