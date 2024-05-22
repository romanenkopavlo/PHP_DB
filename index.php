<?php
require_once 'GestionContacts.php';
$gestion = new GestionContacts();

if (isset($_POST['prenom']) && isset($_POST['nom'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    if (isset($_POST['buttonAjouter'])) {
        echo("<div style='text-align: center'>Ajout de : $prenom $nom</div>");
    } else if (isset($_POST['buttonSupprimer'])) {
        echo("<div style='text-align: center'>Suppression de : $prenom $nom</div>");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php
include_once './include/head.include.html';
?>

<body>

<div class="row">
    <div class="col m4 offset-m4">
        <div class="card   teal z-depth-5">
            <div class="card-image waves-effect waves-block waves-light">
                <img  src="images/liste_contacts.jpg">
            </div>
            <div class="card-content white-text">
                <span class="card-title black-text">Liste de contacts</span>

                <div class="card-content">
                    <?php
                    if (isset($_POST['buttonAjouter'])) {
                        $gestion->ajoutContact(new Contact($nom, $prenom));
                    } elseif (isset($_POST['buttonSupprimer'])) {
                        $gestion->supprimeContact(new Contact($nom, $prenom));
                    }
                    $gestion->afficheContacts();

                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once './include/ajouter.include.html';
    ?>

</div>
<footer>
</footer>

</body>
</html>