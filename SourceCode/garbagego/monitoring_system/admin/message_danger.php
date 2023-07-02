<?php
    if(isset($_SESSION['message_danger'])) :
?>

<div class="alert alert-danger alert-dismissible fade show small col-12 ml-auto" role="alert">
    <?= $_SESSION['message_danger']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: -0.25rem;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php 
    unset($_SESSION['message_danger']);
    endif;
?>
