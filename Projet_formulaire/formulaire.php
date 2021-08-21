
<?php
    $username=$nom=$prenom=$contact=$email=$sexe=$age=$commune=$profession=$formation=$groupe=$mdp="";
    $usernameError=$nomError=$prenomError=$contactError=$emailerror=$formationError=$groupeError=$mdpError="";
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            $username=veryfyInput($_POST['username']);
            $nom=veryfyInput($_POST['nom']);
            $prenom=veryfyInput($_POST['prenom']);
            $contact=veryfyInput($_POST['contact']);
            $email=veryfyInput($_POST['email']);
            $sexe=$_POST['sexe'];
            $age=veryfyInput($_POST['age']);
            $commune=$_POST['commune'];
            $profession=$_POST['profession'];
            $formation=$_POST['formation'];
            $groupe=$_POST['groupe'];
            $mdp=veryfyInput($_POST['mdp']);

            if (empty($username)) {
                $usernameError="Veuillez saisir votre nom d'utilisateur !";
            }
                if (empty($nom)) {
                    $nomError="Veuillez saisir votre nom SVP !";
                }
                if (empty($prenom)) {
                    $prenomError="Veuillez saisir votre pénom  !";
                }
                if (empty($contact)) {
                    $contactError="Veuillez entrer votre contact !";
                }
                if (isPhone($contact)) {
                    
                }
                if (!isPhone($contact)){
                    echo "Numéro invalide";
                }
                if (empty($groupe)) {
                    $groupeError="Veuillez chpoisir votre groupe !";
                }
                if (isEmail($email)) {
                    $emailError="Veuillez entrer une adresse mail valide !";
                }
                if (empty($formation)) {
                    $formationError="Veuillez choisir votre formation !";
                }
                if (empty($mdp)) {
                    $usernameError="Veuillez entrer votre mot de passe !";
                }
             }
           
        function isEmail($var){
            return filter_var($var, FILTER_VALIDATE_EMAIL);
        }

        function veryfyInput($var){
            $var= trim($var);
            $var=htmlspecialchars($var);
            $var=stripslashes($var);
            return $var;
        }
        function isPhone($var){
            return preg_match("/^[0-9]*$/" , $var);
        }


        try{
        $connexion= new PDO('mysql:host=localhost;dbname=ecole','root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        if($connexion){ 
            $requete = $connexion->prepare("SELECT * FROM user");
            $requete->execute();
            if($requete->rowCount()>0){
            echo "<center> <h2> Les étudiants sont : </h2>";
            echo "<table>";
            echo "<tr> 
            <th>nom d'ulisateur</th> 
           <th>nom</th> 
           <th>Prénom</th> 
           <th>Contact</th> 
           <th>Email</th> 
           <th>Sexe</th> 
           <th>age</th> 
           <th>commune</th> 
           <th>profession</th>
           <th>formation</th>
           <th>Groupe</th> 
           </tr>" ;
           while($data=$requete->fetch()){
            echo "<tr>";
            echo "<td>".$data["username"]."</td>";
            echo "<td>".$data["nom"]."</td>";
            echo "<td>".$data["prenom"]."</td>";
            echo "<td>".$data["contact"]."</td>";
            echo "<td>".$data["email"]."</td>";
            echo "<td>".$data["sexe"]."</td>";
            echo "<td>".$data["age"]."</td>";
            echo "<td>".$data["commune"]."</td>";
            echo "<td>".$data["profession"]."</td>";
            echo "<td>".$data["formation"]."</td>";
            echo "<td>".$data["groupe"]."</td>";
         }
         } else {
       
         }
         $requete->closeCursor();
        } else {
             echo "Connexion a échoué";
         } 
}catch(Exception $e){
    die('ERROR :'.$e->getMessage());
}
        
        
                

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
   
   

    <title>Inscription</title>
</head>
<body>

    <h1 style="text-decoration:underline" > <center>S'inscrire</h1>
    
 
    
    <form action="inscription.php" method="POST" >
        <table>
            <tr>
                <td>Nom d'utilisateur* :<td><input type="text" name="username"  value="<?php  echo $username; ?> "  required></td></td>
            </tr>
            <tr>
                <td>Nom* : <td><input type="text" name="nom" id="" required="" value="<?php  echo $nom; ?> "    > </td> </td>
            </tr>
            <tr>
                <td>Prénoms* : <td> <input type="text" name="prenom" id="" required="" value="<?php  echo $prenom; ?> "> </td></td>
            </tr>
            <tr>
                <td>Contact* :  <td><input type="tel" name="contact" id="" required="" value="<?php  echo $contact; ?> "> </td></td>
            </tr>
            <tr>
                <td>Email* : <td> <input type="email" name="email" id="" required="" value="<?php  echo $email; ?> "> </td> </td>
            </tr>
            <tr>
                <td> Sexe :</td>
                <td>
                    <label for="sexe1">Masculin</label> <input type="radio" name="sexe" id="sexe1" value="M">
                    <label for="sexe2"> Féminin</label> <input type="radio" name="sexe" id="sexe2" value="F">
                </td>
            </tr>
            <tr>
                <td>Age: <td><input type="number" name="age" id="" value="<?php  echo $age; ?> "> </td></td> 
                <tr>
                <td> Profession  : </td>
                <td>
                    <select name="profession">
                        <option  value="<?php  echo $profession; ?> "></option>
                        <option value="<?php  echo $profession; ?> ">Etudiant</option>
                        <option value="<?php  echo $profession; ?> ">Travailleur</option>
                        <option value="<?php  echo $profession; ?> ">Sans emploi</option>
                        <option value="<?php  echo $profession; ?> ">En formation</option>
                        <option value="<?php  echo $profession; ?> ">Autres.....</option>
            </tr>
            <tr>
                <td> Commune de résidence  : </td>
                <td>
                    <select name="commune" id="ville" value="<?php  echo $commune; ?> ">
                        <option value=""></option>
                        <option value="Abobo">Abobo</option>
                        <option value="Adjamé">Adjamé</option>
                        <option value="Attécoubé">Attécoubé</option>
                        <option value="Anyama">Anyama</option>
                        <option value="Bingerville">Bingerville</option>
                        <option value="Cocody">Cocody</option>
                        <option value="Koumassi">Koumassi</option>
                        <option value="Marcory">Marcory</option>
                        <option value="Port-Bouët">Port-Bouët</option>
                        <option value="treichville">Treichville</option>
                        <option value="Yopougon">Yopougon</option>
                    </select>
                </
                </td>
            </tr>
        
            <tr>
                <td>Formation suivie : </td> <td>
                    <select name="formation" value="<?php  echo $formation; ?> " required>
                        <option></option>
                        <option value="IA  BIG DATA" > IA  BIG DATA</option>
                        <option value="Réferent Digital" > Réferent Digital</option>
                        <option value="Dévéloppeur Web & Mobile"> Dévéloppeur Web & Mobile</option>
                        <option  value="Autres ....">Autres ....</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Groupe :</td>
                <td>
                    <select name="groupe" id="" required="" value="<?php  echo $groupe; ?> " required>
                        <option value=""></option>
                        <option>Groupe 1</option>
                        <option>Groupe 2</option>
                        <option>Groupe 3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mot de passe :</td> <td> <input type="password" name="mdp" id="" required></td>
            </tr>
            <tr>
                <td>Confirmez le mot de passe :</td> <td> <input type="password" name="mdp_1" id=""></td>
            </tr>

            <tr>
                <td><input type="reset" value="Annuler"></td> <td><a href="index.html"<input type="submit" value="Valider">></a></td>
            </tr>
        </table>
        </center>
    </form>
</body>
</html>