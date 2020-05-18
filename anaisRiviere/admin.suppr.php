<?php include('inc/admin.header.php') ?>
<?php
if(!internauteEstConnecte()) header("location:connexion.php");
if(!empty($_POST)) {

    
    
    $requeteSQL = "UPDATE experiences SET deletion_flag = 1 WHERE id_experience = $_POST[supprimer]";
    $result = $pdo->exec($requeteSQL);
    echo "Cette expérience à été supprimée";
    
    //$requeteSQL = "INSERT INTO experiences (poste, employeur, texte, date_debut, date_fin)";
    //$requeteSQL .= " VALUE ('vv', 'vv', 'vv', 'vv', 'vv')";
    // $valeur_id = $_GET["id"];
    // $pdo->exec("UPDATE experiences SET deletion_flag = 1 WHERE id_experience = $valeur_id ");
    //echo $result . ' donnée(s) affectée(s) par la requête UPDATE<br>';
}
?>

<a href="admin.php">Retour</a>
