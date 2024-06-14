<?php

function connexionBDD()
{
	try
	{
            	$conn = mysqli_init();
		mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
		mysqli_real_connect($conn, 'bdd-tp-mysql-jordan.mysql.database.azure.com','jordan', 'undefined.fr', 'quickstartdb', 3306, MYSQLI_CLIENT_SSL);
		if (mysqli_connect_errno()) {
			die('Failed to connect to MySQL: '.mysqli_connect_error());
		}
	$bdd = new PDO('mysql:host=servbd;port=3306;dbname=bdd_geststages;charset=utf8', 'usergs', 'mdpGS', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
	}
	catch(Exception $e)
	{
		$pdo_error = $e->getMessage();
                return false;
	}
    
}

?>
