<!-- listes de fonctions qui decident quoi prendre dans ls bd puis appelle la page ou ce sera affiché
determine donc les variables sur les pages d'affichage-->
<?php

// require('model/model.php'); toutes les fonctions

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
//Le  require_once  nous permet de nous assurer qu'on ne charge pas la classe une seconde fois.

// fonction appellant les billets à afficher
function listPosts()
{
    //$posts = getPosts();

    //methode POO
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
    require('view/listPostsView.php');
}

// fonction appelant le billet select et ses commentaires

// (7) publie le nouveau commentaire
function post()
{
  //le billet  $post = getPost($_GET['id']);
  //ses commentaires  $comments = getComments($_GET['id']);

    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    // appelle l'affichage du billet et commentaires
    require('view/postView.php');
}

// (3) fonction appelant les commentaires et ajout
function addComment($postId, $author, $comment)
{
    // $affectedLines = postComment($postId, $author, $comment); //(4)
    //
    // if ($affectedLines === false) { //(6) valide et renvoi à l'index
    //     die('Impossible d\'ajouter le commentaire !');
    // }
    // else {
    //     header('Location: index.php?action=post&id=' . $postId); // 6:renvoi à l'index l'action de publier les comm avec l'ajout
    // }

    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
