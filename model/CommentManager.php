<?php

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS datecfr FROM comments WHERE id_post = ? ORDER BY datecfr DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    // sans heritage
    // private function dbConnect()
    // {
    //     $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user');
    //     return $db;
    // }
}
