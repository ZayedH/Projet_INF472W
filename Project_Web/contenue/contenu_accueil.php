<?php

function generateEvent($url, $title, $link)
{            //////remember active ////////////////////////////////////////////////////////////////////////////////////////////////
  echo <<<FIN
    <div class="carousel-item">
      <img src=$url class="d-block " alt="..." style=" width: 100% !important;height: 80vh;">
      <div class="carousel-caption d-none d-md-block ">
        <div style="background: rgb(85, 83, 81);opacity: 0.6;">
          <h1><a href="$link" style="color:white">$title</a></h1>
         
          
        </div>

      </div>
    </div>
  FIN;
}
//<textarea  cols="60" rows="5" style="resize:none" readonly>$text</textarea>
function generateSlide($number)
{
  $numbert = $number - 1;


  echo <<<FIN
<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="$numbert" aria-label="Slide $number"></button>
FIN;
}


?>
<?php
$sth = generateevent::selectEvent($dbh);

?>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <?php
    $leng = $sth->rowcount();
    for ($i = 1; $i <= $leng; $i++) {
      if ($i == 1) {
        $t = $i - 1;
        echo <<<FIN
         <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="$t" class="active" aria-current="true" aria-label="Slide $i"></button>
         FIN;
      } else {
        generateSlide($i);
      }
    }


    ?>
  </div>
  <div class="carousel-inner">

    <?php
    $active = 0;
    while ($event = $sth->fetch()) {
      $title = $event->title;
      $text = $event->text;
      $link = $event->link;
      $imag = $event->imagename;
      if ($active == 0) {
        echo <<<FIN
          <div class="carousel-item active">
          <img src=$imag class="d-block  " alt="..." style=" width: 100% !important;height: 80vh;">
          <div class="carousel-caption d-none d-md-block">
            <div style="background: rgb(85, 83, 81);opacity: 0.6;">
              <h1><a href="$link" style="color:white">$title</a></h1>
      
              
            </div>
          </div>
        </div>
        FIN;
        $active = 1;
      } else {
        generateEvent($imag, $title, $link);
      }
    }
    //<textarea  cols="60" rows="5" style="resize:none" readonly>$text</textarea>

    ?>
    <script>
      //Tronquer du texte trop long
      $(document).ready(function() {
        // on sélectionne tous les div avec la classe zoneTexte et on les parcourt
        $("div.zoneTexte").each(function(i) {
          // on récupère la longueur du texte et on coupe à la longueur 100 (s'il est aussi long)
          var contenu = $(this).html();
          var longueur = contenu.length;
          if (longueur > 500) {
            var debut = contenu.substr(0, 500);
            var suite = contenu.substr(501);
            $(this).html(debut);
            $(this).append("<span style='font-weight: bold' id='continuer" + (i + 1) + "'> [Afficher la suite...]</span>");
            $(this).append("<span id='suite" + (i + 1) + "'>" + suite + "</span>");
            $(this).append("<span style='font-weight: bold' id='masquer" + (i + 1) + "'> [Réduire]</span>");
            $("#suite" + (i + 1)).hide();
            $(this).find("span#continuer" + (i + 1)).click(
              function() {
                $(this).hide();
                $("#suite" + (i + 1)).fadeIn("slow");
                $("#masquer" + (i + 1)).fadeIn("slow");
              })
            $(this).find("span#masquer" + (i + 1)).click(
              function() {
                $(this).hide();
                $("#suite" + (i + 1)).fadeOut("slow", function() {
                  $("#continuer" + (i + 1)).fadeIn("slow")
                });
              }).hide()
          }
        });
      });
    </script>



  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
<div class="container bootstrap snippet">
  <div class="row">
    <div class="col-md-7" style="text-align:center ; height: 800px; line-height: 3em; overflow:scroll; border: thin #000 solid; padding: 5px;">

      <?php
      $events = generateevent::selectEvent($dbh);
      while ($event = $events->fetch()) {
        $time = $event->timeFrame;

      ?>
        <div style="border: 1px solid black;">


          <div class="ui middle aligned fifteen column grid">
            <div class="fourteen wide column">
              <div class="ui middle aligned fifteen column grid">

                <div class="center aligned middle aligned column">
                  <i aria-hidden="true" class="arrow right icon"></i>
                </div>
                <div class="seven wide column">

                  <img src="images/icone_group.png" height=80 width=80 alt="image">

                  <img src="images/img-.jpg" height=80 width=80 alt="image">

                </div>
              </div>
            </div>

          </div>

          <div style="text-align: right; font-size: small; color: grey;">
            <span><?php echo date('l Y-m-d h:i:s', $time); ?></span>
          </div>
          <div class="title" style="text-align:center;">
            <?php
            $title = $event->title;
            $id = $event->idEvent;
            echo <<<FIN
                    <h3 id="$id"> $title</h3>
                    FIN;

            ?>
          </div>
          <div class="zoneTexte" style="color:blue;">
            <?php
            $text = $event->text;
            echo <<<FIN
            
                    <p>$text</p>
                    FIN;

            ?>


          </div>

          <div class="reactionGroup">
            <i aria-hidden="true" class="reply large link icon"> </i>
            <i aria-hidden="true" class="thumbs up outline large link icon"></i>
            <div class="reaction reactionOther">
              <div class="reactionEmoji">

              </div>

            </div>

          </div>
        </div>
        <br>
      <?php
      }
      ?>
    </div>
    <div class="col-md-5" style="text-align:center">
      <br>
      <br>
      <br>
      <br>

      <div class="article" style="border: 1px solid black; margin-left:150px;">
        <div class="ui header">
          <p style="float:left;">
            <br />
            <img src="images/anniv.png" class="ui avatar image" height=80 width=80 alt="img">
          </p>
          <br />
          <br />


          <h2>Anniversaires</h2>

        </div>
        <br />
        <p style="float:left; ">
          <?php
          $users = utilisateurs::selectUsers($dbh);
          $user = $users->fetch();
          $birth = $user->naissance;
          $name = $user->nom;
          $prenom = $user->prenom;
          $profile = $user->profileimage;
          $time = strtotime($birth);

          if (date('m-d') == date('m-d', $time)) {
            echo <<<FIN
         <p style="margin-right:100px;">
          <img src=$profile class="ui avatar middle" alt="image"  width=28 height=28 >  $prenom
        </p>
        FIN;
          }

          ?>

          <?php


          while ($user = $users->fetch()) {
            $birth = $user->naissance;
            $name = $user->nom;
            $prenom = $user->prenom;
            $profile = $user->profileimage;
            $time = strtotime($birth);

            if (date('m-d') == date('m-d', $time)) {
              echo <<<FIN
         <p >
          <img src=$profile class="ui avatar middle" alt="image"  width=28 height=28 > $prenom
        </p>
         
         
          
          
       
                
      FIN;
            }
          }

          ?>

        </p>
        <br />

      </div>
      <br>
      <br />
      <br /><br />
      <br /><br />

      <div class="article" style="border: 1px solid black; margin-left:150px;">
        <div class="ui header">
          <p style="float:left;">
            <br />
            <img src="images/nation.png" class="ui avatar image" height=80 width=80 alt="img">
          </p>
          <br />
          <h2>Nationalités</h2>


        </div>
        <br />
        <br />
        <?php
        $users = utilisateurs::selectnationality($dbh);
        $user = $users->fetch();

        $country = $user->nationality;
        echo <<<FIN
            <p style="margin-right:100px;">$country</p>
          FIN;


        ?>
        <?php


        while ($user = $users->fetch()) {
          $country = $user->nationality;
          echo <<<FIN
            <p>$country</p>
          FIN;
        }

        ?>
      </div>

    </div>
  </div>
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