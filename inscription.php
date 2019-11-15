<?php
    session_start();
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
                        <input type="text" placeholder="Identifiant" name="login" ><br />
                        <input type="password" placeholder="Mot de passe" name="mdp" ><br />
                        <input type="password" placeholder="Confirmation mot de passe" name="cmdp" ><br />
                        <input type="text" placeholder="Nom" name="nom" ><br />
                        <input type="text" placeholder="Prénom" name="prenom" ><br />
                        <input type="submit" value="S'inscrire" name="inscrire" >
                    </form>
                </section>
                <section id="phraseincorrecte">
                <?php
                    if ( isset($_POST['inscrire']) == true && ($_POST['login'] == NULL || $_POST['mdp'] == NULL )) {
                ?>
                    Merci de remplir tous les champs.
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

<?php
if ( isset($_POST['mdp']) ) {
    $pwd = $_POST['mdp'];
    $pwd = password_hash( $pwd, PASSWORD_BCRYPT, array('cost' => 12, ) );
}
$connexion = mysqli_connect("localhost", "root", "", "moduleconnexion");

    if ( isset($_POST['inscrire']) == true &&  $_POST['mdp'] == $_POST['cmdp'] && isset($_POST['login']) ) {
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