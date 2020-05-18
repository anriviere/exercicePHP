<?php include('inc/admin.header.php') ?>
<?php
if(!internauteEstConnecte()) header("location:connexion.php");
if (!empty($_POST)) {
    $_POST["poste"] = htmlentities($_POST["poste"], ENT_QUOTES);
    $_POST["employeur"] = htmlentities($_POST["employeur"], ENT_QUOTES);
    $_POST["texte"] = htmlentities($_POST["texte"], ENT_QUOTES);
    $_POST["date_debut"] = htmlentities($_POST["date_debut"], ENT_QUOTES);
    $_POST["date_fin"] = htmlentities($_POST["date_fin"], ENT_QUOTES);

    $requeteSQL = "REPLACE INTO experiences (id_experience, poste, employeur, texte, date_debut, date_fin)";
    $requeteSQL .= " values ('$_POST[id_experience]','$_POST[poste]', '$_POST[employeur]', '$_POST[texte]', '$_POST[date_debut]', '$_POST[date_fin]')";
    //echo $requeteSQL;
    $result = $pdo->exec($requeteSQL);
   


}

?>
<h2>AJOUT EXPERIENCES</h2>
   <?php
          $result = $pdo->query("SELECT * FROM experiences WHERE deletion_flag = 0 ORDER BY id_experience DESC");
          while ($experience = $result->fetch(PDO::FETCH_OBJ)) { ?>
             
             <div >      
              <h3><?php echo $experience->poste; ?></h3>
              <div><?php echo $experience->employeur; ?></div>
              <p><?php echo $experience->texte; ?></p>
            </div>
            <div>
              <span><?php echo $experience->date_debut; ?> - <?php echo $experience->date_fin; ?></span>
              </div>
              <form action="admin.suppr.php" method="POST" >
              <button type="submit" name="supprimer" value="<?php echo $experience->id_experience; ?> " class="btn btn-primary">supprimer</button>
              </form>
              <form action="admin.modif.php" method="POST" >
              <button type="submit" name="modifier" value="<?php echo $experience->id_experience; ?> " class="btn btn-primary">modifier</button>

              </form>
              
            </div>

          <?php } ?>





<div class="starter-template">  
    <form method="POST" action="" enctype='multipart/form-data'>

        <div class="form-group">
            <label for="poste">nom du poste</label>
            <input type="texte" class="form-control" id="poste" name="poste">
        </div>

        <div class="form-group">
            <label for="employeur">employeur</label>
            <input type="texte" class="form-control" id="employeur" name="employeur">
        </div>

        <div class="form-group">
            <label for="texte">description</label>
            <textarea rows="10" class="form-control" id="texte" name="texte"></textarea>
        </div>

        
        <div class="form-group">
            <label for="date_debut">date de début de l'emploi</label>
            <input type="texte" class="form-control" id="date_debut" name="date_debut">
        </div>

        
        <div class="form-group">
            <label for="date_fin">date de fin de l'emploi</label>
            <input type="texte" class="form-control" id="date_fin" name="date_fin">
        </div>

        <input type="hidden" id="id_experience" name="id_experience" value="">

        <button type="submit" class="btn btn-primary">Enregistrer</button>

    </form>
</div>
