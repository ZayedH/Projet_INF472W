<?php
if (isset($_POST['deleteuser'])) {


    if (utilisateurs::deletuser($dbh, $_POST['login']))
        unset($_POST['deleteuser']);
}
if (isset($_POST['event'])) {


    if (generateEvent::deleteEvent($dbh, $_POST['idevent']))
        unset($_POST['event']);
}
if (isset($_POST['link'])) {


    if (pwdreset::deletelink($dbh, $_POST['idlink']))
        unset($_POST['link']);
}

if (isset($_POST['register'])) {


    if (registerlink::deleteregister($dbh, $_POST['idregister']))
        unset($_POST['register']);
}


?>



<script>
    $(document).ready(function() {

        $('#tab_users').DataTable({
            "scrollY": 200,
            "scrollX": true
        });
        var table = $('#tab_users').DataTable();
        $('#tab_users tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            confirm('You clicked on ' + data[0] + '\'s row');
        });

        $('#tab_link').DataTable({
            "scrollY": 200,
            "scrollX": true
        });
        $('#tab_password').DataTable({
            "scrollY": 200,
            "scrollX": true
        });

        $('#tab_event').DataTable({
            "scrollY": 200,
            "scrollX": true
        });






    });
</script>

<div class="container-fluid">
    <br>
    <h2 style="text-align:center">Tableau des utilisateurs</h2>
    <hr>
    <table id="tab_users" class="display nowrap" style="width:100%">
        <thead>
            <tr style="background-color:red ;color:blue">
                <th>login</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Promotion</th>
                <th>Date_Nais</th>
                <th>Email</th>
                <th>Sexe</th>
                <th>Profil</th>
                <th>Phone_Num</th>
                <th>Nationalité</th>
                <th>Adresse</th>
                <th>Localisation</th>
                <th>About me</th>
                <th>Skills</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sth = utilisateurs::selectUsers($dbh);
            while ($user = $sth->fetch()) {
                $login = $user->login;
                $nom = $user->nom;
                $prenom = $user->prenom;
                $promotion = $user->promotion;
                $naissance = $user->naissance;
                $email = $user->email;
                $sexe = $user->sexe;
                $profile = $user->profile;
                $phone = $user->phone;
                $nationality = $user->nationality;
                $address = $user->address;
                $localisation = $user->localisation;
                $aboutme = $user->aboutme;
                $skills = $user->skills;
                echo <<<FIN
            <tr>
                <th>$login</th>
                <th>$nom</th>
                <th>$prenom</th>
                <th>$promotion</th>
                <th>$naissance</th>
                <th>$email</th>
                <th>$sexe</th>
                <th>$profile</th>
                <th>$phone</th>
                <th>$nationality</th>
                <th>$address</th>
                <th>$localisation</th>
                <th>$aboutme</th>
                <th>$skills</th>
                <th><button type="button" class="btn btn-primary">
                <svg  width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
                    </button>
              </th>
              <th>  
              <form action="#" method="post"  >
                 <input type="hidden"  name="login"  value=$login>
                    <button type="submit"  name="deleteuser"   class="btn btn-outline-danger">
                        
                        <svg  width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </button>
                   
                </form>
                </th>
            </tr>
            FIN;
            }

            ?>

        </tbody>
        <tfoot>
            <tr style="background-color:yellow">
                <th>login</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Promotion</th>
                <th>Date_Nais</th>
                <th>Email</th>
                <th>Sexe</th>
                <th>Profil</th>
                <th>Phone_Num</th>
                <th>Nationalité</th>
                <th>Adresse</th>
                <th>Localisation</th>
                <th>About me</th>
                <th>Skills</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
    </table>
    <hr>
</div>

<div class="container-fluid">
    <br>
    <h2 style="text-align:center">Tableau des liens d'inscription</h2>
    <hr>
    <table id="tab_link" class="display" style="width:100%">
        <thead>
            <tr style="background-color:green;color:blue">
                <th>Register_email</th>
                <th>temps</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $links = registerlink::selectlinks($dbh);
            while ($link = $links->fetch()) {
                $idregister = $link->registerId;
                $registeremail = $link->registerEmail;
                $registerexpire = $link->registerExpires;
                $time = date('Y-m-d', $registerexpire);
                echo <<<FIN
                 <tr>
                <th>$registeremail</th>
                <th>$time</th>
                <th>
                <form action="#" method="post"  >
                 <input type="hidden"  name="idregister"  value=$idregister>
                    <button type="submit" name="register"  class="btn btn-outline-danger">
                        <svg  width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </button>
                </form>
                </th>
            </tr>
            FIN;
            }

            ?>
        </tbody>
        <tfoot>
            <tr style="background-color:yellow">
                <th>Register_email</th>
                <th>temps</th>
                <th>Delete</th>
            </tr>
        </tfoot>
    </table>
    <hr>
</div>
<div class="container-fluid">
    <br>
    <h2 style="text-align:center">Tableau des evenements</h2>
    <hr>
    <table id="tab_event" class="display" style="width:100%">
        <thead>
            <tr style="background-color:green;color:blue">
                <th>title</th>
                <th>texte</th>
                <th>link</th>
                <th>time_upload</th>
                <th>Img_Name</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $events = generateevent::selectEvent($dbh);

            while ($event = $events->fetch()) {
                $idevent = $event->idEvent;
                $title = $event->title;
                $text = $event->text;
                $linkt = $event->link;
                $time_upload = $event->timeFrame;
                $img = $event->imagename;
                $time = date('Y-m-d', $time_upload);

                echo <<<FIN
                <tr>
                <th>$title</th>
                <th>$text</th>
                <th>$linkt</th>
                <th>$time</th>
                <th>$img</th>
                <th>
                <form action="#" method="post"  >
                 <input type="hidden"  name="idevent"  value=$idevent>
                    <button type="submit" name="event" class="btn btn-outline-danger">
                        <svg  width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </button>
                </form> 

                </th>
     
            </tr>
            FIN;
            }


            ?>



        </tbody>
        <tfoot>
            <tr style="background-color:yellow">
                <th>title</th>
                <th>texte</th>
                <th>link</th>
                <th>timeframe</th>
                <th>Img_Name</th>
                <th>Edit_Delete</th>
            </tr>
        </tfoot>
    </table>
    <hr>
</div>
<div class="container-fluid">
    <br>
    <h2 style="text-align:center">Tableau de reinitialisation des mots de passe</h2>
    <hr>
    <table id="tab_password" class="display" style="width:100%">
        <thead>
            <tr style="background-color:green;color:blue">
                <th>email</th>
                <th>temps</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $reslink = pwdreset::selectrelink($dbh);
            while ($link = $reslink->fetch()) {
                $idlink = $link->pwdResetId;
                $pwdresetemail = $link->pwdResetEmail;
                $pwdrestexpires = $link->pwdResetExpires;
                $time = date('Y-m-d', $pwdrestexpires);
                echo <<<FIN
                <tr>
                <th>$pwdresetemail</th>
                <th>$time</th>
                <th>
                <form action="#" method="post"  >
                 <input type="hidden"  name="idlink"  value=$idlink>
                    <button type="submit" name="link" class="btn btn-outline-danger">
                        <svg  width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </button>
                </form>
                </th>
            </tr>
            FIN;
            }


            ?>
        </tbody>
        <tfoot>
            <tr style="background-color:yellow">
                <th>email</th>
                <th>temps</th>
                <th>Edit_Delete</th>
            </tr>
        </tfoot>
    </table>
    <hr>
</div>



</div>