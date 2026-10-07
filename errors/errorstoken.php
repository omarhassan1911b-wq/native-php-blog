<?php
if(isset($_SESSION['errorstoken'])){
    foreach($_SESSION['errorstoken'] as $error){?>
        <div class="alert alert-danger"><?php echo $error?></div>
   <?php }
   unset($_SESSION['errorstoken']);
} 