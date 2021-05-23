<?php

function getAnnoncesFromBD() {
    $bdd = connexionPDO();
    $req = "SELECT * FROM annonces";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $annonces;
}