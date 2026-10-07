<?php
if (isset($_SESSION['delete'])) {
    ?>
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['delete']; ?>
        </div>
    </div>
    <?php
    unset($_SESSION['delete']); 
}
?>