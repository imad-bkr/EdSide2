<?php 

function getGroupesFromDB(){
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $groupes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $groupes;
}

function getGroupeFromDB($group){
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe
    WHERE nom = :nom";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $group, PDO::PARAM_STR);
    $stmt->execute();
    $groupe = $stmt->fetch(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $groupe;
}