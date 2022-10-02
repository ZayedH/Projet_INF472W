<?php




function resetpassword($email, $date)
{

    echo <<< FIN

    <div class="body">
        <div class="loginForm pb-5 " style="overflow:auto;">

            <div class="caviar">


                <div class="title2"> réinitialiser votre mot de passe.</div>
            </div>
            <div class="centeredLogin">
                <form action="index.php?" method="post">
                    <div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key icon " style="color:blue;"></i></span>
                            </div>
                            <input type="password" id="input_mdp"  placeholder=" New Mot de passe" name="pwd" required />
                        </div>
                        <div class="input-group mb-4" style="margin-top:10px; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key icon" style="color:black;"></i></span>
                            </div>
                            <input type="password"  id="input_mdp2"  placeholder="Repeat Mot de passe" name="repeatpwd" required  oninput="verify()">
                            <label id="msg"  ></label>
                        
                        </div>
                        
                        <div style="margin-top:10px;">
                               <input type="hidden"  name="email"  value=$email>
                               <input type="hidden"  name="date"  value=$date>
                            <button type="submit" name="reset-password" class="btn btn-success" style="margin-left:50px; width: 10vw;">reset-password</button>

                        </div>


                    </div>
                </form>


            </div>
        </div>
    </div>
</body>

</html>

FIN;
}
