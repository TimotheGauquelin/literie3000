<?php

if (!empty($_POST)) {
    $nom = trim(strip_tags($_POST["nom"]));
    $marque = trim(strip_tags($_POST["marque"]));
    $longueur = trim(strip_tags($_POST["longueur"]));
    $largeur = trim(strip_tags($_POST["largeur"]));
    $promotion = trim(strip_tags($_POST["promotion"]));
    $prix = trim(strip_tags($_POST["prix"]));

    $errors = [];

    if (empty($nom)) {
        $errors["nom"] = "Le nom de la réference est obligatoire";
    }
    if (empty($marque)) {
        $errors["marque"] = "La marque de la réference est obligatoire";
    }
    if (empty($largeur)) {
        $errors["largeur"] = "La largeur de la réference est obligatoire";
    }
    if (empty($longueur)) {
        $errors["longueur"] = "La longueur de la réference est obligatoire";
    }
    if (empty($prix)) {
        $errors["prix"] = "Le prix de la réference est obligatoire";
    }


    $dsn = "mysql:host=localhost;dbname=literie";
    $db = new PDO($dsn, "root", "");

    $query = $db->prepare("INSERT INTO lit (nom, marque, longueur, largeur, prix, promotion) VALUES (:nom, :marque, :longueur, :largeur, :prix, :promotion)");

    $query->bindValue(":nom", $nom);
    $query->bindValue(":marque", $marque);
    $query->bindValue(":longueur", $longueur, PDO::PARAM_INT);
    $query->bindValue(":largeur", $largeur, PDO::PARAM_INT);
    $query->bindValue(":prix", $prix, PDO::PARAM_INT);
    $query->bindValue(":promotion", $promotion, PDO::PARAM_INT);

    $query->execute();

    header("Location:index.php");
}

include("templates/header.php")
?>

<div class="container">
    <h2>Ajouter un lit</h2>
    <form method="post">

        <div class="form-group">
            <label for="inputMarque">Marque du lit</label>
            <input type="text" class="form-control" name="marque" id="inputMarque" placeholder="Epeda">
            <small id="emailHelp" class="form-text text-muted">Ce champs est obligatoire.</small>
        </div>
        <div class="form-group">
            <label for="inputMarque">Nom du lit</label>
            <input type="text" class="form-control" name="nom" id="inputNom" placeholder="Tamoul">
            <small id="emailHelp" class="form-text text-muted">Ce champs est obligatoire.</small>
        </div>
        <div class="form-group">
            <label for="inputLargeur">Largeur du lit</label>
            <input type="text" class="form-control" name="largeur" id="inputLargeur" placeholder="90">
            <small id="emailHelp" class="form-text text-muted">Ce champs est obligatoire.</small>
        </div>
        <div class="form-group">
            <label for="inputLongueur">Longueur du lit</label>
            <input type="text" class="form-control" name="longueur" id="inputLongueur" placeholder="190">
            <small id="emailHelp" class="form-text text-muted">Ce champs est obligatoire.</small>
        </div>
        <div class="form-group">
            <label for="inputPrix">Prix du lit</label>
            <input type="text" class="form-control" name="prix" id="inputPrix" placeholder="759€">
            <small id="emailHelp" class="form-text text-muted">Ce champs est obligatoire.</small>
        </div>
        <div class="form-group">
            <label for="inputPromotion">Promotion de l'article</label>
            <input type="text" class="form-control" name="promotion" id="inputPromotion" placeholder="759€">
        </div>


        <input type="submit" value="Ajouter un lit">
    </form>
</div>


<?php
include("templates/footer.php")
?>