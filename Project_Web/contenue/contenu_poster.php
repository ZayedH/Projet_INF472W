<?php
$fileDestination = '../Project_Web/images/image1.jpg';


if (isset($_POST['chargement'])) {
    $file = $_FILES['image'];
    $u = 0;
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
            if ($fileSize < 100000000) {

                $nextevent = generateevent::selectlast($dbh);
                $idimage = $nextevent->AUTO_INCREMENT;
                $nameimage = "image" . $idimage;
                $fileNameNew = $nameimage . "." . $fileActualExt;
                $fileDestination = "../Project_Web/images/" . $fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);

                unset($_POST['chargement']);
                if (isset($_POST['publish'])) {

                    if (!empty($_POST['title']) && !empty($_POST['description'])) {


                        if (empty($_POST['link'])) {
                            generateevent::insertEvent($dbh, $_POST['title'], $_POST['description'], '#', date("U"), $_POST["hidimage"]);
                        } else {
                            generateevent::insertEvent($dbh, $_POST['title'], $_POST['description'], $_POST['link'], date("U"),  $_POST["hidimage"]);
                        }
                    }
                }
            } else {
                $error = "the size of your image is big";
            }
        } else {
            $error = "error";
        }
    } else {
        $error = "not_allowed";
    }
}
$pp = 0;
if (isset($_POST['publish'])) {

    if (!empty($_POST['title']) && !empty($_POST['description'])) {
        $pp = 1;


        if (empty($_POST['link'])) {
            generateevent::insertEvent($dbh, $_POST['title'], $_POST['description'], '#', date("U"), $_POST["hidimage"]);
        } else {
            generateevent::insertEvent($dbh, $_POST['title'], $_POST['description'], $_POST['link'], date("U"),  $_POST["hidimage"]);
        }
    }
}



?>



<div class="container" style="background-image: url(../Project_Web/images/image.jpg);">
    <?php
    if ($pp == 1) {
        echo <<<FIN
        <div class="m-4">
        <div class="alert alert-success alert-dismissible fade show">
            <strong>success!</strong> Poublication reussi.vouvs pouvez le voir sur <a href="index.php?todo=accueil" class="alert-link">Accueil</a>.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    FIN;
    }

    ?>



    <p class="h2 text-center">Ajouter une Photo et un titre et une Description </p>
    <p class="h2 text-center">Comme option vous pouvez ajouter un lien pour plus d'informations </p>

    <div class="preview text-center">
        <?php
        echo <<<FIN
            <img src= $fileDestination width="350" height="350" alt="" class="img-rounded img-responsive" />
            FIN;
        ?>


        <br>
        <div class="browse-button">
            <br>
            <i class="fa fa-pencil-alt"></i>
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type="file" name="image" class="text-center center-block file-upload" accept="image/jpg,image/jpeg,image/png" style="width: 200px;">
                <br><br>
                <input type="submit" id="submit1" name="chargement" value="Charger l'image" />
            </form>
        </div>
        <span class="Error" style="color:red"><?php if (!empty($_POST['chargement']) && isset($error)) {
                                                    echo $error;
                                                } ?></span>
    </div>
    <form action="#" method="post">
        <div class="form-group">
            <label>Titre de l'évenement:*</label>
            <input class="form-control" type="text" id=tittle name="title" placeholder="Enter the event title" />
            <span class="Error"></span>
        </div>
        <div class="form-group">
            <label>Description:*</label>
            <textarea id="input-txt" name="description" rows="5" class="form-control form-control-alternative" placeholder="Description du post"></textarea>
            <span class="Error"></span>
        </div>
        <div class="form-group " style="margin-bottom: 15px;">
            <label>Lien URL:</label>
            <input class="form-control" id="link" name="link" placeholder="Enter the URL link" />
            <?php
            echo <<<FIN
            <input type="hidden"  name="hidimage"  value=$fileDestination>
            FIN;
            ?>
            <span class="Error"></span>
        </div>
        <div class="form-group">

        </div>
        <div class="form-group">
            <input class="btn btn-primary btn-block" type="submit" name="publish" value="Submit" style="margin-left:600px;" />
        </div>
    </form>
</div>
<br>
<div class="rights" style="text-align: center;" id="footer">

    <p>Copyright© 2022, BI Tous droits réservés.</p>

</div>

<div id="texte-loi">
    <p>
        <i>Conformément aux articles 39 et suivants de la loi n° 78-17 du 6 janvier 1978 modifiée, relative à l’informatique, aux fichiers et aux libertés, toute personne peut obtenir communication et, le cas échéant, rectification ou suppression des informations la concernant, en s’adressant au Binet Inter, rubrique 'Nous contacter'.</i>
    </p>

</div>

</div>