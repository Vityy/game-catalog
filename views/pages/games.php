<?php
//    $games = $games ?? [];
    $games ??= []; // possible shortcut
?>

<h1>Games By Rating</h1>
<p class="sub">Games — rating on <?= count($games) ?> games (desc).</p>

<?php foreach ($games as $game): ?>

    <article class="card">
        <h2 class="card__title"><?= $game['title'] ?></h2>

        <div class="meta">
            <span class="badge"><?= $game['platform'] ?></span>
            <span class="badge"><?= $game['genre'] ?></span>
            <span class="badge"><?= (int)$game['releaseYear'] ?></span>
            <span class="badge"><?= (int)$game['rating'] ?>/10</span>
        </div>
    </article>

<?php endforeach; ?>


