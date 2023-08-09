<?php

// Affiche le formulaire de date de naissance.
function displayForm() {
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
        <select name="jour">
            <option value="">Jour</option>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            ?>
        </select>

        <select name="mois">
            <option value="">Mois</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            ?>
        </select>

        <select name="annees">
            <option value="">Année</option>
            <?php
            for ($i = 1900; $i <= date('Y'); $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            ?>
        </select>

        <div class="btn">
            <input type="submit" value="Calculer" name="calculer">
            <input type="reset" value="Restaurer">
        </div>
    </form>
    <?php
}

function calculateAge() {
    if (!isset($_GET['calculer'])) return;

    $jour = $_GET['jour'] ?? '';
    $mois = $_GET['mois'] ?? '';
    $annees = $_GET['annees'] ?? '';

    if (empty($jour) || empty($mois) || empty($annees)) {
        echo "Veuillez remplir tous les champs.";
        return;
    }

    $birthdate = DateTime::createFromFormat('Y-m-d', "$annees-$mois-$jour");
    $today = new DateTime();
    $interval = $today->diff($birthdate);

    if ($today < $birthdate) {
        echo "La date sélectionnée est dans le futur!";
        return;
    }

    echo "Date de naissance: $jour/$mois/$annees<br>";
    echo "Age: " . $interval->y . " ans<br>";

    if ($interval->m === 0 && $interval->d === 0) {
        echo "Joyeux anniversaire!";
    } else {
        echo "Votre anniversaire sera dans " . $interval->m . " mois et " . $interval->d . " jours.";
    }
}
