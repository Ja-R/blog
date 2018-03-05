<!-- listes de fonctions qui decident quoi prendre dans ls bd puis appelle la page ou ce sera affiché
determine donc les variables sur les pages d'affichage-->
<?php

require('model/model.php'); // toutes les fonctions

// fonction appellant les billets à afficher
function listPosts()
{
    $posts = getPosts();

    require('view/listPostsView.php');
}

// fonction appelant le billet select et ses commentaires
function post() // (7) publie le nouveau commentaire
{
    $post = getPost($_GET['id']); //le billet
    $comments = getComments($_GET['id']); //ses commentaires
    // appelle l'affichage du billet et commentaires
    require('view/postView.php');
}

// (3) fonction appelant les commentaires et ajout
function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment); //(4)

    if ($affectedLines === false) { //(6) valide et renvoi à l'index
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId); // 6:renvoi à l'index l'action de publier les comm avec l'ajout
    }
}
