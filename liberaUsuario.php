<?php 
	include "banco.php";
	$conn = conecta();
	$id = @$_GET["id"];
	$sql = "UPDATE usuario SET status = 'L' WHERE id = $id";
	$ret = mysql_query($sql, $conn);
	if (mysql_affected_rows() > 0) {
	?>
	<div class="w3-panel w3-leftbar w3-border-green w3-pale-green">
		<p>Usuário liberado com sucesso!</p>
	</div>
	<?php
	} else {
	?>
	<div class="w3-panel w3-leftbar w3-border-red w3-pale-red">
		<p>Não foi possível liberar o usuário!</p>
	</div>
	<?php
	}
?>