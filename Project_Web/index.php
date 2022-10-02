<?php
session_name("connexion");
session_start();


require('scripts/utils.php');
require('classes/database.php');
require('classes/utilisateurs.php');
require('classes/pwdReset.php');
require('classes/generateevent.php');
require('classes/registerLink.php');
require('scripts/estconnect.php');
require('scripts/sendlinkandverifylink.php');
require('scripts/sendcontactsms.php');
require('scripts/resetpassword.php');

$dbh = Database::connect();




// code login
$ereur = 0;
if (array_key_exists('login', $_POST) && array_key_exists('password', $_POST)) {
    if (!empty($_GET['todo']) && $_GET['todo'] == 'login' && utilisateurs::verifyutilisateurMDP(
        $dbh,
        $_POST['login'],
        $_POST['password']
    )) {

        $_SESSION['login'] = htmlspecialchars($_POST['login']);
        $_SESSION['loggedIn'] = true;
    } else {
        headerout("Authentification");
        require('scripts/formulairelogin.php');
        $ereur = 1;
    }
}

//code logout

if (!empty($_GET['todo']) && ($_GET['todo'] == 'logout')) {
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['login']);
}

/*if (estConnecte() && utilisateurs::isAdmin($dbh, $_SESSION['login'])) {
}*/

if (estConnecte()) {
    $askedPage = 'accueil';
    if (array_key_exists('page', $_GET)) {
        $askedPage = $_GET['page'];
    }
    $pagelist = generatepages($dbh, $_SESSION['login']);
    if (!checkPage($askedPage, $pagelist)) {
        $askedPage = 'accueil';
    }

    generateHTMLHeader($dbh, $askedPage, $_SESSION['login']);

    require("contenue/contenu_$askedPage.php");

    generateHTMLFooter();
} elseif (!empty($_GET['selectoremail']) && !empty($_GET['validatoremail']) && registerlink::verifylink($dbh, $_GET['selectoremail'], $_GET['validatoremail']) != null) {
    $selector = $_GET['selectoremail'];
    $validator = $_GET['validatoremail'];
    $row = registerlink::verifylink($dbh, $_GET['selectoremail'], $_GET['validatoremail']);
    $email = $row->registerEmail;
    $date = $row->registerExpires;
    if ($date >= date("U")) {

        require('scripts/register.php');
    } else {
        $val = 6;
        headerout("Inscription");
        require('scripts/registerEmail.php');
    }
} elseif (isset($_POST['link'])) {
    //after verification of  mail in javascrpt
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {


            $pieces = explode('@', $_POST['email']);
            $login = $pieces[0]; /////this will be used as login,because it is unique par user;
            $polymail = $pieces[1];
            if ($polymail == 'polytechnique.edu') {
                //start by cheking if  he has a count.

                $val = 0;


                //let start by sending the link to the user;
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);
                $url = "localhost/Project_Web/index.php?selectoremail=" . $selector . "&validatoremail=" . bin2hex($token); ////link for reseting password

                $expiresEmail = date("U") + 1800; // the link is valid for only 30min

                $userEmail = $_POST["email"];
                if (registerlink::findrow($dbh, $userEmail)) {
                    registerlink::deletrow($dbh, $userEmail); // we delete it from pwdreset
                }
                $verify = utilisateurs::find_mail($dbh, $userEmail);
                if ($verify) {
                    $val = 4;
                    headerout("Inscription");
                    require('scripts/registerEmail.php');
                } else {

                    if (!(registerlink::insertrow($dbh, $userEmail, $login, $selector, $token, $expiresEmail))) {
                        echo "<h1 style='color:red'>Error!</h1>"; //maybe some error happned 
                    } else {
                        $val = 5;
                        sendregisterlink($userEmail, $url); //// send like to reset password
                        headerout("Inscription");
                        require('scripts/registerEmail.php');
                    }
                }
            } else {
                $val = 1;
                headerout("Inscription");
                require('scripts/registerEmail.php');
            }
        } else {
            $val = 2;
            headerout("Inscription");
            require('scripts/registerEmail.php');
        }
    } else {
        $val = 3;
        headerout("Inscription");
        require('scripts/registerEmail.php');
    }
} elseif ((!isset($_POST["link"])) && (!empty($_GET['todo'])) && ($_GET['todo'] == 'register')) {
    afficheFormulaireLogin('accueil');
} elseif (!empty($_GET['todo']) && ($_GET['todo'] == 'Inscription')) {
    $val = 0;

    headerout("Inscription");
    require('scripts/registerEmail.php');
}
























///let reset the password
elseif (isset($_POST["reset-password"])) {

    $email = $_POST["email"];
    $date = $_POST["date"];

    //ici on doit verifier qu'il s'agit d'une mot de passe strong and conform.
    if (!empty($_POST["pwd"]) && !empty($_POST["repeatpwd"])) {
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["repeatpwd"];




        if ($date >= date("U")) {


            if (utilisateurs::updateMDP($dbh, $password, $email)) {
                headerout("Authentification");
                require('scripts/formulairelogin.php');
                unset($_POST["reset-password"]);
            } else {
                headerout("Authentification");
                require('scripts/formulairelogin.php');  //tipe the same pwd
            }
        } else {
            $oubl = 0;
            headerout("oubliepassword");
            require('scripts/oubliepassword.php');
        }
    } else {
        $oubl = 4;
        headerout("oubliepassword");
        require('scripts/oubliepassword.php');
    }
} elseif (!empty($_GET['selector']) && !empty($_GET['validator']) && pwdreset::verifylink($dbh, $_GET['selector'], $_GET['validator']) != null) {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];
    $row = pwdreset::verifylink($dbh, $_GET['selector'], $_GET['validator']);
    $email = $row->pwdResetEmail;
    $date = $row->pwdResetExpires;
    headerout("reset_password");
    resetpassword($email, $date);
} elseif (isset($_POST["email"])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "localhost/Project_Web/index.php?selector=" . $selector . "&validator=" . bin2hex($token); ////link for reseting password

    $expires = date("U") + 1800; // the link is valid for only 30min

    $userEmail = $_POST["email"];

    if (pwdreset::findrow($dbh, $userEmail)) {
        pwdreset::deletrow($dbh, $userEmail); // we delete it from pwdreset
    }
    $verify = utilisateurs::find_mail($dbh, $userEmail);
    if (!$verify) {
        $oubl = 1;
        headerout("oubliepassword");
        require('scripts/oubliepassword.php');
    } else {

        if (!(pwdreset::insertrow($dbh, $userEmail, $selector, $token, $expires))) {
            echo "Error!3"; //maybe some error happned 
        } else {
            $oubl = 2;
            sendlink($userEmail, $url); //// send like to reset password****
            headerout("oubliepassword");
            require('scripts/oubliepassword.php');
        }
    }
} elseif ((!isset($_POST["email"])) && (!empty($_GET['todo'])) && ($_GET['todo'] == 'resetpassword')) {
    afficheFormulaireLogin('accueil');
} elseif ((!empty($_GET['todo'])) && ($_GET['todo'] == 'oublieé')) {
    $oubl = 3;
    headerout("Reset_mot_de_passe");
    require('scripts/oubliepassword.php');
} elseif ((!estConnecte()) && ($ereur == 0)) {

    if (!empty($_GET['page'])) {


        afficheFormulaireLogin($_GET['page']);
    } else {




        afficheFormulaireLogin('accueil');
    }
}





?>


<?php

$dbh = null;
?>