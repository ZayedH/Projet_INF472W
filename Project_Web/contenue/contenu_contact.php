<?php
$con = 0;
if (isset($_POST["send"])) {
    $user = utilisateurs::getutilisateur($dbh, $_SESSION['login']);
    $sender = $user->email;
    $con = 1;

    if (!empty($_POST["sujet"]) && !empty($_POST["text"])) {
        if (!empty($_POST["copie"])) {
            sendsms($sender, $_POST["text"], $_POST["sujet"], 1);
        } else {
            sendsms($sender, $_POST["text"], $_POST["sujet"], 0);
        }
        unset($_POST["send"]);
        $con = 2;
    }
}


?>
<?php

function smssend()
{
    echo <<<FIN
<div class="m-1">
                  <div class="alert alert-success alert-dismissible fade show">
                      <strong>success!</strong> Nous vous répondrons le plus vite possible .
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
              </div>
FIN;
}

?>


<div class="home">

    <main>
        <section class="visual-block" style="background-image: url(../Project_Web/images/header-contact.png); min-height: 400px ">
            <div class="container">
                <div class="caption text-center text-white" id='contenu'>

                    <img src="https://assets.expresscv.com/images/contact-1.svg" alt="Contact Express">
                    <h1 style="font-weight: 900; margin: 5px; font-size: 36px">Nous contacter</h1>
                </div>
            </div>
        </section>
        <div class="container contact">
            <div class="row">
                <div class="col-md-3" style="background: yellowgreen">

                    <div class="contact-info">

                        <br><br><br><br>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="https://assets.expresscv.com/images/contact-2.svg" alt="Contact ExpressCV">
                                <br><br><br><br>
                            </div>
                            <div class="col-md-8">
                                <b>L'actualité du Binet</b>
                                <p>Accédez à notre Générateur d'évenements.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="https://assets.expresscv.com/images/contact-4.svg" alt="Contact ExpressCV">
                                <br><br><br><br>
                            </div>
                            <div class="col-md-8">
                                <b>Contactez nous 7/7</b>
                                <p>Nos administrateurs sont là pour vous aider.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="https://assets.expresscv.com/images/contact-5.svg" alt="Contact ExpressCV">
                                <br><br><br><br>
                            </div>
                            <div class="col-md-8">
                                <b>Vos données sont Stockées dans votre Espace Client</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    if ($con == 2) {
                        smssend();
                    }
                    if ($con == 1) {
                        echo <<<FIN
                        <div class="m-1">
                        <div class="alert alert-danger alert-dismissible fade show">
                      <strong>Error!</strong> Tous les champs sont obligatoires .
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>
                                </div>
                    FIN;
                    }
                    $con = 0;
                    ?>
                    <br><br>
                    <label style="font-size: 1.5em; color: #2a2d31;">Formulaire de Contact</label>
                    <p>Envoyer un e-mail. Tous les champs marqués d'un astérisque * sont obligatoires.</p>
                    <form action="#" method="post">
                        <div class="control-group">
                            <div class="control-label">
                                <label class="hasPopover required" title="Sujet" data-content="Saisir ici le sujet de votre message.">

                                    Sujet:
                                    <span class="star">&#160;*</span>
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" size="60" required aria-required="true" name="sujet" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <label class="hasPopover required" title="Message" data-content="Saisir ici votre message.">

                                    Message
                                    <span class="star">&#160;*</span>
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="text" cols="50" rows="30" class="form-control" required aria-required="true" style="height: 15em;"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <label class="hasPopover" title="Envoyer une copie à votre adresse" data-content="Envoie une copie du message à l'adresse que vous avez fournie.">
                                    Envoyer une copie à votre adresse</label>
                            </div>
                            <div class="controls">
                                <input type="checkbox" name="copie" value="1" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <label class="hasPopover required" title="Captcha" data-content="Merci de compléter le contrôle de sécurité.">

                                    Captcha
                                    <span class="star">&#160;*</span>
                                </label>
                            </div>
                            <div class="controls">
                                <div class=" required"></div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary validate" type="submit" name="send">Envoyer</button>
                        </div>

                    </form>



                </div>
                <div class="col-md-3" style="padding: 2%">

                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2725.1491781633295!2d2.2091030155787474!3d48.71318435543016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6788dd891b127%3A0x43c2be8ce6d1821e!2s%C3%89cole%20Polytechnique!5e1!3m2!1sen!2sus!4v1644685746728!5m2!1sen!2sus" width="400" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                    </div>

                </div>
            </div>
        </div>



    </main>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="rights" style="text-align: center;" id="footer">

        <p>Copyright© 2022, BI Tous droits réservés.</p>

    </div>

    <div id="texte-loi">
        <p>
            <i>Conformément aux articles 39 et suivants de la loi n° 78-17 du 6 janvier 1978 modifiée, relative à l’informatique, aux fichiers et aux libertés, toute personne peut obtenir communication et, le cas échéant, rectification ou suppression des informations la concernant, en s’adressant au Binet Inter, rubrique 'Nous contacter'.</i>
        </p>

    </div>



</div>
</div>