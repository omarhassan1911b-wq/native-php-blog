<?php
if (isset($_SESSION['update'])) {
    ?>
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['update']; ?>
        </div>
    </div>
    <?php
    unset($_SESSION['update']); 
}
?>