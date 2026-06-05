<!DOCTYPE html>
<html>
<head>
    <title>Test Project POST</title>
</head>
<body>

<h2>Create Project (TEST)</h2>

<?php if (session()->has('success')): ?>
    <p style="color:green"><?= session('success') ?></p>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <p style="color:red"><?= session('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('test-project/store') ?>">

    <?= csrf_field() ?>

    <input type="text" name="title" placeholder="Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="text" name="location" placeholder="Location"><br><br>

    <input type="text" name="category" placeholder="Category"><br><br>

    <select name="status">
        <option value="planning">Planning</option>
        <option value="ongoing">Ongoing</option>
        <option value="completed">Completed</option>
    </select><br><br>

    <input type="number" name="progress_percentage" placeholder="Progress (0-100)"><br><br>

    <input type="date" name="start_date"><br><br>

    <input type="date" name="estimated_completion_date"><br><br>

    <input type="number" step="0.01" name="budget" placeholder="Budget"><br><br>

    <input type="number" step="0.01" name="spent_amount" placeholder="Spent Amount"><br><br>

    <input type="text" name="contractor" placeholder="Contractor"><br><br>

    <input type="text" name="fund_source" placeholder="Fund Source"><br><br>

    <input type="hidden" name="is_active" value="1">

    <button type="submit">SAVE PROJECT</button>

</form>

</body>
</html>