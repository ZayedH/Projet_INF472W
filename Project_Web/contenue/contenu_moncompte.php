<?php
$v = 0;
if (isset($_POST['send'])) {

    if (!empty($_POST['subject']) && !empty($_POST['subject']) && !empty($_POST['membres'])) {
        $emailmembre = $_POST['membres'] . "@polytechnique.edu";
        $sender = $_SESSION['login'] . "@polytechnique.edu";
        $messange = $_POST['comment'];
        $subject = $_POST['subject'];
        $v = 2;


        sendemailtomembre($sender, $emailmembre, $messange, $subject);
    }
}

?>

<?php
//change some information
if (isset($_POST['changer'])) {
    if (!empty($_POST['address'])) {
        utilisateurs::updateAddress($dbh, $_POST['address'], $_SESSION['login']);
        $v = 3;
    }
    if (!empty($_POST['passwordchange'])) {
        utilisateurs::changemdp($dbh, $_POST['passwordchange'], $_SESSION['login']);
        $v = 3;
    }
    if (!empty($_POST['phonenumber'])) {
        utilisateurs::updatephone($dbh, $_POST['phonenumber'], $_SESSION['login']);
        $v = 3;
    }
    if (!empty($_POST['aboutme'])) {
        utilisateurs::updateaboutme($dbh, $_POST['aboutme'], $_SESSION['login']);
        $v = 3;
    }
}

?>
<?php
//show the information related to the user
$user = utilisateurs::getutilisateur($dbh, $_SESSION['login']);
$prenom = $user->prenom;
$nom = $user->nom;
$localisation = $user->localisation;
$phone = $user->phone;
$email = $user->email;
$naissance = $user->naissance;
$nationality = $user->nationality;
$address = $user->address;
$profileimage = $user->profileimage;
$skills = $user->skills;
$aboutme = $user->aboutme;
$promotion = $user->promotion;
$linkdin = $user->url;


?>
<?php
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
                $fileNameNew = $_SESSION['login'] . "." . $fileActualExt;
                $fileDestination = "../Project_Web/images/" . $fileNameNew;
                if ($profileimage != '../Project_Web/images/avatar_2x.png') {
                    unlink($profileimage);
                }
                utilisateurs::updateprofileimage($dbh, $fileDestination, $_SESSION['login']);

                move_uploaded_file($fileTmpName, $fileDestination);
                unset($_POST['chargement']);
            } else {
                $error = "bigimage";
            }
        } else {
            $error = "error";
        }
    } else {
        $error = "not_allowed";
    }
}

?>




<link rel="stylesheet" href="../Project_Web/css/bootstrap.min.css">
<hr>
<div class="container bootstrap snippet">
    <script>
        function getOption() {
            selectElement = document.querySelector('#select1');
            output = selectElement.value;
            document.querySelector('.output').textContent = output;
        }
    </script>
    <div class="row">
        <div class="col-sm-8">
            <div class="header-intro">
                <div class="header-left">

                    <?php
                    echo <<<FIN
                    <h2 class="header2"> Welcome,  $prenom !</h2>
                    FIN;

                    ?>
                </div>

            </div>
            <h1><label id="user_name">*</label></h1>
        </div>
        <div class="col-sm-2">
            <?php
            setlocale(LC_ALL, "fr");
            // on définit les valeurs locales pour la france 
            echo strftime('%A %d %B %Y, %H:%M') . "<br>";
            echo strftime('%d %B %Y') . "<br>";
            ?>
        </div>
        <div class="col-sm-2"><a href="index.php?page=accueil" class="pull-right"><img title="Accueil" class="img-circle img-responsive" src="../Project_Web/images/avatar.jpg"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->


            <div class="text-center">
                <?php
                $uset = utilisateurs::getutilisateur($dbh, $_SESSION['login']);
                $profileimage = $uset->profileimage;
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





            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <div class="box">
                        <input type="checkbox" id="checkbox" name="socialnet" />

                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-facebook fa-2x"></i>
                            </a>
                        </div>
                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-github fa-2x"></i>
                            </a>
                        </div>
                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-linkedin fa-2x "></i>
                            </a>
                        </div>

                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-twitter fa-2x"></i>
                            </a>
                        </div>
                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-pinterest fa-2x"></i>
                            </a>
                        </div>
                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-google-plus fa-2x"></i>
                            </a>
                        </div>
                        <div class="menu">
                            <a href="#">
                                <i class="fa fa-instagram fa-2x"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class=<?php if ($v == 0) {
                                echo "active";
                            } ?>><a data-toggle="tab" href="#home">Home</a></li>
                <li <?php if ($v == 2) {
                        echo 'class="active"';
                    } ?>><a data-toggle="tab" href="#messages">messages</a></li>
                <li <?php if ($v == 3) {
                        echo 'class="active"';
                    } ?>><a data-toggle="tab" href="#settings" class="glyphicon glyphicon-user">Parametres</a></li>
            </ul>


            <div class="tab-content">

                <div class="tab-pane <?php if ($v == 0) {
                                            echo 'active';
                                        } ?>" id="home">
                    <hr>

                    <div class=" col-md-9 col-lg-9 ">
                        <div class="row">

                            <div class="col-sm-6 col-md-8">
                                <?php
                                echo <<<FIN
                                 <h4>$prenom  $nom</h4>
                                 FIN;

                                ?>
                                <small>

                                    <?php
                                    echo <<<FIN
                                       <cite title="$address"> $localisation
                                       FIN;


                                    ?>
                                    <label id="lieu"></label>
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                    </cite>
                                </small>
                                <p><?php
                                    echo <<<FIN
                                <i class="fa fa-phone"></i>$phone<label id="number"></label> 
                                FIN;

                                    ?>
                                    <br />
                                    <i class="glyphicon glyphicon-envelope">
                                        <?php
                                        echo <<<FIN
                                          </i>$email<label id="mail"></label>
                                          FIN;
                                        ?>
                                        <?php
                                        echo <<<FIN
                                        <br />
                                        <i class="glyphicon glyphicon-globe"></i><a href=$linkdin>Website</a>
                                        <br />
                                        FIN;

                                        ?>
                                        <?php
                                        echo <<<FIN
                                        <i class="glyphicon glyphicon-gift"></i>$naissance<label id="date_naiss"></label>
                                        FIN;

                                        ?>
                                        <br />
                                        <?php
                                        echo <<<FIN
                                        <i class="glyphicon glyphicon-home"></i>$nationality <label id="pays"></label>
                                        FIN;

                                        ?>
                                        <?php
                                        echo <<<FIN
                                          <br />
                                          <i class="fa fa-user"></i>Skills:$skills <label ></label>
                                          <br />
                                          <i class="fa fa-certificate"></i>Promotion:X$promotion <label ></label>
                                          FIN;



                                        ?>
                                        <?php
                                        echo <<<FIN
                                       <br />
                                       <i class="fa fa-comment "></i> About me<br /><textarea cols="30" rows="10" style="resize:none">$aboutme</textarea>
                                       FIN;


                                        ?>
                                </p>
                                <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">
                                        Social</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="sr-only">Social</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Twitter</a></li>
                                        <li><a href="#">Google +</a></li>
                                        <li><a href="#">Facebook</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Github</a></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-sm-6 col-md-4">
                                <img src="../Project_Web/images/X.svg.jpeg" alt="" class="img-rounded img-responsive" />
                                <img src="../Project_Web/images/X1.jpeg" alt="" class="img-rounded img-responsive" />
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <!--/tab-pane-->
                <div class="tab-pane <?php if ($v == 2) {
                                            echo 'active';
                                        } ?>" id="messages">

                    <!-- Form msg -->

                    <p style="color: blue;font-size: 14px;font-family: arial;text-shadow: 2px 2px greenyellow;">Mon Compte -> messages</p>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 column">
                                <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                        <h3 class="panel-title">Message Form</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form action="#" method="post" accept-charset="utf-8">
                                            <div class="col-xs-5">

                                                <h2>Membres</h2>

                                                <br>
                                                <div class="input-group">
                                                    <span class="add-on"><i class="icon-user"></i></span>

                                                    <select name="membres" size="1" id="select1" class="form-control form-control-alternative" style="text-align:center;width: 15em;" required onclick="getOption()">
                                                        <option value="Selectioner un membre">Selectioner un membre</option>
                                                        <?php
                                                        $menbres = utilisateurs::selectUsers($dbh);

                                                        while ($user = $menbres->fetch()) {
                                                            $userlogin = $user->login;
                                                            $useremail = $user->email;
                                                            echo <<<FIN
                                                        <option  value="$useremail">$userlogin</option>
                                                        FIN;
                                                        }

                                                        ?>
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="col-xs-7">

                                                <div class="modal-body" style="padding: 5px;">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                                            <span class="output"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                                            <input class="form-control" name="subject" placeholder="Subject" type="text" required />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <textarea style="resize:vertical;" class="form-control" placeholder="Message..." rows="6" name="comment" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer" style="margin-bottom:-14px;">
                                                    <input type="submit" name="send" class="btn btn-success" value="Send" />
                                                    <!--<span class="glyphicon glyphicon-ok"></span>-->
                                                    <input type="reset" class="btn btn-danger" value="Clear" style="float: right;" />
                                                </div>


                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/tab-pane-->
            <div class="tab-pane <?php if ($v == 3) {
                                        echo 'active';
                                    } ?>" id="settings">

                <!-- Form Name -->
                <p style="color: blue;font-size: 14px;font-family: arial;text-shadow: 2px 2px greenyellow;">Mon Compte -> Parametres</p>
                <hr>
                <div class="container">
                    <form class="form-horizontal" action="#" style="text-align:center;" method="post">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="textinput">Changer son adresse </label>
                                <div class="col-md-4">
                                    <input id="textinput" name="address" type="text" placeholder="your current adress " class="form-control input-md">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Changer son password</label>
                                <div class="col-md-4">
                                    <input name="passwordchange" type="password" placeholder="new password" class="form-control " id="input_mdp">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Confirmation password</label>
                                <div class="col-md-4">
                                    <input name="passwordrepeate" type="password" placeholder="repeat password" class="form-control " id="input_mdp2" oninput='verify()'>
                                    *<label id="msg"></label>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Changer Phone Number </label>
                                <div class="col-md-4">
                                    <input class="form-control" type="tel" id="tel" name="phonenumber" placeholder="Entrer votre nouveau mobile number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Modifier mon description</label>
                                <div class="col-md-4">
                                    <textarea id="adresse" name="aboutme" rows="5" cols="50" class="form-control form-control-alternative" placeholder="aboutme"></textarea>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">view account status</label>
                                <div class="col-md-4">
                                    <button id="singlebutton" name="changer" class="btn btn-success">changer</button>
                                </div>
                            </div>

                            <!-- Button -->
                            <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                        </fieldset>
                    </form>

                </div>

                <hr>

            </div>
            <!--/tab-pane-->
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
</div>
<footer id="footer-multi">

    <div class="rights" id="footer">
        <p>Copyright© 2022, BI Tous droits réservés.</p>
    </div>
</footer>
<div id="texte-loi">
    <p>
        <i>Conformément aux articles 39 et suivants de la loi n° 78-17 du 6 janvier 1978 modifiée, relative à l’informatique, aux fichiers et aux libertés, toute personne peut obtenir communication et, le cas échéant, rectification ou suppression des informations la concernant, en s’adressant au Binet Inter, rubrique 'Nous contacter'.</i>
    </p>
</div>

</div>