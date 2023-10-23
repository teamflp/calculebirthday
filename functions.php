<?php  // Début du script PHP

// Fonction qui affiche le formulaire pour sélectionner une date de naissance
function displayForm() {
    ?>
    <!-- Début du formulaire HTML -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">  <!-- Le formulaire soumet les données à lui-même -->
        <!-- Menu déroulant pour sélectionner le jour -->
        <select name="jour">
            <option value="">Jour</option>  <!-- Option par défaut -->
            <?php
            // Boucle pour afficher les jours de 1 à 31
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value=\"$i\">$i</option>";  // Affiche chaque jour dans une option
            }
            ?>
        </select>

        <!-- Menu déroulant pour sélectionner le mois -->
        <select name="mois">
            <option value="">Mois</option>  <!-- Option par défaut -->
            <?php
            // Boucle pour afficher les mois de 1 à 12
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value=\"$i\">$i</option>";  // Affiche chaque mois dans une option
            }
            ?>
        </select>

        <!-- Menu déroulant pour sélectionner l'année -->
        <select name="annees">
            <option value="">Année</option>  <!-- Option par défaut -->
            <?php
            // Boucle pour afficher les années de 1900 à l'année actuelle
            for ($i = 1900; $i <= date('Y'); $i++) {
                echo "<option value=\"$i\">$i</option>";  // Affiche chaque année dans une option
            }
            ?>
        </select>

        <!-- Boutons pour soumettre le formulaire ou le réinitialiser -->
        <div class="btn">
            <input type="submit" value="Calculer" name="calculer">  <!-- Bouton pour calculer l'âge -->
            <input type="reset" value="Restaurer">  <!-- Bouton pour réinitialiser le formulaire -->
        </div>
    </form>  <!-- Fin du formulaire HTML -->
    <?php
}  // Fin de la fonction displayForm

// Fonction pour calculer et afficher l'âge basé sur la date de naissance sélectionnée
function calculateAge() {
    // Si le bouton "Calculer" n'a pas été cliqué, sortez de la fonction
    if (!isset($_GET['calculer'])) return;

    // Récupère les valeurs du jour, du mois et de l'année ou attribue une valeur vide par défaut
    $jour = $_GET['jour'] ?? '';
    $mois = $_GET['mois'] ?? '';
    $annees = $_GET['annees'] ?? '';

    // Vérifie si tous les champs sont remplis
    if (empty($jour) || empty($mois) || empty($annees)) {
        echo "Veuillez remplir tous les champs.";  // Affiche un message d'erreur
        return;
    }

    // Crée un objet DateTime pour la date de naissance
    $birthdate = DateTime::createFromFormat('Y-m-d', "$annees-$mois-$jour");
    // Crée un objet DateTime pour la date actuelle
    $today = new DateTime();
    // Calcule la différence entre aujourd'hui et la date de naissance
    $interval = $today->diff($birthdate);

    // Si la date de naissance est dans le futur, affiche un message d'erreur
    if ($today < $birthdate) {
        echo "La date sélectionnée est dans le futur!";
        return;
    }

    // Affiche la date de naissance et l'âge calculé
    echo "Date de naissance: $jour/$mois/$annees<br>";
    echo "Age: " . $interval->y . " ans<br>";

    // Si c'est l'anniversaire de l'utilisateur, affiche un message de vœux
    if ($interval->m === 0 && $interval->d === 0) {
        echo "Joyeux anniversaire!";
    } else {
        // Sinon, affiche combien de mois et de jours restent jusqu'à son prochain anniversaire
        echo "Votre anniversaire sera dans " . $interval->m . " mois et " . $interval->d . " jours.";
    }
}  // Fin de la fonction calculateAge

?>