<?php 
require_once "functions.php";
include 'includes/header.php';

calculateAge(); // Appel de la fonction calculateAge() qui est la partie logique de l'application

displayForm();  // Appel de la fonction displayForm() qui affiche le formulaire
include 'includes/footer.php';