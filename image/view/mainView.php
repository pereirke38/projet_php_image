<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
	<head>
		<title>LuKe Image</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" title="Normal" />
	</head>
	<body>
		<div id="entete">
                        <?php
                            foreach ($data->menuHeader as $act => $item) {
                                print "<a href=$item>$act</a>";
                            }
                        ?>
			<h1>LuKe Image</h1>
		</div>
		<div id="menu">		
			<h3>Menu</h3>
			<ul>
				<?php
                                    
                                    foreach($data->menu as $act => $item) {
                                        print "<li><a href=$item>$act</a></li>\n";
                                    }
				?>
			</ul>
		</div>
                <?php
                    include ($data->content);
                ?>		
		<div id="pied_de_page">
		</div>	   	   	
	</body>
</html>