<?php include('inc/data.inc.php') ?>

<?php
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}


if($_POST)
{
    $result = $pdo->query("SELECT * FROM utilisateur WHERE pseudo='$_POST[pseudo]'");

    
        $membre = $result->fetch(PDO::FETCH_OBJ);
        if($membre->pseudo == $_POST['pseudo'])
        {
                if($membre->mdp == $_POST['mdp']) 
            {
                foreach($membre as $indice => $element)
                {
                    if($indice != 'mdp')
                    {
                        $_SESSION['membre'][$indice] = $element;
                    }
                }
                header("location:admin.php");
            }
            else
            {
                echo 'erreur mdp';
            }
        }
        else
        {
            echo 'erreur pseudo';
        }
        

}

//echo $contenu;
?>

<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br> <br>
         
    <label for="mdp">Mot de passe</label><br>
    <input type="text" id="mdp" name="mdp"><br><br>
 
     <input type="submit" value="Se connecter">
     <a  href="index.php">retour site</a>
</form>