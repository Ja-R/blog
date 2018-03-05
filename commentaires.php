<?php

try
{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires blog</title>
  </head>
  <body>

    <h1>Un blog</h1>
    <a href="index.php">Retour à la liste des billets</a>

    <?php
    try
    {
    	$bdd = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('SELECT id, titre, contenu,
      DATE_FORMAT(date_billet, \'%d/%m/%Y à %Hh%imin%ss\') AS datebfr
      FROM billets
      WHERE id = ?');
    $req->execute(array($_GET['numbillet']));
    $donnees = $req->fetch();



    ?>
      <div class="news">
        <h3>
          <?php echo htmlspecialchars($donnees['titre']) . ' '; ?>
          posté le
          <?php echo htmlspecialchars($donnees['datebfr']); ?>
        </h3>
        <p>
          <?php echo htmlspecialchars($donnees['contenu']); ?>
        </p>
      </div>
    <?php

    $req->closeCursor();
    ?>

    <p>Commentaires :</p>
    <?php

    $request = $bdd->prepare('SELECT id, id_billet, auteur, commentaire,
      DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS datecfr
      FROM commentaires
      WHERE id_billet = ?');

    $request->execute(array($_GET['numbillet']));

    while ($donnees = $request->fetch())
    {
    	echo '<strong>' . $donnees['auteur'] . '</strong>' . ' a ecrit le ' . $donnees['datecfr'] . ' </br>' . $donnees['commentaire'] . '<hr>';
    }

    $request->closeCursor();

    ?>
  </body>
</html>
