<?php
function generateHTMLHeader($dbh, $askedPage, $login)
{
  echo <<<FIN
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="Zayed" content="Binet-Inter" />
    <meta name="keywords" content="site,web,binet,inter" />
    <meta name="description" content="Site Web du Binet Inter" />
    <link rel="stylesheet" href="../Project_Web/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Project_Web/css/mafeuille.css" />
    <link rel="stylesheet" href="../Project_Web/css/bootstrap/bootstrap.min.css" />
    <link rel="icon" href="../Project_Web/images/icone.ico">
    <script src="../Project_Web/js/js/bootstrap.bundle.min.js"></script>
    <script src="../Project_Web/js/jquery-3.6.0.min.js"></script>
    <script  src="../Project_Web/js/majs.js"></script>

    <script src="../Project_Web/js/bootstrap.min.js"></script>
    <link rel=”stylesheet” href=”../Project_Web/css/all.min.css”>


    <script src="../Project_Web/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../Project_Web/css/jquery.dataTables.min.css">

    
    <title>Binet Inter - $askedPage</title>
</head>

<body>
FIN;
  $admin = utilisateurs::isAdmin($dbh, $login);
  $activeaccueil = '';
  $activeEvenement = '';
  $activeContact = '';
  $activeInfo = '';
  if ($askedPage == 'accueil') {
    $activeaccueil = $activeaccueil . 'active';
  }
  if ($askedPage == 'A' || $askedPage == 'B' || $askedPage == 'C') {
    $activeEvenement = $activeEvenement . 'active';
  }
  if ($askedPage == 'contact') {
    $activeContact = $activeContact . 'active';
  }
  if ($askedPage == 'info') {
    $activeInfo = $activeInfo . 'active';
  }

  echo <<<FIN
<div class="container-fluid ">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">
            <img src="../Project_Web/images/icone.ico" style="width:30px;height:30px;" class="d-inline-block align-top" alt="">
            Binet Inter
        </a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link $activeaccueil" aria-current="page" href="index.php?page=accueil">Accueil</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link $activeInfo" href="index.php?page=info">Informations pratiques</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle $activeEvenement " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Evennement
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
FIN;
  $Events = generateevent::selectEvent($dbh);
  while ($event = $Events->fetch()) {
    $title = $event->title;
    $id = $event->idEvent;
    echo <<<FIN
  <li><a class="dropdown-item" href="index.php?page=accueil#$id">$title</a></li>
  FIN;
  }


  echo <<<FIN
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="index.php?page=info">About US</a></li>
      </ul>
    </li>
FIN;

  echo <<<FIN
    <li class="nav-item ">
                    <a class="nav-link $activeContact"  href="index.php?page=contact">Nous contacter</a>
    </li>
  FIN;
  if ($admin) {
    echo <<<FIN
    <li class="nav-item">
      <a class="nav-link" style="color:red" href="index.php?page=tables">Tables</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " style="color:blue;" href="index.php?page=poster">Poster</a>
    </li>
FIN;
  }
  echo <<<FIN
  </ul> 
  
  <form   class="d-flex" >
FIN;
  if ($askedPage != 'moncompte') {
    echo <<<FIN
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit"><i class="fa fa-search icon"></i></button>
    FIN;
  }
  if ($askedPage == 'moncompte') {
    echo <<<FIN
         <br><br>
    <div class="nav-item dropdown" style="margin-left:810px">
  FIN;
  }
  if ($askedPage != 'moncompte') {
    echo <<<FIN

<div class="nav-item dropdown">
FIN;
  }
  echo <<<FIN
    <a class="nav-link dropdown-toggle" href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="fa fa-user icon"></span>$login</a>
            <ul class="dropdown-menu  " aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="index.php?page=moncompte"><span class="fa fa-user icon"></span>Mon Compte</a></li>
              
                <li><a class="dropdown-item" href="index.php?page=$askedPage&todo=logout"><span class="fa fa-sign-out"></span> Déconnexion</a></li>
            </ul>
    </div>
  </form>
  
  
</div>
</div>
</nav>

FIN;
}
function generateHTMLFooter()
{
  echo <<<FIN
    </body>                            
</html>
FIN;
}
//////////////////////////////////////////////we can generate the length and the event using php
function generatepages($dbh, $login)
{
  $pageList = array(
    array(
      'name' => 'accueil'
    ),
    array(
      'name' => 'contact'

    ),
    array(
      'name' => 'info'

    ),
    array(
      'name' => 'moncompte'

    ),

  );
  if (utilisateurs::isAdmin($dbh, $login)) {
    $tables = array(array('name' => 'tables'), array('name' => 'poster'));
    $pageListe = array_merge($pageList, $tables);
    return $pageListe;
  } else {
    return $pageList;
  }
}

function checkPage($askedPage, $pageList)
{

  foreach ($pageList as $page) {
    if ($page['name'] == $askedPage) {
      return true;
    }
  }
  return false;
}
function  afficheFormulaireLogin($askedpage = '?')
{
  echo <<<FIN
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="author" content="Zayed" />
      <meta name="keywords" content="site,web,binet,inter" />
      <meta name="description" content="Site Web du Binet Inter" />
      <link rel="stylesheet" href="../Project_Web//css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../Project_Web/css/mafeuille.css" />
      <link rel="stylesheet" href="../Project_Web/css/bootstrap/bootstrap.min.css" />
      <link rel="icon" href="../Project_Web/images/icone.ico">
      <script src="../Project_Web/js/js/bootstrap.bundle.min.js"></script>
      <title>Binet Inter - Authentification</title>
  </head>
  
  <body style="background-image: url(../Project_Web/images/image1.jpg);">
      <div class="body">
          <div class="loginForm pb-5 " style="overflow:auto;">
              <div class="caviar">
                  <div class="title1">Bienvenue au Binet Inter</div>
                  <div class="title2">Connectez-vous</div>
              </div>
              <div class="centeredLogin">
                  <form action="index.php?page=$askedpage&todo=login" method="post">
                      <div>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-user icon " style="color:blue;"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="prenom.nom" name="login" required />
                          </div>
                          <div class="input-group mb-3" style="margin-top:10px;">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-key icon" style="color:black;"></i></span>
                              </div>
                              <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                          </div>
  
                          <button type="submit" class="btn btn-success " style="margin-left:80px; width: 10vw;">Connexion</button>
  
  
                      </div>
                  </form>
                  <form action="index.php?todo=Guest" method="post">
                      <button style="margin-top:20px; margin-left:80px; width: 10vw;" type="submit" class="btn btn-info">Connexion Guest</button>
                  </form>
                  <form action="index.php?todo=Inscription" method="post">
                      <button style="margin-top:20px; margin-left:80px; width: 10vw;" type="submit" class="btn btn-danger"> Inscription </button>
                  </form>
              </div>
          </div>
      </div>
  </body>
  
  </html>
  FIN;
}

function headerout($title)
{
  echo <<<FIN



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="" />
    <meta name="keywords" content="site,web,binet,inter" />
    <meta name="description" content="Site Web du Binet Inter" />
    <link rel="stylesheet" href="../Project_Web//css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Project_Web/css/mafeuille.css" />
    <link rel="stylesheet" href="../Project_Web/css/bootstrap/bootstrap.min.css" />
    <link rel="icon" href="../Project_Web/images/icone.ico">
    <script src="../Project_Web/js/js/bootstrap.bundle.min.js"></script>
    <script src="../Project_Web/js/jquery-3.6.0.min.js"></script>
    <script src="../Project_Web/js/js/bootstrap.bundle.min.js"></script>
    <script src="../Project_Web/js/majs.js"></script>


    <title>Binet Inter - $title</title>
</head>

<body  style="background-image: url(../Project_Web/images/image1.jpg);">
FIN;
}
