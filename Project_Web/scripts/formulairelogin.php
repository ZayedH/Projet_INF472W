<?php
$c = 0;
if (isset($_POST["reset-password"])) {

    $c = 1;
}




?>


<div class="body">
    <div class="loginForm pb-5 " style="overflow:auto;">
        <?php


        if ($c == 0) {
            echo <<<FIN
                     <div class="m-4">
                     <div class="alert alert-danger alert-dismissible fade show">
                         <strong>Error!</strong> Les informations transmises n'ont pas permis de vous authentifier.<a href="index.php?todo=oublieé" class="alert-link">mot de passe oublié</a>.
                         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                     </div>
                 </div>
                 FIN;
        } else {
            echo <<<FIN
                <div class="m-4">
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>success!</strong>password reseted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        }


        ?>



        <div class="caviar">
            <div class="title1">Bienvenue au Binet Inter</div>




            <div class="title2">Connectez-vous</div>
        </div>
        <div class="centeredLogin">
            <form action="index.php?page=accueil&todo=login" method="post">
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
            <form action="index.php?todo=Inscription" method="get">
                <button style="margin-top:20px; margin-left:80px; width: 10vw;" type="submit" name="inscription" class="btn btn-danger"> Inscription </button>
            </form>
        </div>
    </div>
</div>
</body>

</html>