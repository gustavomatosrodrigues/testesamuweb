<?php
	include "banco.php";
	$conn = conecta();
	$sql = "SELECT id, tip_ocorrencia tipo, DATE_FORMAT(DATE_ADD(momento_ocorrencia, INTERVAL -3 HOUR), '%d/%m/%Y %H:%i:%S') data, lat, lng
			  FROM ocorrencia
			 WHERE status = 'P'
			 ORDER BY momento_ocorrencia DESC";
	$ret = $conn->query($sql);?>
	<script>
		var rc = <?=$ret->rowcount()?>;
		if ($('#numocorr').val()!=rc){
			clearMarkers();
		}
	</script>
	<?php
	foreach ($ret as $obj) {?>
	<a href="#" class="w3-bar-item w3-button" onclick="detalharOcorrencia(<?=$obj["id"]?>);"><?=$obj["tipo"]?><div class="w3-right"><?=$obj["data"]?></div></a>
	<script>
		if ($('#numocorr').val()!=rc){
			var latlng<?=$obj["id"]?> = new google.maps.LatLng(<?=$obj["lat"]?>,<?=$obj["lng"]?>);
			marker<?=$obj["id"]?> = new google.maps.Marker({
				map: map,
				draggable: false,
			});
			marker<?=$obj["id"]?>.setPosition(latlng<?=$obj["id"]?>);
			markers.push(marker<?=$obj["id"]?>);
			
			google.maps.event.addListener(marker<?=$obj["id"]?>,'click',function() {
				var infowindow = new google.maps.InfoWindow({
					content:'<p class="w3-opacity"><?=$obj["tipo"]?><div class="w3-card-4" style="max-width:250px;"><button onclick="detalharOcorrencia(<?=$obj["id"]?>);" class="w3-btn-block w3-red">Detlhes</button></div></div></p>'
				});
				infowindow.open(map,marker<?=$obj["id"]?>);
			});
		}
	</script>
<?php }?>
<script>
	$('#numocorr').val(rc);
</script>