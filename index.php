<?php
    session_start();

    if ( isset($_SESSION['login']) == true ) {
        $connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");
        $requete = "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        mysqli_close($connexion);
    }

    if ( isset($_POST['deco']) == true ) {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }


?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Acceuil</title>
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
                    <a href="index.php">Accueil</a>
                </section>
            </section>
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
    
    ?>
    <main>
        <section id="ccontainermid">
            <section id="containermid">
                <?php

                if ( isset($_SESSION['login']) == true ) {
                    $login = $resultat[0][1];
                    echo "Bienvenue $login !";
                }

                if ( isset($_SESSION['login']) == false ) {
                    echo "Bienvenue le nouveau !";
                }

                ?>
            </section>
        </section>
    </main>
    <footer>
        Copyright 2019 LaPlateforme_
    </footer>
</body>
</html>