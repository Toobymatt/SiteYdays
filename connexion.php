<?php require("includes/header.php"); ?>
    <div class="container">
        <?php
        if (isset($_POST['connexion'])) {
            controller_membre::connexionAction();
        }
        if (isset($_POST['inscription'])) {
            controller_membre::inscriptionAction();
        }
        ?>
        <div class="row">
            <div class="col-lg-12 exp exp2">
                <h2>Connexion</h2>
                <form method="POST" action="connexion.php" class="form-group">
                    <input type="email" name="mail" class="form-control" placeholder="Email"> <br> <br>
                    <input type="password" name="password" class="form-control" placeholder="Password"> <br> <br>
                    <input type="submit" name="connexion" class="btn btn-primary">
                </form>
                <p>Je n'ai pas encore de compte je
                    <button class="btn btn-primary but" id="button1" data-id="1">m'inscris</button>
                </p>
            </div>
            <div
                class="fb-like"
                data-share="true"
                data-width="450"
                data-show-faces="true">
            </div>

            <div class="col-lg-12 exp exp1">
                <h2>Inscription</h2>
                <form method="POST" action="connexion.php" class="form-group">
                    <input type="text" name="login" placeholder="Username" class="form-control"><br><br>
                    <input type="email" name="mail" placeholder="Email" class="form-control"><br><br>
                    <input type="password" name="password" placeholder="Password" class="form-control"><br><br>
                    <input type="password" name="verif" placeholder="Repeat Password" class="form-control"><br><br>
                    <input type="submit" name="inscription" class="btn btn-primary">
                </form>
                <p>J'ai déjà un compte je me
                    <button class="btn btn-primary but" id="button2" data-id="2">Connect</button>
                </p>

            </div>
        </div>
    </div>
<?php require("includes/footer.php"); ?>