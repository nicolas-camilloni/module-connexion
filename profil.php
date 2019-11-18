<?php
    session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        if ( isset($_SESSION['login']) == false ) {
?>

    <header>
        <section id="ctopbar">
            <section id="clogin">
                <a href="connexion.php">Connexion</a>
            </section>
            <section id="cinscription">
                <a href="inscription.php">Inscription</a>
            </section>
        </section>
        <section id="clogo">
            <article id="logotitle">
                LaPlateforme_
            </article>
            <article id="logosubtitle">
                The game
            </article>
        </section>
        <section id="cnavbar">
            <section id="navbar">
                <section id="cacceuil2">
                    <a href="index.php">Acceuil</a>
                </section>
    </header>
<?php
        }
        elseif ( isset($_SESSION['login']) == true && $_SESSION['login'] != "admin" ) {
?>
            <header>
                <section id="ctopbar">
                    <section id="cdeconnexion">
                        <form method="post" action="index.php">    
                            <input type="submit" name="deco" value="Déconnexion">
                        </form>
                    </section>
                </section>
                <section id="clogo">
                    <article id="logotitle">
                        LaPlateforme_
                    </article>
                    <article id="logosubtitle">
                        The game
                    </article>
                </section>
                <section id="cnavbar">
                    <section id="navbar">
                        <section id="cacceuil">
                            <a href="index.php">Acceuil</a>
                        </section>
                        <section id="cmonprofil">
                            <a href="profil.php">Mon profil</a>
                        </section>
                    </section>
                </section>
            </header>
<?php
        }
        elseif ( isset($_SESSION['login']) == true  && $_SESSION['login'] == "admin" ) {
?>
            <header>
                <section id="ctopbar2">
                    <section id="cadmin">
                        <a href="admin.php"><img id="star" height=15 width=15 src="img/star.png"></a>
                        <a href="admin.php">Admin</a>
                    </section>
                    <section id="cdeconnexion">
                        <form method="post" action="index.php">    
                            <input type="submit" name="deco" value="Déconnexion">
                        </form>
                    </section>
                </section>
                <section id="clogo">
                    <article id="logotitle">
                        LaPlateforme_
                    </article>
                    <article id="logosubtitle">
                        The game
                    </article>
                </section>
                <section id="cnavbar">
                    <section id="navbar">
                        <section id="cacceuil">
                            <a href="index.php">Acceuil</a>
                        </section>
                        <section id="cmonprofil">
                            <a href="profil.php">Mon profil</a>
                        </section>
                    </section>
                </section>
            </header>
<?php
        }

 if ( isset($_SESSION['login']) == true )
{
    $connexion = mysqli_connect("localhost", "root","", "moduleconnexion");
    $requete = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
    $query = mysqli_query($connexion, $requete);
    $resultat = mysqli_fetch_assoc($query);

?>
    <main>
        <section id="ccontainermid">
            <section id="containermidprofil">
                <h1>Mon profil</h1>
                <form id="formprofil" method="POST" action="profil.php">
            <label>Login</label><br><br> <input type="text" name="login" value= <?php echo $resultat['login']?> required><br><br>
            <label>Prénom</label><br><br> <input type="text" name="prenom" value= <?php echo $resultat['prenom']?> required><br><br>
            <label>Nom</label><br><br> <input type="text" name="nom" value= <?php echo $resultat['nom']?>><br><br>
            <label>Password</label><br><br> <input type="password" name="password" ><br><br>
                <input type="submit" value="Changer mes données" name="modifier">
        </form>
            </section>
    </section>
    <main>
<?php

}

else
{
?>
     <main>
        <section id="ccontainermid">
            <section id="containermidprofil">
<?php
    echo "Vous n'avez pas accès à cette page !";
?>
 </section>
    </section>
    <main>
<?php
}

?>
    <footer>
        Copyright 2019 LaPlateforme_
    </footer>
</body>
</html>

<?php

    if(isset($_POST['modifier']))
    {
        $requeteupdate = "UPDATE utilisateurs SET login='".$_POST['login']."', prenom='".$_POST['prenom']."' , nom='".$_POST['nom']."' WHERE login = '".$_SESSION['login']."'";

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
            if($_POST['password'] != NULL)
            {
            $pwd=$_POST['password'];
            $pwd=password_hash($pwd,PASSWORD_BCRYPT,array('cost'=>12,));
            $requeteupdate = "UPDATE utilisateurs SET password='".$pwd."' WHERE login = '".$_SESSION['login']."'";
            mysqli_query($connexion,$requeteupdate);
            header('Location: profil.php');
            }
            elseif($_POST['password'] == NULL)
            {}
        }
        else
        {
            echo " Impossible de changer d'informations ";
        }
    }

?>