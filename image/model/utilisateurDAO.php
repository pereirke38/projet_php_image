<?php
    require_once 'utilisateur.php';
    
    class utilisateurDAO {
        public function __construct() {
            $dsn = 'sqlite:/home/pereirke/Documents/Developpement_php/tp3_bis/projet_php_image/image/model/data/image.db';
            $user = '';
            $pass = '';
            try {
                $this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO
            } catch (PDOException $e) {
                die ("Erreur : ".$e->getMessage());
            }
        }
        
        #Récupère un utilisateur en base en fonction de son id
        public function getUserById($id){
            $s = $this->db->query('SELECT * FROM utilisateur WHERE id='.$id);
            if($s) {
                $req = $s->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
                if (count($req) == 0) {
                    return NULL;
                } else {
                    return $req[0];
                }
            } else {
                print "Error in getUserById. id=".$id."<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
        }
        
        #Récupère un utilisateur en base en fonction de son pseudo
        public function getUserByPseudo($pseudo) {
            $s = $this->db->query('SELECT * FROM utilisateur WHERE pseudo=\''.$pseudo.'\'');
            if($s) {
                $req = $s->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
                if (count($req) == 0) {
                    return NULL;
                } else {
                    return $req[0];
                }
            } else {
                print "Error in getUserByPseudo. pseudo=".$pseudo."<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
        }
        
        #Crée un utilisateur
        public function createUser($pseudo,$password) {
            $this->db->exec("INSERT INTO utilisateur VALUES(null,'$pseudo','$password')");
        }
    }

