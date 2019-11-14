<?php
    session_start();
    $connexion = mysqli_connect("localhost", "root","", "moduleconnexion");
    $requete = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
    $query = mysqli_query($connexion, $requete);
    $resultat = mysqli_fetch_assoc($query);
    var_dump($resultat);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mon Profil</title>
    </head>
<body>
    <h1>Mon profil</h1>
    <h2>Modifier mon profil</h2>

        <form method="POST" action="profil.php">
            Login <br><br> <input type="text" name="login" value= <?php echo $resultat['login']?> required><br><br>
            Prénom <br><br> <input type="text" name="prenom" value= <?php echo $resultat['prenom']?> required><br><br>
            Nom <br><br> <input type="text" name="nom" value= <?php echo $resultat['nom']?>><br><br>
            Password <br><br> <input type="text" name="password" value= <?php echo $resultat['password']?> required><br><br>
                <input type="submit" value="changer mes données" name="modifier">
        </form>
</body>
</html>

<?php

    if(isset($_POST['modifier']))
    {
        $requeteupdate = "UPDATE utilisateurs SET login='".$_POST['login']."', prenom='".$_POST['prenom']."' , nom='".$_POST['nom']."' , password='".$_POST['password']."' WHERE login = '".$_SESSION['login']."'";

        if($resultat['login'] != $_POST['login'])
        {
            mysqli_query($connexion,$requeteupdate);
            $_SESSION['login'] = $_POST['login'];
            header('Location: profil.php');
        }
        elseif($resultat['prenom'] != $_POST['prenom'])
        {
            mysqli_query($connexion,$requeteupdate);
            header('Location: profil.php');
        }
        elseif($resultat['nom'] != $_POST['nom'])
        {
            mysqli_query($connexion,$requeteupdate);
            header('Location: profil.php');
        }
        elseif($resultat['password'] != $_POST['password'])
        {
            mysqli_query($connexion,$requeteupdate);
            header('Location: profil.php');
        }
        else
        {
            echo " Impossible de changer d'informations ";
        }
    }

?>