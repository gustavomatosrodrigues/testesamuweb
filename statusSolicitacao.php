<?php 
	include "banco.php";
	$conn = conecta();
	$id = @$_GET["id"];
	$status = @$_GET["status"];
	if ($status == 'R'){
		$msgSucesso = "Ocorrência reprovada com sucesso!";
		$msgErro    = "Não foi possível reprovar a ocorrência!";
	}else if ($status == 'E'){
		$msgSucesso = "Ocorrência encerrada com sucesso!";
		$msgErro    = "Não foi possível encerrar a ocorrência!";
	}else{
		$msgErro = "Operação não indentificada!";
	}
	$sql = "UPDATE ocorrencia SET status = '$status' WHERE id = $id";
	$ret = mysql_query($sql, $conn);
	if (mysql_affected_rows() > 0) {
		if ($status == 'R') {
			$sql = "SELECT u.id
					  FROM ocorrencia o INNER JOIN usuario u ON (u.id = o.id_usuario)
					 WHERE o.id = $id";
			$ret = mysql_query($sql, $conn);
			$obj = mysql_fetch_array($ret);
			$idUsuario = $obj["id"];
			$sql = "UPDATE usuario SET status = 'B' WHERE id = $idUsuario";
			$ret = mysql_query($sql, $conn);
			if (mysql_affected_rows() > 0) {
				$msgSucesso .= " Usuário bloqueado.";
			}else{
				$msgSucesso .= " Não foi possível bloquear usuário.";
			}
		}
	?>
	<div class="w3-panel w3-leftbar w3-border-green w3-pale-green">
		<p><?=$msgSucesso?></p>
	</div>
	<?php
	} else {
	?>
	<div class="w3-panel w3-leftbar w3-border-red w3-pale-red">
		<p><?=$msgErro?></p>
	</div>
	<?php
	}
?>