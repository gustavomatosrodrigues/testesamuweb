<div id="radar" style="width:100%;height:690px;"></div>
<script>
	$(document).ready(function () {
		initialize();
	});
	
	function initialize() {
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position){
				var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var options = {
					zoom: 15,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false,
					streetViewControl: false
				};
				map = new google.maps.Map(document.getElementById("radar"), options);
				geocoder = new google.maps.Geocoder();
				
				marker = new google.maps.Marker({
					map: map,
					draggable: false,
					icon: 'img/logo-ico.ico'
				});
				marker.setPosition(latlng);
				
				<?php
					$sql = "SELECT id, lat, lng, tip_ocorrencia tipo
							  FROM ocorrencia
							 WHERE status = 'P'";
					$ret = mysql_query($sql, $conn);
					while ($obj = mysql_fetch_array($ret)) {
				?>
				var latlng<?=$obj["id"]?> = new google.maps.LatLng(<?=$obj["lat"]?>,<?=$obj["lng"]?>);
				marker<?=$obj["id"]?> = new google.maps.Marker({
					map: map,
					draggable: false,
				});
				marker<?=$obj["id"]?>.setPosition(latlng<?=$obj["id"]?>);
				
				google.maps.event.addListener(marker<?=$obj["id"]?>,'click',function() {
					var infowindow = new google.maps.InfoWindow({
						content:'<p class="w3-opacity"><?=$obj["tipo"]?><div class="w3-card-4" style="max-width:250px;"><button onclick="detalharOcorrencia(<?=$obj["id"]?>);" class="w3-btn-block w3-red">Detlhes</button></div></div></p>'
					});
					infowindow.open(map,marker<?=$obj["id"]?>);
				});
				<?php }?>
			}, 
			function(error){ // callback de erro - direciona para o quartel dos bombeiros em Criciúma
				var latlng = new google.maps.LatLng(-28.683661, -49.375112);
				var options = {
					zoom: 15,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false,
					streetViewControl: false
				};
				<?php
					$sql = "SELECT id, lat, lng, tip_ocorrencia tipo
							  FROM ocorrencia
							 WHERE status = 'P'";
					$ret = mysql_query($sql, $conn);
					while ($obj = mysql_fetch_array($ret)) {
				?>
				var latlng<?=$obj["id"]?> = new google.maps.LatLng(<?=$obj["lat"]?>,<?=$obj["lng"]?>);
				marker<?=$obj["id"]?> = new google.maps.Marker({
					map: map,
					draggable: false,
				});
				marker<?=$obj["id"]?>.setPosition(latlng<?=$obj["id"]?>);
				
				google.maps.event.addListener(marker<?=$obj["id"]?>,'click',function() {
					var infowindow = new google.maps.InfoWindow({
						content:'<p class="w3-opacity"><?=$obj["tipo"]?><div class="w3-card-4" style="max-width:250px;"><button onclick="detalharOcorrencia(<?=$obj["id"]?>);" class="w3-btn-block w3-red">Detlhes</button></div></div></p>'
					});
					infowindow.open(map,marker<?=$obj["id"]?>);
				});
				<?php }?>
				console.log('Erro ao obter localização.', error);
			});
		} else {
			alert('Navegador não suporta Geolocalização!');
		}
	}