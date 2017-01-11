<?php

class sessionmembre
{
    public function connexionAction()
    {
        if (isset($_POST['connexion'])) {
            require('option.php');
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
                        echo "tu es connecté";
                        $_SESSION['username'] = $verif['username'];
                        $_SESSION['mail'] = $verif['mail'];
                        $_SESSION['password'] = $verif['password'];
                        $_SESSION['id'] = $verif['id'];
                        echo '<meta http-equiv="refresh" content="5;url=index.php">';


                    } else echo "Le mot de passe ou l'Email est incorrect";

                } else echo "Le mot de passe ou l'Email est incorrect";
            } else {
                echo "Tous les champs ne sont pas remplis";
            }


        }
    }

    public
    function deconnexionAction()
    {

        session_destroy();
        header('location:connexion.php');
    }

    public
    function inscriptionAction()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'projetphp', 'afd08c189c8abf33e798fd1e8a96d6e1709c4f6521d5f352');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $keys = '$2a$07$usesomesillystringforsalt$';
        if (isset($_POST['inscription'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $verif = $_POST['verif'];
            $mail = $_POST['mail'];
            if ($login && $password && $verif && $mail) {
                if ($password == $verif) {
                    $password = $password . crypt($password, $keys);
                    $password = hash('md5', $password);
                    $reponse = $bdd->query('SELECT mail FROM user WHERE mail = "' . $mail . '" ');
                    $verif = $reponse->fetch();
                    if (strtolower($_POST['mail']) == strtolower($verif['mail'])) {
                        echo "ERREUR: Cette adresse de mail est déjà utilisée.";
                    } else {
                        $req = $bdd->prepare('INSERT INTO user(username, password, mail) VALUES(:login, :password, :mail)');
                        $req->execute(array(
                            'login' => $login,
                            'password' => $password,
                            'mail' => $mail
                        ));
                        echo "Vous êtes inscit vous pouvez vous <a href='connexion.php'>connecter</a> des a présent si la redirection ne s'effectue pas d'ici 5 sec";
                        echo '<meta http-equiv="refresh" content="5;url=connexion.php">';
                    }
                } else echo "le mot de passe est incorrect";

            } else {
                echo "Tous les champs doivent être rempli";
            }
        }
    }

    public function modifAction()
    {
        if (isset($_POST['modifier'])) {
            require('option.php');
            $username = $_POST['username'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $verif = $_POST['verif'];
            if ($password && $verif && $username && $mail) {
                if ($password == $verif) {
                    $password = $password . password_hash($password, PASSWORD_BCRYPT);
                    $password = hash('md5', $password);
                    $reponse = $bdd->query('SELECT * FROM user WHERE mail = "' . $mail . '" ');
                    $verif = $reponse->fetch();
                    $req = $bdd->prepare('UPDATE user set `username`=:login,`password`=:pass,`mail`=:mail WHERE mail=:mail');
                    $req->execute(array(
                        ':pass' => $password,
                        ':mail' => $mail,
                        ':login' => $username
                    ));
                    echo "Les informations on été changée";
                    echo '<meta http-equiv="refresh" content="3;url=profil.php">';
                } else echo "les mots de passes doivent être les mêmes";

            } else echo "Le mot de passe est incorrect";
        } else {
            echo "Tous les champs doivent être rempli";
        }
    }
}