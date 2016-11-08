<?php
    require_once 'utilisateur.php';
    
    class utilisateurDAO {
        public function __construct() {
            $dsn = 'sqlite:/home/pereirke/Documents/Developpement_php/tp3/image/model/data/image.db';
            $user = '';
            $pass = '';
            try {
                $this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO
            } catch (PDOException $e) {
                die ("Erreur : ".$e->getMessage());
            }
        }
        
        public function getUserById($id){
            $s = $this->db->query('SELECT * FROM utilisateur WHERE id='.$id);
            if($s) {
                $req = $s->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
                return $req[0];
            } else {
                print "Error in getUserById. id=".$id."<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
        }
        
        public function getUserByPseudo($pseudo) {
            $s = $this->db->query('SELECT * FROM utilisateur WHERE pseudo=\''.$pseudo.'\'');
            if($s) {
                $req = $s->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
                return $req[0];
            } else {
                print "Error in getUserByPseudo. pseudo=".$pseudo."<br/>";
                $err= $this->db->errorInfo();
                print $err[2]."<br/>";
            }
        }
        
        public function createUser($pseudo,$password) {
            $this->db->exec("INSERT INTO utilisateur VALUES(null,'$pseudo','$password')");
        }
    }

