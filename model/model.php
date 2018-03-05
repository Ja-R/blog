<!-- modele: recupere les donnes de la dtb -->
<?php

//connection base de donnees
function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $db;
  }
  catch (Exception $e)
  {
          die('Erreur : ' . $e->getMessage());
  }

}

// selection des derniers billets à afficher
function getPosts()
{
  $db = dbConnect();

  $req = $db->query('SELECT id, title, content,
    DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS datepfr
    FROM posts
    ORDER BY date_post DESC
    LIMIT 0, 5');

  return $req;
}

//selection du billet dont on veut voir les commentaires
function getPost($postId)
{
  $db = dbConnect();

  $req = $db->prepare('SELECT id, title, content,
    DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS datepfr
    FROM posts
    WHERE id = ?');
  $req->execute(array($postId));
  $post= $req->fetch();

  return $post;
}

// selection des commentaires relatifs au billet selectionné
function getComments($postId)
{
  $db = dbConnect();

  $comments = $db->prepare('SELECT id, author, comment,
    DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS datecfr
    FROM comments
    WHERE id_post = ?');
  $comments->execute(array($postId));

  return $comments;
}

// (4) insertion du nouveau commentaire et return le tableau ajoute vers controller
function postComment($postId, $author, $comment)
{
  $db = dbConnect();

  $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, date_comment)
    VALUES (:idpostSub, :authorSub, :commentSub, NOW())');
  $affectedLines = $comments->execute(array(
    'idpostSub' => $postId,
    'authorSub' => $author,
    'commentSub' => $comment
  ));

  return $affectedLines;
}
