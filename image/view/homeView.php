<div id="corps">
        <h1> Bonjour !</h1>
        <p> Cette application vous permet de manipuler des photos <br/>
        Vous pouvez : naviguer, partager, classer en album </p> 
        <?php
            if(isset($data->messageDeconnexion)) {
                print "<p>".$data->messageDeconnexion."</p>";
            }
        ?>
</div>



