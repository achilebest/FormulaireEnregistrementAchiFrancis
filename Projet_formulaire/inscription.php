<?php
if (isset($_POST) && !empty($_POST)) {
    try {
        $connexion= new PDO('mysql:host=localhost;dbname=ecole','root','');
        
        if($connexion){
        $requete = $connexion->prepare("INSERT INTO user
        SET
        username=.username, 
        nom=:nom,
        prenom=:prenom,
       contact=:contact,
       email=:email,
       sexe=:sexe,
       age=:age,
       commune=:commune,
       profession=:profession,
       formation=:formation,
       groupe=:groupe,
       mdp=PASSWORD(:mdp) ");
$requete->execute(array("username"=>$_POST["username"],
 "nom"=>$_POST["nom"],
 "prenom"=>$_POST["prenom"],
 "contact"=>$_POST["contact"],
 "email"=>$_POST["email"],
 "sexe"=>$_POST["sexe"],
 "age"=>$_POST["age"],
 "commune"=>$_POST["commune"],
 "profession"=>$_POST["profession"],
 "formation"=>$_POST["formation"],
 "groupe"=>$_POST["groupe"],
 "mdp"=>$_POST["mdp"] ));
 if($requete->rowCount()>0){
    echo json_encode(array('ok'=> true,'msg'=> "Inscription
   effectuée avec succès"));
    }else {
    echo json_encode(array('ok'=> false,'msg'=> "Inscription
   échouée"));
    }
   
    $requete->closeCursor();
 }else {
     echo json_encode(array('ok'=> false,'msg'=> "Connexion échouée"));
     }
     }catch(Exception $e){
     // En cas d'erreur, on affiche un message et on arrête tout
     die ('Erreur : '.$e->getMessage());
       }
  }

?>