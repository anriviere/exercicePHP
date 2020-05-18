<?php include('inc/admin.header.php') ?>
<h2>MODIFIER PROFIL</h2>
<?php
if(!internauteEstConnecte()) header("location:connexion.php");
if (!empty($_POST)) {
    if(!empty($_POST['nouveau'])){
        unset($_POST);
    }
    elseif (empty($_POST['modifier'])){
        $name = "";
        if (!empty($_FILES)) {
            foreach ($_FILES["img"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["img"]["tmp_name"][$key];
                    $name = basename($_FILES["img"]["name"][$key]);
                    move_uploaded_file($tmp_name, "img/$name");
                }
            }
        }
    
            $_POST["prenom"] = htmlentities($_POST["prenom"], ENT_QUOTES);
            $_POST["nom"] = htmlentities($_POST["nom"], ENT_QUOTES);
            $_POST["adresse"] = htmlentities($_POST["adresse"], ENT_QUOTES);
            $_POST["code_postal"] = htmlentities($_POST["code_postal"], ENT_QUOTES);
            $_POST["ville"] = htmlentities($_POST["ville"], ENT_QUOTES);
            $_POST["mail"] = htmlentities($_POST["mail"], ENT_QUOTES);
            $_POST["presentation"] = htmlentities($_POST["presentation"], ENT_QUOTES);
        
            $requeteSQL = "REPLACE INTO profil (id_profil, prenom, nom, adresse, code_postal, ville, mail, presentation, photo_profil)";
            $requeteSQL .= " values ('1','$_POST[prenom]', '$_POST[nom]', '$_POST[adresse]', '$_POST[code_postal]', '$_POST[ville]', '$_POST[mail]', '$_POST[presentation]','img/$name')";
            //echo $requeteSQL;
            $result = $pdo->exec($requeteSQL);


    }

    
    
   


}

if(!empty($_POST['modifier']))
    { 
        $result = $pdo->query("SELECT * FROM profil WHERE deletion_flag = 0 AND id_profil = $_POST[modifier]");
        $profil_modifie = $result->fetch(PDO::FETCH_OBJ);
    }

?>


   <?php
          $result = $pdo->query("SELECT * FROM profil WHERE deletion_flag = 0 ORDER BY id_profil DESC");
          while ($profil = $result->fetch(PDO::FETCH_OBJ)) { ?>
             
             <div >      
              <h3><?php echo $profil->prenom ;?>  <?php echo $profil->nom ;?></h3>
              <div><?php echo $profil->adresse; ?></div>
              <div><?php echo $profil->code_postal;?>  <?php echo $profil->ville;?></div>
              <p><?php echo $profil->mail; ?></p>
              <p><?php echo $profil->presentation; ?></p>
              <img src="<?php echo $profil->photo_profil; ?>" class="card-img-top" alt="...">
            </div>
            
              <form action="admin.profil.php" method="POST" >
              <button type="submit" name="modifier" value=" <?php echo $profil->id_profil; ?>" class="btn btn-primary">modifier</button>

              </form>
              
            </div>

          <?php } ?>



<div>
<form method="POST" action="" enctype='multipart/form-data'>

        <div class="form-group">
            <label for="prenom">prenom</label>
            <input type="text" id="prenom" name="prenom" value="<?php if(isset($profil_modifie->prenom))  echo $profil_modifie->prenom ; ?>"> <br><br>
        </div>

        <div class="form-group">
            <label for="nom">nom</label>
            <input type="text" id="nom" name="nom" value="<?php if(isset($profil_modifie->nom)) echo $profil_modifie->nom ; ?>"> <br><br>
         
        </div>

        

        <div class="form-group">
            <label for="adresse">adresse</label>
            <input type="texte" id="adresse" name="adresse" value="<?php if(isset($profil_modifie->adresse)) echo $profil_modifie->adresse ; ?>">
        </div>

        
        <div class="form-group">
            <label for="code_postal">code postal</label>
            <input type="texte" id="code_postal" name="code_postal" value="<?php if(isset($profil_modifie->code_postal)) echo $profil_modifie->code_postal ; ?>">
        </div>

        
        <div class="form-group">
            <label for="ville">ville</label>
            <input type="texte" id="ville" name="ville" value="<?php if(isset($profil_modifie->ville)) echo $profil_modifie->ville ; ?>">
        </div>

        <div class="form-group">
            <label for="mail">mail</label>
            <input type="texte" id="mail" name="mail" value="<?php if(isset($profil_modifie->mail)) echo $profil_modifie->mail ; ?>">
        </div>

        <div class="form-group">
            <label for="presentation">présentation</label>
            <textarea rows="10"  id="presentation" name="presentation"><?php if(isset($profil_modifie->presentation)) echo $profil_modifie->presentation ; ?></textarea>
        </div>

        <div class="form-group">
            <label for="titre">Photo</label>
            <input type="file" class="form-control-file" id="img" name="img[]">
        <?php
        if(isset($profil_modifie))
        {?>
            <img src="<?php echo $profil_modifie->photo_profil?>"><br>';
            <input type="hidden" name="img[]" value="<?php $profil_modifie->photo_profil ?> "><br>';
        <?php }?>
        
        </div>

        <input type="hidden" id="id_profil" name="id_profil" value="<?php if(isset($profil_modifie->id_profil)) echo "1" ; ?>">

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="submit" name="nouveau" class="btn btn-primary">Nouveau</button>

    </form>



</div>