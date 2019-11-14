<?php

    if ( isset($_POST['connexion']) == true ) {
        $connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");
        $requete = "SELECT * FROM utilisateurs";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);
        $comptevalide = false;
        foreach ( $resultat as $key => $value ) {
            if ( $resultat[$key][1] == $_POST['login'] && password_verify($_POST['mdp'], $resultat[$key][4]) ) {
                $comptevalide = true;
            }
        }
        if ( $comptevalide == true ) {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header('Location: index.php');
        }
        else {
            echo "Identifiant ou mot de passe incorrect.";
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
                Titre
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
                            <input type="submit" name="deco" value="Deconnexion">
                        </form>
                    </section>
                </section>
                <section id="clogo">
                    <article id="logotitle">
                        Titre
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
                            <input type="submit" name="deco" value="Deconnexion">
                        </form>
                    </section>
                </section>
                <section id="clogo">
                    <article id="logotitle">
                        Titre
                    </article>
                </section>
            </header>
<?php
        }
?>

    <main>
        <section id="cconnexion">
            <section id="cform">
                <article id="titleformco">
                    CONNEXION
                </article>
                <section id="formconnexion">
                    <form method="post" action="connexion.php">
                        <input type="text" placeholder="Identifiant" name="login" required><br />
                        <input type="password" placeholder="Mot de passe" name="mdp" required><br />
                        <input type="submit" value="Se connecter" name="connexion" required>
                    </form>
                </section>
            </section>
        </section>
    </main>
</body>
</html>