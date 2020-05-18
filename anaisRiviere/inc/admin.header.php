<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscrire un titre ici</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
    <nav>
      <div>
        <ul>
          <li>
            <a href="index.php">Accueil du site</a>
          </li>
          <li>
            <a href="admin.profil.php">profil</a>
          </li>
          <li>
            <a href="admin.education.php">education</a>
          </li>
          <li >
            <a  href="admin.php">Expérience</a>
          </li>
          <li >
            <a  href="connexion.php?action=deconnexion">Se déconnecter</a>
          </li>
          


          
        </ul>
      </div>
  </nav>

<?php
  function internauteEstConnecte()
{ 
    if(!isset($_SESSION['membre'])) return false;
    else return true;
}


?>
<?php include('inc/data.inc.php') ?>

 