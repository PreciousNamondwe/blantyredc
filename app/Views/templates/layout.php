<?= $this->include('templates/header.php')?>

    <div class="app">
        <?= $this->include('templates/topbar.php')?>
        <?= $this->include('templates/navbar.php')?>
        <?= $this->renderSection('content')?>
    </div>

<?= $this->include('templates/footer.php')?>