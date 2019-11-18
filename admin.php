<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page d'administrateurs</title>
        <link href="style.css" rel="stylesheet" type="text/css">
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
                    <a href="index.php">Accueil</a>
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
                            <a href="index.php">Accueil</a>
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
                            <a href="index.php">Accueil</a>
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
}
?>
    <main>
        <section id="ccontainermid">
            <section id="containermidprofil">
<?php

$connexion = mysqli_connect("localhost", "root","", "moduleconnexion");
$requete = "SELECT * FROM utilisateurs";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);
$compte = false;

if( isset($_SESSION['login']) == true )
{
if($_SESSION['login'] == "admin")
{
echo "<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Mot de passe</th>
    <tr>
</thead>
<tbody>";

                foreach($resultat as $cle => $valeur)
                {
                    echo "<tr>";

                    foreach($valeur as $id => $value)
                    {
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }
                      
echo "</tbody></table>";

}
else
{
    echo "Vous n'avez pas accès à cette page";
}
}
else
{
    echo "Vous n'avez pas accès à cette page";
}
mysqli_close($connexion);
            ?>
            </section>
            </section>
            </main>
    <footer>
        Copyright 2019 LaPlateforme_
    </footer>
</body>
</html>