<?php include('inc/admin.header.php') ?>
<h2>AJOUT FORMATIONS</h2>
<?php
if(!internauteEstConnecte()) header("location:connexion.php");
if (!empty($_POST)) {
    if(!empty($_POST['nouveau'])){
        unset($_POST);
    }
    elseif(!empty($_POST['supprimer'])){
        
        $requeteSQL = "UPDATE education SET deletion_flag = 1 WHERE id_education = $_POST[supprimer]";
        $result = $pdo->exec($requeteSQL);
        echo "Cette expérience à été supprimée";
        
       
    }
    
    
    elseif (empty($_POST['modifier']))
    {
        $_POST["etablissement_scolaire"] = htmlentities($_POST["etablissement_scolaire"], ENT_QUOTES);
        $_POST["diplome"] = htmlentities($_POST["diplome"], ENT_QUOTES);
        $_POST["commentaires"] = htmlentities($_POST["commentaires"], ENT_QUOTES);
        $_POST["date_debut"] = htmlentities($_POST["date_debut"], ENT_QUOTES);
        $_POST["date_fin"] = htmlentities($_POST["date_fin"], ENT_QUOTES);
    
        $requeteSQL = "REPLACE INTO education (id_education, etablissement_scolaire, diplome, commentaires, date_debut, date_fin)";
        $requeteSQL .= " values ('$_POST[id_education]','$_POST[etablissement_scolaire]', '$_POST[diplome]', '$_POST[commentaires]', '$_POST[date_debut]', '$_POST[date_fin]')";
        //echo $requeteSQL;
        $result = $pdo->exec($requeteSQL);

    }

   


}

?>
   <?php
          $result = $pdo->query("SELECT * FROM education WHERE deletion_flag = 0 ORDER BY id_education DESC");
          while ($education = $result->fetch(PDO::FETCH_OBJ)) { ?>
             
             <div >      
              <h3><?php echo $education->etablissement_scolaire; ?></h3>
              <div><?php echo $education->diplome; ?></div>
              <p><?php echo $education->commentaires; ?></p>
            </div>
            <div>
              <span><?php echo $education->date_debut; ?> - <?php echo $education->date_fin; ?></span>
              </div>
              <form action="admin.education.php" method="POST" >
              <button type="submit" name="supprimer" value="<?php echo $education->id_education; ?>" class="btn btn-primary">supprimer</button>
              </form>
              <form action="admin.education.php" method="POST" >
              <button type="submit" name="modifier" value=" <?php echo $education->id_education; ?>" class="btn btn-primary">modifier</button>

              </form>
              
            </div>

          <?php } ?>

<?php

    if(!empty($_POST['modifier']))
    {
        
        $result = $pdo->query("SELECT * FROM education WHERE deletion_flag = 0 AND id_education = $_POST[modifier]");
        $education_modifie = $result->fetch(PDO::FETCH_OBJ);
    }
?>

<div class="starter-template">  
    <form method="POST" action="" enctype='multipart/form-data'>

        <div class="form-group">
            <label for="etablissement_scolaire">etablissement scolaire</label>
            <input type="text" id="etablissement_scolaire" name="etablissement_scolaire" value="<?php if(isset($education_modifie->etablissement_scolaire))  echo $education_modifie->etablissement_scolaire ; ?>"> <br><br>
                <!-- <input type="texte" class="form-control" id="poste" name="poste"> -->
                <!-- if(isset($education_modifie->etablissement_scolaire)) echo $education_modifie->etablissement_scolaire ; echo "> -->
        </div>

        <div class="form-group">
            <label for="diplome">diplome</label>
            <input type="text" id="diplome" name="diplome" value="<?php if(isset($education_modifie->diplome)) echo $education_modifie->diplome ; ?>"> <br><br>
            <!-- <input type="texte" class="form-control" id="diplome" name="diplome"> -->
        </div>

        <div class="form-group">
            <label for="commentaires">commentaires</label>
            <textarea rows="10"  id="commentaire" name="commentaires"><?php if(isset($education_modifie->commentaires)) echo $education_modifie->commentaires ; ?></textarea>
        </div>

        
        <div class="form-group">
            <label for="date_debut">date de début de la formation</label>
            <input type="texte" id="date_debut" name="date_debut" value="<?php if(isset($education_modifie->date_debut)) echo $education_modifie->date_debut ; ?>">
        </div>

        
        <div class="form-group">
            <label for="date_fin">date de fin de la formation</label>
            <input type="texte" id="date_fin" name="date_fin" value="<?php if(isset($education_modifie->date_fin)) echo $education_modifie->date_fin ; ?>">
        </div>

        <input type="hidden" id="id_education" name="id_education" value="<?php if(isset($education_modifie->id_education)) echo $education_modifie->id_education ; ?>">

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="submit" name="nouveau" class="btn btn-primary">Nouveau</button>

    </form>
</div>