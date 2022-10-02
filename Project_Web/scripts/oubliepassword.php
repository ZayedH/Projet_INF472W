<div class="body">
    <div class="loginForm pb-5 " style="overflow:auto;">
        <?php
        if ($oubl == 0) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>This_Link_is no more Valid.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($oubl == 1) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>Use_polytechnique_email and make sure you have an account.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($oubl == 2) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</srong>check your mail inbox please!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($oubl == 4) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</srong>Tous les champs sont obligatoires!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } else {
            echo <<<FIN
            <div class="caviar">
            <div class="title1" style="color:red">J'ai oublié mon mot de passe</div>
            <div class="title2">Indiquez-nous votre adresse email, vous recevrez alors un e-mail vous expliquant la procédure à suivre pour réinitialiser votre mot de passe.</div>
        </div>
        FIN;
        }

        ?>



        <div class="centeredLogin">
            <form action="index.php?todo=resetpassword" method="post">
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope icon " style="color:blue;"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="...@polytechnique.edu" name="email" required />
                    </div>

                    <div style="margin-top:10px;">
                        <button type="submit" class="btn btn-danger " style="margin-left:80px; width: 10vw;">Send</button>

                    </div>


                </div>
            </form>


        </div>
    </div>
</div>
</body>

</html>