<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {
		
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin LOCAL où se trouvent les images
		private $path="model/IMG";
		# Chemin URL où se trouvent les images
		const urlPath="http://localhost/image/model/IMG";
		
		# Tableau pour stocker tous les chemins des images
		private $imgEntry;
		
		# Lecture récursive d'un répertoire d'images
		# Ce ne sont pas des objets qui sont stockes mais juste
		# des chemins vers les images.
		private function readDir($dir) {
			# build the full path using location of the image base
			$fdir=$this->path.$dir;
			if (is_dir($fdir)) {
				$d = opendir($fdir);
				while (($file = readdir($d)) !== false) {
					if (is_dir($fdir."/".$file)) {
						# This entry is a directory, just have to avoid . and .. or anything starts with '.'
						if (($file[0] != '.')) {
							# a recursive call
							$this->readDir($dir."/".$file);
						}
					} else {
						# a simple file, store it in the file list
						if (($file[0] != '.')) {
							$this->imgEntry[]="$dir/$file";
						}
					}
				}
			}
		}
		
	
		
		public function __construct() {
                    $dsn = 'sqlite:/home/pereirke/Documents/Developpement_php/tp3_bis/projet_php_image/image/model/data/image.db'; // Data source name
                    $user= ''; // Utilisateur
                    $pass= ''; // Mot de passe
                    try {
                      $this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO
                    } catch (PDOException $e) {
                      die ("Erreur : ".$e->getMessage());
                    }
                }
		
		# Retourne le nombre d'images référencées dans le DAO
		public function size() {
                    $req = $this->db->query('SELECT max(id) FROM image');
                    $res = $req->fetch(PDO::FETCH_LAZY);
                    $size = $res['max(id)'];
                    return $size;
                    
                }
		
		# Retourne un objet image correspondant à l'identifiant
		public function getImage($id) {
                    $s = $this->db->query('SELECT * FROM image WHERE id='.$id);
                    if ($s) {
                      /*$res = $s->fetch();
                      $img = new Image($res['id'], $res['path']);
                      return $img;*/
                      $req = $s->fetchAll(PDO::FETCH_CLASS,"Image");
                      if (count($req) == 0) {
                          return NULL;
                      } else {
                          return $req[0];
                      }
                    } else {
                      print "Error in getImage. id=".$id."<br/>";
                      $err= $this->db->errorInfo();
                      print $err[2]."<br/>";
                    }
                }
		
		# Retourne une image au hazard
		public function getRandomImage() {
			/*trigger_error("Non réalisé");*/
                        $randId = rand(1,$this->size());
                        if($this->getImage($randId) != NULL) {
                            return $this->getImage($randId);
                        } else {
                            if($randId - 1 <= $this->size() - $randId) {
                                $i = 1;
                                while ($this->getImage($randId + $i)) {
                                    $i++;
                                }
                                return $this->getImage($randId + $i);
                            } else {
                                $i = 1;
                                while ($this->getImage($randId - $i)) {
                                    $i++;
                                }
                                return $this->getImage($randId - $i);
                            }
                        }
		}
		
		# Retourne l'objet de la premiere image
		public function getFirstImage() {
                    $i = 1;
                    while($this->getImage($i) == NULL) {
                        $i++;
                    }
                    return $this->getImage($i);
		}
		
		# Retourne l'image suivante d'une image
		public function getNextImage(image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
                                if($img == NULL) {
                                    $i = 1;
                                    while($img == NULL) {
                                       $img = $this->getImage($id + $i); 
                                       $i++;
                                    }
                                }
			}
			return $img;
		}
		
		# Retourne l'image précédente d'une image
		public function getPrevImage(image $img) {
			$id = $img->getId();
                        if ($id > $this->getFirstImage()->getId()) {
                                $img = $this->getImage($id-1);
                                if($img == NULL) {
                                    $i = 1;
                                    while($img == NULL) {
                                       $img = $this->getImage($id - $i); 
                                       $i++;
                                    }
                                }
                        }
                        return $img;
		}
		
		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		public function jumpToImage(image $img,$nb) {
			#trigger_error("Non réalisé");
                        $id = $img->getId();
                        if($id + $nb <= $this->size() && $id + $nb >= 1) {
                            $img = $this->getImage($id+$nb);
                            if($img == NULL) {
                                $i = 1;
                                while($img == NULL) {
                                   $img = $this->getImage($id + $i); 
                                   $i++;
                                }
                            }
                        }
                        return $img;
		}
		
		# Retourne la liste des images consécutives à partir d'une image
		public function getImageList(image $img,$nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
                        $res = array();
			while ($id < $this->size() && count($res) < $nb) {
                                if($this->getImage($id) != NULL) {
                                    $res[] = $this->getImage($id);   
                                }
				$id++;
			}
			return $res;
		}
                
                public function getUtilisateur(Image $img) {
                    return $img->getUserId();
                }
                
                public function supprimerImage($imgId) {
                    $this->db->exec("DELETE FROM image WHERE id=".intval($imgId));
                }
                
                public function getImageByUser($userId) {
                    $s = $this->db->query('SELECT * FROM image WHERE userId='.$userId);
                    if ($s) {
                      /*$res = $s->fetch();
                      $img = new Image($res['id'], $res['path']);
                      return $img;*/
                      $req = $s->fetchAll(PDO::FETCH_CLASS,"Image");
                      if (count($req) == 0) {
                          return NULL;
                      } else {
                          return $req;
                      }
                    } else {
                      print "Error in getImage. id=".$id."<br/>";
                      $err= $this->db->errorInfo();
                      print $err[2]."<br/>";
                    }
                }
                public function addImage($path, $cat, $com, $userId){
                    // Récupère le dernier ID d'image
                    $id = $this->size()+1;

                    $stmt = $this->db->prepare("INSERT INTO image (id, path, category, comment, userId) VALUES (:id, :path, :category, :comment, :userId)");
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':path', $path);
                    $stmt->bindParam(':category', $cat);
                    $stmt->bindParam(':comment', $com);
                    $stmt->bindParam(':userId', $userId);

                    return $stmt->execute();
                }
	}
	
	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage();
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";
                $nextImg = $imgDAO->getNextImage($img);
                echo "<p> L'image suivante est : ".$nextImg->getURL()."</p>\n";
                echo "<img src=\"".$nextImg->getURL()."\"/>\n";
                $prevImg = $imgDAO->getPrevImage($nextImg);
                echo "<p> L'image précédente est : ".$prevImg->getURL()."</p>\n";
                echo "<img src=\"".$prevImg->getURL()."\"/>\n";
                $randImg = $imgDAO->getRandomImage();
                echo "<p> Une image aléatoire : ".$randImg->getURL()."</p>\n";
                echo "<img src=\"".$randImg->getURL()."\"/>\n";
                
	}
	
	
	?>