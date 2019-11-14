<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="inscription.php">
        <input type="text" placeholder="Identifiant" name="login" required><br />
        <input type="password" placeholder="Mot de passe" name="mdp" required><br />
        <input type="password" placeholder="Confirmation mot de passe" name="cmdp" required><br />
        <input type="text" placeholder="Nom" name="nom" required><br />
        <input type="text" placeholder="Prénom" name="prenom" required><br />
        <input type="submit" value="S'inscrire" name="inscrire" required>
    </form>
</body>
</html>

<?php
if ( isset($_POST['mdp']) ) {
    $pwd = $_POST['mdp'];
    $pwd = password_hash( $pwd, PASSWORD_BCRYPT, array('cost' => 12, ) );
}
$connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");

    if ( isset($_POST['inscrire']) == true &&  $_POST['mdp'] == $_POST['cmdp'] ) {
        $requete2 = "SELECT * FROM utilisateurs";
        $query2 = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_all($query2);
        $dejainscrit = false;
        foreach ( $resultat as $key => $value ) {
            if ( $resultat[$key][1] == $_POST['login'] ) {
                $dejainscrit = true;
            }
        }
        if ( $dejainscrit == false ) {
            $requete = "INSERT INTO utilisateurs (login, password, prenom, nom) VALUES('".$_POST['login']."', '".$pwd."', '".$_POST['prenom']."', '".$_POST['nom']."')";
            $query = mysqli_query($connexion, $requete);
            header('Location: connexion.php');
        }
        else {
            echo "Identifiant déjà pris :(";
        }

        mysqli_close($connexion);
    }

    elseif ( isset($_POST['inscrire']) == true && $_POST['mdp'] != $_POST['cmdp'] ) {
        echo "Le mot de passe n'est pas le même.";
    }

?>