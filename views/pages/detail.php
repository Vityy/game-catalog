<?php
    $game ??= [];
    $id ??= 0;
    $success ??= '';
?>

<?php if($success): ?>
    <h1 class="success-title"><?= $success ?></h1>
<?php endif; ?>

<?php if(!$game): ?>
    <h1>Required game not found</h1>
<?php else: ?>
    <h1> <?= $game['title'] ?> </h1>
    <h1> <?= $game['platform'] ?> </h1>
<?php endif; ?>

<br>
<br>

<a class="nav__link" href="/games">Retour aux jeux</a> <a class="nav__link" href="/">Accueil</a>
