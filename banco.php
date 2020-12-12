<?php
	function conecta(){
		// Remoto
		//$mysql = mysql_connect("externo.logosystem.com.br","root","logokanzeon");
		//mysql_select_db("auxilium",$mysql);
		//mysql_set_charset("utf8",$mysql);
		// Local
		/*$mysql = mysql_connect("127.0.0.1","root","root");
		mysql_select_db("auxilium",$mysql);
		mysql_set_charset("utf8",$mysql);*/
		// Retorna conexão
		//return $mysql;

		$link = mysqli_connect("externo.logosystem.com.br","logosystem","logokanzeon", "auxilium");

		if (!$link) {
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
		echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

		mysqli_close($link);

	}
?>