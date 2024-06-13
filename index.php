<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Afficher une table MariaDB2</title>
<style>
 body {
font-family: Arial, sans-serif;
background-color: #f4f4f9;
margin: 0;
padding: 20px;
 }
 h1 {
text-align: center;
color: #333;
 }
 table {
width: 80%;
margin: 20px auto;
border-collapse: collapse;
4/6
box-shadow: 0 2px 3px rgba(0,0,0,0.1);
background-color: #fff;
 }
 th, td {
padding: 12px;
text-align: left;
 }
 th {
background-color: #4CAF50;
color: white;
 }
 tr:nth-child(even) {
background-color: #f2f2f2;
 }
 tr:hover {
background-color: #ddd;
 }
</style>
</head>
<body>
<h1>Informations des utilisateurs</h1>
<img src="Sylas.png" alt="">
<?php
// Paramètres de connexion à la base de données
$servername = "bdd-tp-mysql-jordan.mysql.database.azure.com";
$username = "jordan";
$password = "undefined.fr";
$dbname = "TP_EMPLOYES";
// Connexion TLS
$conn = mysqli_init();
5/6
mysqli_ssl_set($conn,NULL,NULL, "ssl/DigiCertGlobalRootCA.crt.pem", 
NULL, NULL);
mysqli_real_connect($conn, $servername, $username, $password,
$dbname, 3306, MYSQLI_CLIENT_SSL);
if (mysqli_connect_errno()) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
// Vérifier la connexion
if ($conn->connect_error) {
die("La connexion a échoué: " . $conn->connect_error);
}
// Préparer et exécuter la requête
$query = "SELECT * FROM salaries";
if ($stmt = $conn->prepare($query)) {
 $stmt->execute();
 $result = $stmt->get_result();
// Afficher les données dans un tableau HTML
if ($result->num_rows > 0) {
echo "<table>";
echo "<tr><th>Nom</th><th>Prénom</th><th>Service</th></
tr>";
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . htmlspecialchars($row['Nom']) . "</td>";
echo "<td>" . htmlspecialchars($row['Prénom']) . "</td>";
echo "<td>" . htmlspecialchars($row['Service']) . "</td>";
echo "<td>" . htmlspecialchars($row['Fonction']) . "</td>";
echo "<td>" . htmlspecialchars($row['Login']) . "</td>";
echo "<td>" . htmlspecialchars($row['Mail']) . "</td>";
echo "</tr>";
 }
echo "</table>";
 } else {
echo "<p style='text-align: center;'>Aucune donnée trouvée.</p>";
6/6
 }
// Libérer le résultat
 $result->free();
 $stmt->close();
} else {
echo "<p style='text-align: center;'>Erreur lors de la préparation de la
requête: " . $conn->error . "</p>";
}
// Fermer la connexion à la base de données
$conn->close();
?>
</body>
</html>