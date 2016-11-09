<div id="corps">
    <h1>Ajouter une photo</h1>
    <form method="post" action="index.php?controller=ajoutImage&action=upload" enctype="multipart/form-data">
        <label for="newPicture">Sélectionnez une image à importer : (.jpg, jpeg, .gif, .png)</label>
        <input type="file" name="newPicture" id="newPicture" /><br />
        <input type="submit" name="submit" value="Envoyer" />
    </form>
    <?php if (isset($data->msgUpload)) {
        echo "<br /><br /><p>".$data->msgUpload."</p>";
    } ?>
</div>