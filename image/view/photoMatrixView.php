<div id="corps">
			<?php 
                                if(isset($_GET["nbImg"])){
                                    $nbImg = $_GET["nbImg"];
                                }
                                if(isset($_GET["size"])) {
                                    $size = $_GET["size"];
                                }
                                print "<p>\n";
				print "<a href=\"index.php?controller=photoMatrix&action=prev&imgId=$data->PrevImgId&size=$size&nbImg=$nbImg\">Prev</a> ";
				print "<a href=\"index.php?controller=photoMatrix&action=next&imgId=$data->NextImgId&size=$size&nbImg=$nbImg\">Next</a> ";
				print "</p>\n";
                                foreach($data->tabData as $img) {
                                    #die(var_dump($data->tabData[1]->getId()));
                                    print "<a href=\"index.php?controller=photo&action=index&imgId=".$img->getId()."&size=480\"><img src=\"".$img->getPath()."\" width=\"".$size."\" height=\"".$size."\"></a>\n";
                                }                                
			?>		
</div>

