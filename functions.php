<?php

// Cette fonction permet d'afficher un formulaire avec 3 select tels que: le jour, mois et année
function form()
{ ?>
     <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
          <select name="jour">
               <option></option>
               <?php
               for ($i = 1; $i < 32; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
               }
               ?>
          </select>

          <select name="mois">
               <option></option>
               <?php
               for ($i = 1; $i < 13; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
               }
               ?>
          </select>
          <select name="annees">
               <option></option>
               <?php
               for ($i = 1900; $i < date('Y') + 1; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
               }
               ?>
          </select>

          <div class="btn">
               <input type="submit" value="Calculer" name="calculer">
               <input type="reset" value="Restaurer" name="reset">
          </div>
     </form>
<?php }

function calculerAge() {
     if(isset($_GET['calculer'])) {
          $jour = $_GET['jour'];
          $mois = $_GET['mois'];
          $annees = $_GET['annees'];

          if(empty($jour)){
               echo 'Sélectionner un jour';
          }
          elseif(empty($mois)){
               echo 'Sélectionner un mois';
          }
          elseif(empty($annees)){
               echo "Sélectionner une année";
          }
          else{
               if($mois < date('m') && $jour < date('d')) {
                   echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                   echo "Age: " . date('Y') - $annees . " ans";
                   echo "Tu as déjà fêté ton anniversaire depuis " . date('m') - $mois. " mois et date('d') - $jour jours.";
               }
               elseif ($mois < date('m') && $jour == date('d')) {
                   echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                   echo "Age: " . date('Y') - $annees . " ans";
                   echo "Tu as déjà fêté ton anniversaire depuis " . date('m') - $mois . " mois et " . date('d') . "jours";
               }
               elseif ($mois == date('m') && $jour < date('d')){
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: ". date('Y') - $annees . " ans";
                    echo "Tu as déjà fêté ton anniversaire depuis " . date('d') - $jour . " jours.";
               }
                   
               elseif ($mois == date('m') && date('d') == $jour && $annees != date('Y')) {
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: ". date('Y') - $annees . " ans";
                    echo "Ton anniversaire c'est aujourd'hui.";
               }
               
               elseif($jour == date('d') && $mois == date('m') && $annees == date('Y')) {
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: " . date('Y') - $annees . " ans";
                    echo "Bienvenu dans le monde des vivants.";
               }
                   
               elseif ($mois > date('m') && $jour < date('d')) {
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: ". date('Y') - $annees . " ans";
                    echo "Ton anniversaire c'est dans " . date('m')- $mois  - $mois ." mois et " . date('d') - $jour . "jours.";
               }

               elseif ($mois == date('m') && $jour > date('d')) {
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: " .date('Y') - $annees . " ans";
                    echo "Ton anniversaire c'est dans" . date('d') - $jour . "jours .";
               }
               else {
                    echo "date de naissance: $_GET[jour]/$_GET[mois]/$_GET[annees]";
                    echo "Age: " . date('Y') - $annees . " ans";
                    echo "Ton anniversaire a eu lieu depuis" . date('m') - $mois . " mois";
               }
          }     
     }
}