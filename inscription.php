<?php
    session_start();
    $dejainscrit = false;
    if ( isset($_POST['mdp']) ) {
        $pwd = $_POST['mdp'];
        $pwd = password_hash( $pwd, PASSWORD_BCRYPT, array('cost' => 12, ) );
}
$connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");

    if ( isset($_POST['inscrire']) == true &&  $_POST['mdp'] == $_POST['cmdp'] && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['mdp']) && strlen($_POST['mdp']) != 0 && isset($_POST['cmdp']) && strlen($_POST['cmdp']) != 0 && isset($_POST['nom']) && strlen($_POST['nom']) != 0 && isset($_POST['prenom']) && strlen($_POST['prenom']) != 0 ) {
        $requete2 = "SELECT * FROM utilisateurs";
        $query2 = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_all($query2);
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

        mysqli_close($connexion);
    }
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
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
            </header>
        <?php
        }
    
    ?>
    <main>
            <?php
    if ( !isset($_SESSION['login']) ) {
    ?>
        <section id="cconnexion">
            <section id="cform">
                <article id="titleformco">
                    INSCRIPTION
                </article>
                <section id="formconnexion">
                    <form method="post" action="inscription.php">
                        <input type="text" placeholder="Identifiant" name="login" required><br />
                        <input type="password" placeholder="Mot de passe" name="mdp" required><br />
                        <input type="password" placeholder="Confirmation mot de passe" name="cmdp" required><br />
                        <input type="text" placeholder="Nom" name="nom" required><br />
                        <input type="text" placeholder="Prénom" name="prenom" required><br />
                        <input type="submit" value="S'inscrire" name="inscrire" required>
                    </form>
                </section>
                <section id="phraseincorrecte">
                <?php
                    if ( isset($_POST['inscrire']) == true &&  isset($_POST['login']) && strlen($_POST['login']) == 0 || isset($_POST['mdp']) && strlen($_POST['mdp']) == 0 || isset($_POST['cmdp']) && strlen($_POST['cmdp']) == 0 || isset($_POST['nom']) && strlen($_POST['nom']) == 0 || isset($_POST['prenom']) && strlen($_POST['prenom']) == 0 ) {
                ?>
                    Merci de remplir tous les champs.
                <?php
                    }
                    if ( $dejainscrit == true ) {
                ?>
                    Identifiant déjà pris :(
                <?php
                    }
                     if ( isset($_POST['inscrire']) == true && $_POST['mdp'] != $_POST['cmdp'] ) {
                ?>
                    Les mots de passe ne sont pas les mêmes!
                <?php
                    }
                ?>
                </section>
            </section>
        </section>
    <?php
    }

    elseif ( isset($_SESSION['login']) ) {
    ?>
        <section id="cconnexion">
            <section id="cform">
                <article id="titleformco">
                    ERREUR
                </article>
                <section id="erreurco">
                    Vous êtes déjà connecté !
                </section>
            </section>
        </section>
    <?php
    }
    ?>
    </main>
    <footer>
        Copyright 2019 LaPlateforme_
    </footer>
</body>
</html>