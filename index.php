<!-- decide quoi afficher, quelle fonction appelées, selon l'info reçu via les pages d'affichage -->
<?php
require('controller/controller.php'); // contient les fonctions appelés

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }
    elseif ($_GET['action'] == 'post') { // (6) appelle la fonction qui publie le com et son billet
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } // (2) l'action est un ajout de commentaire
    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) { // check le billet
          if (isset($_POST['author']) && isset($_POST['comment'])) {
              // appelle la fonction d'ajout dans la bdd qui est dans controller (3)
              addComment($_GET['id'], $_POST['author'], $_POST['comment']);
          }
          else {
              echo 'Erreur : tous les champs ne sont pas remplis !';
          }
      }
      else{
        echo 'erreu: aucun identifiant de billet envoyé';
      }
    }
}
else { // action par defaut
    listPosts();
}
