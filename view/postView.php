<!-- affichage du billet selectionne et ses commentaires
reçoit les infos du controller-->
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

    <h1>Un blog</h1>
    <a href="index.php">Retour à la liste des billets</a>

      <div class="news">
          <h3>
              <?= htmlspecialchars($post['title']) . ' '; ?>
              <em>
                posté le
                <?= htmlspecialchars($post['datepfr']); ?>
              </em>
          </h3>

          <p>
              <?= nl2br(htmlspecialchars($post['content'])); ?>
          </p>
      </div>

    <h2>Commentaires :</h2>

    <?php
    while ($comment = $comments->fetch())
    {
      ?>
        <p>
          <strong><?= htmlspecialchars($comment['author']); ?> </strong>
          a ecrit le
          <?= $comment['datecfr']; ?>
          <!-- </br> -->
          <?=  nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
        <hr>
      <?php
    }
    ?>
    <br><hr>
    <!-- (1) ajout de commentaire envoye à l'index via la var action qui recoit la fct addcomment pour verifier les inputs et id l'id du billet -->
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" required/>
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment" required></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
