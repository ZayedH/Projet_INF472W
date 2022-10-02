<div class="body">
    <div class="loginForm pb-5 " style="overflow:auto;">
        <?php
        if ($val == 4) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>you already have an account .
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($val == 1) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>Your email shoud be a polytechnique email.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($val == 2) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>Invalid email format.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($val == 3) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>Please enter your email!.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($val == 5) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</strong> Check your mail inbox please!.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } elseif ($val == 6) {
            echo <<<FIN
            <div class="m-4">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>This Link is no more  valid.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            FIN;
        } else {
            echo <<<FIN
            <div class="caviar">
            <div class="title1" style="color:red">Registration</div>
            <div class="title2">Indiquez-nous votre adresse email, vous recevrez alors un e-mail vous expliquant la procédure à suivre pour s'inscrir.</div>
        </div>
        FIN;
        }

        ?>
        <div class="centeredLogin">
            <form action="index.php?todo=register" method="post">
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope icon " style="color:blue;"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="...@polytechnique.edu" name="email" required />
                    </div>

                    <div style="margin-top:10px;">
                        <button type="submit" class="btn btn-danger " name='link' style="margin-left:80px; width: 10vw;">Send</button>

                    </div>


                </div>
            </form>


        </div>
    </div>
</div>
</body>

</html>