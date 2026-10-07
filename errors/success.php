<?php
if (isset($_SESSION['success'])) {
    ?>
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
        </div>
    </div>
    <?php
    unset($_SESSION['success']); 
}
?>