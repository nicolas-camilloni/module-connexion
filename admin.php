<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page d'administrateurs</title>
        <link href="toast.css" rel="stylesheet" type="text/css">
    </head>
    <body>
<?php

$connexion = mysqli_connect("localhost", "root","", "moduleconnexion");
$requete = "SELECT * FROM utilisateurs";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);
$compte = false;

session_start();

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
    echo "Vous n'avez pas accés à cette page";
}
mysqli_close($connexion);
            ?>
        </body>
</html>