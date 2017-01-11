<?php

class controller_membre
{
    static public function connexionAction()
    {
        if (isset($_POST['connexion'])) {
            try {
                $bdd = new PDO('mysql:host=51.254.142.19;dbname=Ydays;charset=utf8', 'Ydays', 'ydays1617');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $keys = '$2a$07$usesomesillystringforsalt$';
            $login = $_POST['mail'];
            $password = $_POST['password'];
            if ($login && $password) {
                $reponse = $bdd->query('SELECT * FROM user WHERE mail = "' . $login . '" ');
                $verif = $reponse->fetch();
                $password = $password . crypt($password, $keys);
                $password = hash('md5', $password);
                $hash = $verif['password'];
                if (strtolower($login) == strtolower($verif['mail'])) {
                    if ($password == $hash) {
                        echo "<h3 class='bg-success'>[SUCESS] Tu es connecté</h3>";
                        sleep(4);
                        header('location:profil.php');
                        $_SESSION['username'] = $verif['username'];
                        $_SESSION['id'] = $verif['id'];
                        $_SESSION['password'] = $verif['password'];
                        $_SESSION['mail'] = $verif['mail'];
                        $_SESSION['groupe'] = $verif['groupe'];

                    } else echo "<h3 class=\"bg-danger\">[ERREUR]Le mot de passe ou l'Email est incorrect</h2>";

                } else echo "<h3 class=\"bg-danger\">[ERREUR]Le mot de passe ou l'Email est incorrect</h3>";
            } else {
                echo "<h3 class=\"bg-danger\">[ERREUR]Tous les champs ne sont pas remplis</h3>";
            }


        }
    }

    static public function deconnexionAction()
    {

        session_destroy();
        header('location:connexion.php');
    }

    static public function inscriptionAction()
    {
        try {
            $bdd = new PDO('mysql:host=51.254.142.19;dbname=Ydays;charset=utf8', 'Ydays', 'ydays1617');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $admin = 1;
        $keys = '$2a$07$usesomesillystringforsalt$';
        $login = $_POST['login'];
        $password = $_POST['password'];
        $verif = $_POST['verif'];
        $mail = $_POST['mail'];
        if ($login && $password && $verif && $mail) {
            if ($password == $verif) {
                $password = $password . crypt($password, $keys);
                $password = hash('md5', $password);
                $reponse = $bdd->query('SELECT mail FROM user WHERE mail = "' . $_POST['mail'] . '" ');
                $verif = $reponse->fetch();
                if (strtolower($_POST['mail']) == strtolower($verif['mail'])) {
                    echo "<h3 class='bg-warning'>[ERREUR] Cette adresse de mail est déjà utilisée.</h3>";
                } else {
                    $req = $bdd->prepare('INSERT INTO user(username, password, mail) VALUES(:login, :password, :mail)');
                    $req->execute(array(
                        'login' => $login,
                        'password' => $password,
                        'mail' => $mail
                    ));
                    echo "<h3 class='bg-success'>[SUCESS] Insciption réussite.</h3>";
                }
            } else {
                echo "<h3 class='bg-warning'>[ERREUR] Les mots de passes ne sont pas indentique.</h3>";
            }

        } else {
            echo "<h3 class='bg-warning'>[ERREUR] Tous les champs ne sont pas remplis.</h3>";
        }
    }

    static public function modifAction()
    {
        if (isset($_POST['modifier'])) {
            try {
                $bdd = new PDO('mysql:host=51.254.142.19;dbname=Ydays;charset=utf8', 'Ydays', 'ydays1617');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $admin = 1;
            $keys = '$2a$07$usesomesillystringforsalt$';
            $username = $_POST['username'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $verif_pwd = $_POST['verif'];
            if ($password && $verif_pwd && $username && $mail) {
                $reponse = $bdd->prepare('SELECT * FROM user WHERE mail = :mail ');
                $reponse->execute(array(
                    ':mail' => $mail,
                ));
                if ($_SESSION['password'] == $password) {
                    if ($password == $verif_pwd) {
                        $req = $bdd->prepare('UPDATE user set `username`=:login,`password`=:pass,`mail`=:mail WHERE mail=:mail');
                        $req->execute(array(
                            ':pass' => $password,
                            ':mail' => $mail,
                            ':login' => $username
                        ));
                        echo "<h3 class=\"bg-sucess\">[SUCESS]Les informations on été changée</h3>";
                        echo '<meta http-equiv="refresh" content="3;url=profil.php">';
                    } else echo "<h3 class=\"bg-danger\">[ERREUR]Le mot de passe est incorrect</h3>";
                } else {
                    if ($password == $verif_pwd) {
                        $password = $password . password_hash($password, PASSWORD_BCRYPT);
                        $password = hash('md5', $password);
                        $req = $bdd->prepare('UPDATE user set `username`=:login,`password`=:pass,`mail`=:mail WHERE mail=:mail');
                        $req->execute(array(
                            ':pass' => $password,
                            ':mail' => $mail,
                            ':login' => $username
                        ));
                        echo "<h3 class=\"bg-sucess\">[SUCESS]Les informations on été changée</h3>";
                        echo '<meta http-equiv="refresh" content="3;url=profil.php">';
                    } else echo "<h3 class=\"bg-danger\">[ERREUR]les mots de passes doivent être les mêmes</h3>";
                }
            } else {
                echo "<h3 class=\"bg-danger\">[ERREUR]Tous les champs doivent être rempli</h3>";
            }
        }
    }
}