<?php
    if(isset($_SESSION['success'])) {
?>
    <div id="sessionMessage">
        <?php echo $_SESSION['success'] ?>
    </div>
<?php
    unset($_SESSION['success']);
    }

    if(isset($_SESSION['error'])) {
?>
    <div id="sessionMessageError">
        <?php echo $_SESSION['error'] ?>
    </div>
<?php
    unset($_SESSION['error']);
    }
?>
