<div id="corps">
			<?php 
                                print "<p>\n";
				print "<a href=\"index.php?controller=photo&action=prev&imgId=$data->PrevImgId&size=480\">Prev</a> ";
				print "<a href=\"index.php?controller=photo&action=next&imgId=$data->NextImgId&size=480\">Next</a> ";
				print "</p>\n";
                                if(isset($_GET["size"])) {
                                    $size = $_GET["size"];
                                } else {
                                    $size = 480;
                                }
				print "<img id=\"singlePicture\" src=\"$data->imageURL\" width=$size\"/>";
                                if(isset($data->messageSupression)) {
                                    print "<p>".$data->messageSupression."</p>";
                                }    
                        ?>		
</div>

