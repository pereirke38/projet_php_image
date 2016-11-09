<div id="corps">
			<?php 
                                
                                print "<p>\n";
				print "<a href=\"index.php?controller=mesPhoto&action=prev&size=$size&max=$data->max\">Prev</a> ";
				print "<a href=\"index.php?controller=mesPhoto&action=next&action=next&size=$size&max=$data->max\">Next</a> ";
				print "</p>\n";
                                for($data->iter; $data->iter < $data->max; $data->iter++) {
                                    #die(var_dump($data->tabData[1]->getId()));
                                    print "<a href=\"index.php?controller=photo&action=index&imgId=".$data->tabData[$data->iter]->getId()."&size=480\"><img src=\"".$data->tabData[$data->iter]->getPath()."\" width=\"".$size."\" height=\"".$size."\"></a>\n";
                                }                                
			?>		
</div>

