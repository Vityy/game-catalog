<?php
    $game ??= [];
    $id ??= 0;
?>

<?php if(!$game): ?>
<h1>Required game not found</h1>
<?php else: ?>
<h1> <?= $game['title'] ?> </h1>
<h1> <?= $game['platform'] ?> </h1>
<?php endif; ?>

<br>
<br>

<a class="nav__link" href="/games">Retour aux jeux</a> <a class="nav__link" href="/">Accueil</a>
