<?php require('includes/header.php');?>
<div class="container"><?php
if (isset($_SESSION['id'])) {
    if (isset($_POST['modifier'])){
        controller_membre::modifAction();
    }
    ?>
        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="profil.php" class="form-group">
                    <input type="text" name="username" value="<?php echo($_SESSION["username"]) ?>"
                           class="form-control"><br><br>
                    <input type="email" name="mail" value="<?php echo($_SESSION["mail"]) ?>"
                           class="form-control"><br><br>
                    <input type="password" name="password" value="<?php echo($_SESSION["password"]) ?>"
                           class="form-control"><br><br>
                    <input type="password" name="verif" value="<?php echo($_SESSION["password"]) ?>"
                           class="form-control"><br><br>
                    <input type="submit" name="modifier" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <?php
} else {
    header('location:connexion.php');
}
require('includes/footer.php'); ?>