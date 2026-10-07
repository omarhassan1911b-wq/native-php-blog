<?php
if(isset($_SESSION['errors'])){
?>
<style>
    .error-message {
        width: 100%;
        max-width: 430px;
        margin: 0 auto 15px;
        padding: 12px 18px;
        border: 1px solid #ff4d5a;
        border-radius: 10px;
        background-color: rgba(220, 53, 69, 0.92);
        color: white;
        font-size: 15px;
        font-weight: 500;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: errorFade 0.3s ease;
    }

    @keyframes errorFade {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?php
    foreach($_SESSION['errors'] as $error){
?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
<?php
    }

    unset($_SESSION['errors']);
}
?>