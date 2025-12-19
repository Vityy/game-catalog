<?php
    $errors = $errors ?? [];
?>

<h1>Add a game.</h1>

<form method="post" action="/add">
    <div class="field">
        <label for="title">Name</label>
        <label>
            <input type="text" name="title">
        </label>

        <?php if(!empty($errors['title'])): ?>
        <small class="add-error"><?= $errors['title'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="platform">Platform</label>
        <label>
            <input type="text" name="platform">
        </label>

        <?php if(!empty($errors['platform'])): ?>
            <small class="add-error"><?= $errors['platform'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="genre">Genre</label>
        <label>
            <input type="text" name="genre">
        </label>

        <?php if(!empty($errors['genre'])): ?>
            <small class="add-error"><?= $errors['genre'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="releaseYear">Release Year</label>
        <label>
            <input type="number" name="releaseYear">
        </label>

        <?php if(!empty($errors['releaseYear'])): ?>
            <small class="add-error"><?= $errors['releaseYear'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="rating">Rating</label>
        <label>
            <input type="number" name="rating">
        </label>

        <?php if(!empty($errors['rating'])): ?>
            <small class="add-error"><?= $errors['rating'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="description">Description</label>
        <label>
            <input type="text" name="description">
        </label>

        <?php if(!empty($errors['description'])): ?>
            <small class="add-error"><?= $errors['description'] ?></small>
        <?php endif ?>

    </div>
    <div class="field">
        <label for="notes">Notes</label>
        <label>
            <input type="text" name="notes">
        </label>

        <?php if(!empty($errors['notes'])): ?>
            <small class="add-error"><?= $errors['notes'] ?></small>
        <?php endif ?>

    </div>
    <button type="submit">Add Game</button>
</form>
