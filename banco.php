<?php
	function conecta(){
		// Remoto
		$mysql = mysql_connect("externo.logosystem.com.br","root","logokanzeon");
		mysql_select_db("auxilium",$mysql);
		mysql_set_charset("utf8",$mysql);
		// Local
		/*$mysql = mysql_connect("127.0.0.1","root","root");
		mysql_select_db("auxilium",$mysql);
		mysql_set_charset("utf8",$mysql);*/
		// Retorna conexão
		return $mysql;
	}
?>