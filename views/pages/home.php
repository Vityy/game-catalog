<?php
$games = $featuredGames ?? [];
$total = $total ?? 0;
?>

<h1>Game Catalog</h1>
<p class="sub">Home — featuring <?= count($games) ?> games.</p>
<a class="nav__link" href="/random">🎲 Random game</a>

<br>
<br>

<section class="card">
    <div class="meta">
        <span class="badge">Total: <?= (int)$total ?></span>
        <span class="badge">Featured: <?= count($games) ?></span>
    </div>
</section>

<?php foreach ($games as $game): ?>
    <article class="card">
        <h2 class="card__title"><?= $game['title'] ?></h2>

        <div class="meta">
            <span class="badge"><?= $game['platform'] ?></span>
            <span class="badge"><?= $game['genre'] ?></span>
            <span class="badge"><?= (int)$game['releaseYear'] ?></span>
            <span class="badge"><?= (int)$game['rating'] ?>/10</span>
        </div>
        <a class="card_link" href="/games/<?= $game['id']?>">Naviguer vers le détail</a>
    </article>
<?php endforeach; ?>

