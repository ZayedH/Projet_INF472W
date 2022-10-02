<?php

require('country.php');

?>

<?php
$pieces = explode('@', $email);
$login = $pieces[0];
$uu = 0;
if (isset($_POST['chargement'])) {
    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $login . "." . $fileActualExt;
                $fileDestination = "../Project_Web/images/" . $fileNameNew;

                registerlink::updateprofileimage($dbh, $fileDestination, $email);

                $uu = 1;

                move_uploaded_file($fileTmpName, $fileDestination);
                unset($_POST['chargement']);
            } else {
                $error = "the size is too big";
            }
        } else {
            $error = "error";
        }
    } else {
        $error = "not_allowed";
    }
}
?>
<?php
$v = 0;
$vv = 0;
if (isset($_POST['save'])) {
    $v = 1;
    $vv = 1;
    if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp'])  && !empty($_POST['phone']) && !empty($_POST['skills']) && !empty($_POST['promotion']) && !empty($_POST['mdp2'])) {
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $phone = htmlspecialchars($_POST['phone']);
        $skills = htmlspecialchars($_POST['skills']);
        $promotion = htmlspecialchars($_POST['promotion']);
        $mdp2 = $_POST['mdp2'];
        $v = 2;
        $vv = 2;
    } else {
        $vv = 3;
    }
}
$u = 0;
$uuu = 0;
if (isset($_POST['inscription'])) {
    $u = 1;
    $uu = 1;
    if (!empty($_POST['naissance']) && !empty($_POST['nationality']) && !empty($_POST['localisation']) && !empty($_POST['address']) && !empty($_POST['sexe']) && !empty($_POST['aboutme']) && !empty($_POST['url'])) {
        $naissance = $_POST['naissance'];
        $nationality = $_POST['nationality'];
        $localisation = $_POST['localisation'];
        $address = $_POST['address'];
        $sexe = $_POST['sexe'];
        $aboutme = $_POST['aboutme'];
        $url = $_POST['url'];

        $u = 2;
        $uuu = 2;

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $mdp = $_POST['mdp'];
        $phone = $_POST['phone'];
        $skills = $_POST['skills'];
        $promotion = $_POST['promotion'];
        $mdp2 = $_POST['mdp2'];

        if (utilisateurs::insertutilisateur($dbh, $login, $nom, $prenom, $mdp, $promotion, $naissance, $email, $sexe, $phone, $nationality, $address, $localisation, $aboutme, $skills, $url)) {
            $row = registerlink::findimageProfile($dbh, $email);
            $profileimage = $row['profileimage'];

            utilisateurs::updateprofileimage($dbh, $profileimage, $login);
            sendregist($email);

            header("Location:index.php?todo=Success");
        } else {

            $uuu = 3;
        }
    } else {
        $uuu = 4;
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Zayed" content="Binet-Inter" />
    <meta name="keywords" content="site,web,binet,inter" />
    <meta name="description" content="Site Web du Binet Inter" />
    <link rel="stylesheet" href="../Project_Web//css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Project_Web/css/mafeuille.css" />
    <link rel="stylesheet" href="../Project_Web/css/bootstrap/bootstrap.min.css" />
    <link rel="icon" href="../Project_Web/images/icone.ico">
    <script src="../Project_Web/js/js/bootstrap.bundle.min.js"></script>
    <script src="../Project_Web/js/jquery-3.6.0.min.js"></script>
    <script src="../Project_Web/js/majs.js"></script>

    <script src="../Project_Web/js/bootstrap.min.js"></script>
    <link rel=”stylesheet” href=”../Project_Web/css/all.min.css”>



    <link rel="stylesheet" href="../Project_Web/css/bootstrap.min.css">

    <title>Binet Inter - Register</title>




</head>

<body>
    <?php
    if ($vv == 3) {
        echo <<<FIN
    <div class="m-4">
    <div class="alert alert-danger  alert-dismissible ">
        <strong>Error!</strong> you have to complete all information.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
1

FIN;
    }
    if ($uuu == 3) {
        echo <<<FIN
    <div class="m-4">
    <div class="alert alert-danger  alert-dismissible ">
        <strong>Error!</strong> registration problem.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
2

FIN;
    }
    if ($uuu == 4) {
        echo <<<FIN
    <div class="m-4">
    <div class="alert alert-danger  alert-dismissible ">
        <strong>Error!</strong> you have to complete all informations.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
3

FIN;
    }

    ?>
    <hr>
    <div class="container bootstrap snippet">

        <div class="row">
            <div class="col-sm-10">
                <?php
                if ($v == 2) {
                    echo <<<FIN
                   <h2>Bonjour! $prenom</h2>
                   FIN;
                }

                ?>
            </div>

            <div class="col-sm-2">
                <?php
                setlocale(LC_ALL, "fr");
                // on définit les valeurs locales pour la france 
                echo strftime('%A %d %B %Y, %H:%M') . "<br>";
                echo strftime('%d %B %Y') . "<br>";
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-3">
                <!--left col-->

                <div class="text-center">
                    <?php
                    $row = registerlink::findimageProfile($dbh, $email);
                    $profileimage = $row['profileimage'];

                    echo <<<FIN
                       <img src="$profileimage" class="avatar img-circle img-thumbnail" alt="avatar">
                       FIN;




                    ?>

                    <h6>Upload a different photo...</h6>

                    <div style="text-align:center;">
                        <br>
                        <div style="color:red;">
                            <p> <?php if (!empty($_POST['chargement']) && isset($error)) {
                                    echo $error;
                                } ?></p>
                        </div>
                        <form action="#" method="POST" enctype="multipart/form-data">

                            <input type="file" name="image" class="text-center center-block file-upload" accept="image/jpg,image/jpeg,image/png" style="width: 200px;">
                            <br>
                            <input type="submit" id="submit1" name="chargement" value="Charger l'image" />
                        </form>
                    </div>

                </div>
                <hr>
                <br>





            </div>
            <!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <!--- <li class="active"><a data-toggle="tab" href="#Menu1">Menu 1</a></li>
                    <li><a data-toggle="tab" href="#Menu2">Menu 2</a></li> -->
                    <li class=<?php if ($v == 0) {
                                    echo "active";
                                } ?>><a data-toggle="tab" href="#Menu1">Menu 1</a></li>
                    <li <?php if ($v == 2) {
                            echo 'class="active"';
                        } ?>><a data-toggle="tab" href="#Menu2">Menu 2</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?php if ($v == 0) {
                                                echo 'active';
                                            } ?>" id="Menu1">
                        <hr>

                        <form class="form" action="#" method="POST" id="registrationForm1" name="Form1">
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <h4><label>Prénom</label></h4>
                                    <div class="input-group">
                                        <?php
                                        if ($v == 2) {
                                            echo <<<FIN
                                           <input type="text" class="form-control" name="prenom" id="first_name" value=$prenom placeholder="enter your first name ."  required>
                                           FIN;
                                        } else {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="prenom" id="first_name" placeholder="enter your first name ." required>
                                            FIN;
                                        }


                                        ?>
                                        <span class="input-group-addon">
                                            <i class="fa fa-user" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;height:10px;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <h4><label>Nom</label></h4>
                                    <div class="input-group">
                                        <?php
                                        if ($v == 2) {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="nom" id="last_name" value=$nom  placeholder="enter your last name ." required>
                                            FIN;
                                        } else {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="nom" id="last_name" placeholder="enter your last name ." required>
                                            FIN;
                                        }

                                        ?>
                                        <span class="input-group-addon">
                                            <i class="fa fa-user" style="height: 10px;"></i><span class=" form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <h4><label>Mot de passe</label></h4>
                                    <?php
                                    if ($v == 2) {
                                        echo <<<FIN
                                        <input type="password" class="form-control" name="mdp" id="input_mdp" value=$mdp  placeholder="enter your password." required>
                                        FIN;
                                    } else {
                                        echo <<<FIN
                                        <input type="password" class="form-control" name="mdp" id="input_mdp" placeholder="enter your password." required>
                                        FIN;
                                    }


                                    ?>



                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <h4><label>Confirmation Mot de passe</label></h4>
                                    <?php
                                    if ($v == 2) {
                                        echo <<<FIN
                                    <input type="password" class="form-control" name="mdp2" id="input_mdp2" placeholder="confirmation password" title="enter your password2." value=$mdp2 required oninput="verify()">
                                    FIN;
                                    } else {
                                        echo <<<FIN
                                    <input type="password" class="form-control" name="mdp2" id="input_mdp2" placeholder="confirmation password" title="enter your password2." required oninput="verify()">
                                    FIN;
                                    }

                                    ?>
                                    *<label id="msg"></label>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Entrer phone number</label></h4>
                                    <div class="input-group">

                                        <?php
                                        if ($v == 2) {
                                            echo <<<FIN
                                        <input class="form-control" type="tel" id="tel" name="phone"  placeholder="Entrer votre mobile number" value=$phone required>
                                        FIN;
                                        } else {
                                            echo <<<FIN
                                            <input class="form-control" type="tel" id="tel" name="phone"  placeholder="Entrer votre mobile number" required>
                                            FIN;
                                        }

                                        ?>


                                        <span class="input-group-addon">
                                            <i class="fa fa-phone" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Promotion</label></h4>
                                    <div class="input-group">
                                        <?php
                                        if ($v == 2) {
                                            echo <<<FIN
                                        <input type="text" class="form-control" name="promotion" id="promo" placeholder="X2020" value=$promotion  required />
                                        FIN;
                                        } else {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="promotion" id="promo" placeholder="X2020" required />
                                            FIN;
                                        }

                                        ?>

                                        <span class="input-group-addon">
                                            <i class="fa fa-user " style="height: 10px;"></i><span class=" form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Domaine et Skills</label></h4>
                                    <div class="input-group">
                                        <?php
                                        if ($v == 2) {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="skills" value=$skills  id="domaine" placeholder="skills" />
                                            FIN;
                                        } else {
                                            echo <<<FIN
                                            <input type="text" class="form-control" name="skills"   id="domaine" placeholder="skills" />
                                            FIN;
                                        }

                                        ?>
                                        <span class="input-group-addon">
                                            <i class="fa fa-user" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <hr>
                                    <br>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                    &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
                                    &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;

                                    <button class="btn btn-lg btn-success" type="submit" name="save" onclick='validatemail()'><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <!--/tab-pane-->

                    <div class="tab-pane <?php if ($v == 2) {
                                                echo 'active';
                                            } ?>" id="Menu2">

                        <hr>
                        <form class="form" action="#" method="POST" id="registrationForm2" name="Form2">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Date de naissance</label></h4>
                                    <input type="date" class="form-control" id="naissance" name="naissance" title="entrer une date_nais" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Localisation ou ville</label></h4>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="localisation" id="location" placeholder="City,Country" title="entrer une localisation">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-map-marker" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label> Nationalité</label></h4>
                                    <br>
                                    <div class="input-group">
                                        <select name="nationality" class="form-control form-control-alternative" size="1" style="text-align:center;" required>
                                            <?php
                                            $len = count($countries);
                                            for ($i = 0; $i < $len; $i++) {
                                                echo <<<FIN
                                                
                                            <option >$countries[$i]</option>
                                            FIN;
                                            }
                                            ?>


                                        </select>
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-home" style="height: 10px;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label class="form-control-label">Social Media adress</label></h4>
                                    <br>
                                    <div class="input-group">
                                        <input type="url" name="url" id="url" placeholder="https://example.com" class="form-control form-control-alternative" pattern="https://.*" required>

                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-globe" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label class="form-control-label">Address</label></h4>
                                    <br>
                                    <div class="input-group">
                                        <input id="input-address" class="form-control form-control-alternative" name="address" placeholder="Home Address" value="Address" type="text" required>
                                        <span class="input-group-addon">
                                            <i class="fa fa-location-arrow" style="height: 10px;"></i><span class="form-required" title=" champ requis" style="color:red;">*</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <h4><label>Sexe</label></h4>

                                    <!-- Les deux inputs radio doivent avoir le meme nom -->
                                    <br>
                                    Masculin <input type="radio" name="sexe" value="M" checked="checked" style="width: 30%; height: 1.5em;">
                                    &#8287;&#8287;Féminin <input type="radio" name="sexe" value="F" style="width: 30%; height: 1.5em;">

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <hr class="my-4">
                                    <!-- Description -->
                                    <h4 class="heading-small text-muted mb-4">About me</h4>
                                    <div class="pl-lg-4">
                                        <div class="form-group focused">

                                            <textarea id="input-txt" name="aboutme" rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <?php
                                    if ($v == 2) {
                                        echo <<<FIN
                                          <input type="hidden"  name="prenom"  value=$prenom>
                                          <input type="hidden"  name="nom"  value=$nom>
                                          <input type="hidden"  name="mdp"  value=$mdp>
                                          <input type="hidden"  name="phone"  value=$phone>
                                          <input type="hidden"  name="skills"  value=$skills>
                                          <input type="hidden"  name="promotion"  value=$promotion>
                                          <input type="hidden"  name="mdp2"  value=$mdp2>
                                          FIN;
                                    }

                                    ?>

                                    <br>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                    &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
                                    &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
                                    <button class="btn btn-lg btn-success" type="submit" name="inscription"><i class="glyphicon glyphicon-ok-sign"></i> Inscription</button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!--/tab-pane-->

                </div>
                <!--/col-9-->
            </div>
            <!--/row-->
            <hr>
            <br>
            <div class="rights" id="footer">
                <p>Copyright© 2022, BI Tous droits réservés.</p>
            </div>

            <div id="texte-loi">
                <p>
                    <i>Conformément aux articles 39 et suivants de la loi n° 78-17 du 6 janvier 1978 modifiée, relative à l’informatique, aux fichiers et aux libertés, toute personne peut obtenir communication et, le cas échéant, rectification ou suppression des informations la concernant, en s’adressant au Binet Inter, rubrique 'Nous contacter'.</i>
                </p>
            </div>
        </div>
    </div>
</body>

</html>