<?php

require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS datepfr FROM posts ORDER BY date_post DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS datepfr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // plus besoin car ici avec heritage via 'extends Manager'
    // private function dbConnect()
    // {
    //     $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user');
    //     return $db;
    // }
}
