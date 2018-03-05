<!-- la vue affiche les billets selectionnes -->
<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

    <h1>Un blog</h1>
    <p>Derniers billets du blog:</p><br>

    <?php
    while ($data = $posts->fetch())
    {
    ?>
      <div class="news">
          <h3>
              <?= htmlspecialchars($data['title']) . ' '; ?>
              <em>
                  posté le
                  <?= $data['datepfr']; ?>
              </em>
          </h3>

          <p>
            <?= htmlspecialchars($data['content']); ?>
            <br>
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
          </p>
      </div>
    <?php
    }
    $posts->closeCursor();
    ?>


    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
