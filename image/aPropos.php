<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>Site SIL3</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="Normal" />
		</head>
	<body>
		<div id="entete">
			<h1>Site SIL3</h1>
			</div>
		<div id="menu">		
			<h3>Menu</h3>
			<ul>
				<?php # Mise en place du menu par un parcours de la table associative
					$menu['Home']="index.php";
					$menu['A propos']="aPropos.php";
					$menu['Voir photos']="viewPhoto.php";
					
					foreach ($menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
				</ul>
			</div>
		
		<div id="corps">
			<h1> Information !</h1>
			<p> Cette application  a pour but de mettre en pratique  le modèle MVC en PHP par l'équipe de SIL3 de l'IUT2 de Grenoble. </p> 
			</p> Cette version utilise les images sur le disque</p>
			</div>
		
		<div id="pied_de_page">
			</div>	   	   	
		</body>
	</html>




