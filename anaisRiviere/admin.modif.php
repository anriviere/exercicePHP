<?php include('inc/admin.header.php') ?>

<?php
if(!internauteEstConnecte()) header("location:connexion.php");

if (!empty($_POST)) {


    $result = $pdo->query("SELECT * FROM experiences WHERE deletion_flag = 0 AND id_experience = $_POST[modifier]");
}    
    while ($experience_modifie = $result->fetch(PDO::FETCH_OBJ)) { 
    // $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
    //     $experience_modifie = $resultat->fetch_assoc();   

    echo $experience_modifie->poste ;
        ?>    

    <div class="starter-template">  
        <form method="POST" action="admin.php" enctype='multipart/form-data'>

            <div class="form-group">
                <label for="poste">nom du poste</label>
                <input type="text" id="poste" name="poste" value="<?php echo $experience_modifie->poste ; ?>" ><br><br>
                <!-- <input type="texte" class="form-control" id="poste" name="poste"> -->
                
            </div>

            
        

            <div class="form-group">
                <label for="employeur">employeur</label>
                <input type="text" id="employeur" name="employeur" value="<?php echo $experience_modifie->employeur; ?>" ><br><br>
                <!-- <input type="texte" class="form-control" id="employeur" name="employeur"> -->
            </div>

            <div class="form-group">
                <label for="texte">description</label>
                <textarea rows="10" class="form-control" id="texte" name="texte"><?php echo $experience_modifie->texte; ?></textarea>
            </div>

            
            <div class="form-group">
                <label for="date_debut">date de début de l'emploi</label>
                <!-- <input type="texte" class="form-control" id="date_debut" name="date_debut"> -->
                <input type="text" id="date_debut" name="date_debut" value="<?php echo $experience_modifie->date_debut; ?>" ><br><br>
            </div>

            
            <div class="form-group">
                <label for="date_fin">date de fin de l'emploi</label>
                <input type="text" id="date_fin" name="date_fin" value="<?php echo $experience_modifie->date_fin; ?>" ><br><br>
                <!-- <input type="texte" class="form-control" id="date_fin" name="date_fin"> -->
            </div>

            <div class="form-group">
                <input type="hidden" id="id_experience" name="id_experience" value="<?php echo $experience_modifie->id_experience; ?>" ><br><br>
                <!-- <input type="texte" class="form-control" id="date_fin" name="date_fin"> -->
            </div>




            <button type="submit" class="btn btn-primary">Enregistrer</button>

        </form>
    </div>   
<?php } ?>