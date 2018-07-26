<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>UAS GIS</title>

	<link rel="stylesheet" href="<?php echo ROOTPATH.'assets/vendor/bootstrap3/css/bootstrap.min.css'?>">
	<link rel="stylesheet" href="<?php echo ROOTPATH.'assets/vendor/sweetalert2/sweetalert2.min.css'?>">
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsARrTkeRHgGOFSlVmp4H_tSium2g9A5w"></script>
	<style type="text/css">
		.map{
			height:500px;
		}

		.mt-1{
			margin-top:10px;
		}
	</style>
	<script src="<?php echo ROOTPATH.'assets/vendor/jquery/jquery-3.2.1.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/bootstrap3/js/bootstrap.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/sweetalert2/sweetalert2.min.js';?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jsts/1.6.0/jsts.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>UAS Geografis Information System</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 map-container">
			<div class="map" id="map"></div>
		</div>
		<div class="col-md-4 hidden map-detail">
			<form class="form-horizontal hidden" id="form-jsts">
				<div class="form-group">
					<label class="col-sm-3 control-label">Wilayah 1</label>
					<div class="col-sm-9">
						<select name="jsts-1" id="jsts-1" class="form-control">
							<option value="" selected>-- Kode Kabupaten | Nama Kabupaten --</option>
							<?php
								foreach($select_available as $key => $value){
									echo '<option value="'.$value['id'].'">'.$value['kode_kabupaten'].' | '.$value['nama_kabupaten'].'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Wilayah 2</label>
					<div class="col-sm-9">
						<select name="jsts-2" id="jsts-2" class="form-control">
							<option value="" selected>-- Kode Kabupaten | Nama Kabupaten --</option>
							<?php
								foreach($select_available as $key => $value){
									echo '<option value="'.$value['id'].'">'.$value['kode_kabupaten'].' | '.$value['nama_kabupaten'].'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-info" type="button" id="intersection-action">Intersection</button>
						<button class="btn btn-default" type="button" id="union-action">Union</button>
					</div>
				</div>
			</form>
			<form class="form-horizontal hidden" id="form-detail">
				<div class="form-group">
					<label class="col-sm-4 control-label">Kode Kabupaten</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" readonly id="kode-kabupaten">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Nama Kabupaten</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" readonly id="nama-kabupaten">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Luas Wilayah</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" readonly id="luas-wilayah">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Keliling Wilayah</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" readonly id="keliling-wilayah">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Jarak Pusat Kota dan UKM</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" readonly id="jarak-ukm-pusat-kota">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="mt-1"></div>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-primary" id="show-modal-tambah">Tambah Data</button>
			<button type="button" class="btn btn-info" id="jsts-option">JSTS Intersection | Union</button>
			<button type="button" class="btn btn-success" id="jsts-intersection">JSTS Intersection All</button>
			<button type="button" class="btn btn-danger" id="jsts-union">JSTS Union All</button>
			<button type="button" class="btn btn-warning" id="load-all">Load All</button>
		</div>
	</div>
	<div class="mt-1"></div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-responsive">
					<thead>
						<tr>
							<th>Action</th>
							<th>Kode Lokasi</th>
							<th>Nama Lokasi</th>
							<th>Wilayah</th>
							<th>Pusat Kota</th>
							<th>Pusat UKM</th>
							<th>Nama Bupati</th>
							<th>Jumlah Penduduk</th>
							<th>Jumlah UKM</th>
						</tr>
					</thead>
					<tbody id="table-body-data">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambah-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="map" id="map-tambah"></div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-md-12">
						<form class="form-horizontal" id="form-tambah">
							<div class="form-group">
								<label class="col-sm-3 control-label">Kode Kabupaten</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="kode-kabupaten">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Kabupaten</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama-kabupaten">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Bupati</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama-bupati">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah Penduduk</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="jumlah-penduduk">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah UKM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="jumlah-ukm">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Pusat Kota</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="pusat-kota">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Pusat UKM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="pusat-ukm">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Wilayah</label>
								<div class="col-sm-8">
									<textarea name="wilayah" class="form-control" rows="10"></textarea>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="simpan">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- End Tambah Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Data</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="map" id="map-edit"></div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-md-12">
						<form class="form-horizontal" id="form-edit">
							<input type="text" class="form-control hidden" name="id-edit">
							<div class="form-group">
								<label class="col-sm-3 control-label">Kode Kabupaten</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="kode-kabupaten-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Kabupaten</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama-kabupaten-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Bupati</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama-bupati-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah Penduduk</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="jumlah-penduduk-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jumlah UKM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="jumlah-ukm-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Pusat Kota</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="pusat-kota-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Pusat UKM</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="pusat-ukm-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Wilayah</label>
								<div class="col-sm-8">
									<textarea name="wilayah-edit" class="form-control" rows="10"></textarea>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="update">Save changes</button>
			</div>
		</div>
	</div>
</div>
<!-- End Edit Modal -->
<script>
	let isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;

	function getMultipoint(value){
		value = value.replace('MULTIPOINT(','');
		value = value.replace(/\(/g,"");
		value = value.replace(/\)/g,"");
		value = value.split(',');
		return value;
	}

	function getPoint(data){
		data = data.replace('POINT(','');
		data = data.replace(')','');
		data = data.split(' ');
		return data;
	}

	function initTable(target, data){
		let html = '';
		let targetID = document.getElementById(target);
		while (targetID.firstChild) {
			targetID.removeChild(targetID.firstChild);
		}
		data.forEach(value => {
			let wilayah = '';
			let kumpulanPoint = '';
			html+= '<tr>';
			html+= "<td><a href='javascript:void(0)' class='btn btn-success view-data' id='view-data' data-id='"+value.id+"'>View</a> <a href='javascript:void(0)' class='btn btn-primary edit-data' id='edit-data' data-id='"+value.id+"'>Edit</a> <a href='javascript:void(0)' class='btn btn-danger delete-data' id='delete-data' data-id='"+value.id+"'>Delete</a></td>";
			html+= "<td>"+value.kode_kabupaten+"</td>";
			html+= "<td>"+value.nama_kabupaten+"</td>";
			wilayah = getMultipoint(value.plain_wilayah);
			for (let index = 0; index < wilayah.length; index++) {
				kumpulanPoint += '<option>'+wilayah[index]+'</option>';
			}
			html+= "<td><select>"+kumpulanPoint+"</select></td>";
			html+= "<td>"+value.pusat_kota+"</td>";
			html+= "<td>"+value.pusat_ukm+"</td>";
			html+= "<td>"+value.nama_bupati+"</td>";
			html+= "<td>"+value.jumlah_penduduk+"</td>";
			html+= "<td>"+value.jumlah_ukm+"</td>";
			html+= "</tr>";
		});
		targetID.innerHTML += html;
	}

	function initMap(destination,lokasiFromDatabase){
		var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
		let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
		let lokasiPusatKota, lokasiPusatUkm, markerPusatKota, markerPusatUkm;
		let infowindow = new google.maps.InfoWindow();
		let map = new google.maps.Map(document.getElementById(destination), {
			zoom: 8,
			center: lokasi,
			draggableCursor: 'default',
			draggingCursor: 'pointer',
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		let koordinatFromDatabase = [];
		for (let pos = 0; pos < lokasiFromDatabase.length; pos++) {
			koordinatFromDatabase.push([]);
			lokasi = getMultipoint(lokasiFromDatabase[pos].plain_wilayah);
			lokasiPusatKota = getPoint(lokasiFromDatabase[pos].pusat_kota);
			lokasiPusatUkm = getPoint(lokasiFromDatabase[pos].pusat_ukm);

			markerPusatKota = new google.maps.Marker({
				position  : new google.maps.LatLng(parseFloat(lokasiPusatKota[0]),parseFloat(lokasiPusatKota[1])),
				map       : map,
				icon : iconBase + 'capital_big_highlight.png',
			});

			markerPusatUkm = new google.maps.Marker({
				position  : new google.maps.LatLng(parseFloat(lokasiPusatUkm[0]),parseFloat(lokasiPusatUkm[1])),
				map       : map,
				icon : iconBase + 'placemark_circle.png',
			});

			(function (markerPusatKota, pos) {  
				google.maps.event.addListener(markerPusatKota, 'click', function (e) {
						infowindow.setContent(lokasiFromDatabase[pos].nama_kabupaten);
						infowindow.open(map, markerPusatKota);
						map.setCenter(markerPusatKota.getPosition());
				});
			})(markerPusatKota, pos);

			(function (markerPusatUkm, pos) {  
				google.maps.event.addListener(markerPusatUkm, 'click', function (e) {
						infowindow.setContent('Wilayah : '+lokasiFromDatabase[pos].nama_kabupaten);
						infowindow.open(map, markerPusatUkm);
						map.setCenter(markerPusatUkm.getPosition());
				});
			})(markerPusatUkm, pos);

			for (let index = 0; index < lokasi.length; index++) {
				let kumpulanPoint = lokasi[index].split(' ');
				koordinatFromDatabase[pos].push(new google.maps.LatLng(parseFloat(kumpulanPoint[0]),parseFloat(kumpulanPoint[1])));
			}
		}
		
		$.each(koordinatFromDatabase, function (i, v) {
			let polygon = new google.maps.Polygon({
				paths: v,
				strokeColor : '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 1,
				fillColor: getRandomColor()
			});
			polygon.setMap(map);
		});
	}

	function toggleBounce(marker) {
		if (marker.getAnimation() !== null) {
			marker.setAnimation(null);
		} else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}

	function getRandomColor() {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}

	function getLuasDanJarak(data){
		let koordinatLuas = [];
		const multipoint = getMultipoint(data);
		for (let index = 0; index < multipoint.length; index++) {
			let lokasiLuas = multipoint[index].split(' ');
			koordinatLuas.push(new google.maps.LatLng(parseFloat(lokasiLuas[0]),parseFloat(lokasiLuas[1])));
		}
		let panjang = google.maps.geometry.spherical.computeLength(koordinatLuas);
		let luas = google.maps.geometry.spherical.computeArea(koordinatLuas)
		return {'panjang': panjang,'luas': luas};
	}

	function getJarakPusatUKMKota(data){
		let koordinatPusat = [];
		let pusatKota = getPoint(data.pusat_kota);
		koordinatPusat.push(new google.maps.LatLng(parseFloat(pusatKota[0]),parseFloat(pusatKota[1])));
		let pusatUkm = getPoint(data.pusat_ukm);
		koordinatPusat.push(new google.maps.LatLng(parseFloat(pusatUkm[0]),parseFloat(pusatUkm[1])));
		let jarak = google.maps.geometry.spherical.computeLength(koordinatPusat);
		return jarak;
	}

	// https://jsfiddle.net/vgrem/3ukpuxq9/
	function createJstsPolygon(geometryFactory, polygon) {
		let path = polygon.getPath();
		let coordinates = path.getArray().map(function name(coord) {
			return new jsts.geom.Coordinate(coord.lat(), coord.lng());
		});
		coordinates.push(coordinates[0]);
		let shell = geometryFactory.createLinearRing(coordinates);
		return geometryFactory.createPolygon(shell);
	}

	// https://jsfiddle.net/vgrem/3ukpuxq9/
	function drawIntersectionArea(map, polygon) {
		let coords = polygon.getCoordinates().map(function (coord) {
			return { lat: coord.x, lng: coord.y };
		});

		let intersectionArea = new google.maps.Polygon({
			paths: coords,
			strokeColor: '#00FF00',
			strokeOpacity: 0.8,
			strokeWeight: 4,
			fillColor: '#00FF00',
			fillOpacity: 0.8
		});
		intersectionArea.setMap(map);
	}

	function drawUnionArea(map,polygon){
		let coords = polygon.getCoordinates().map(function (coord) {
			return { lat: coord.x, lng: coord.y };
		});
		var unionPoly = new google.maps.Polygon({
			map: map,
			paths: coords,
			strokeColor: '#0000FF',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#0000FF',
			fillOpacity: 0.8
		});

	}

	function jstsCreate(option,destination,dataJSTS){
		var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
		let lokasi = {lat: -7.271392714896101, lng: 112.73542550138382};
		let lokasiPusatKota, lokasiPusatUkm, markerPusatKota, markerPusatUkm;
		let infowindow = new google.maps.InfoWindow();
		let map = new google.maps.Map(document.getElementById(destination), {
			zoom: 8,
			center: lokasi,
			draggableCursor: 'default',
			draggingCursor: 'pointer',
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		let jstsArray = [];
		for (let pos = 0; pos < dataJSTS.length; pos++) {
			jstsArray.push([]);
			lokasi = getMultipoint(dataJSTS[pos].plain_wilayah);
			lokasiPusatKota = getPoint(dataJSTS[pos].pusat_kota);
			lokasiPusatUkm = getPoint(dataJSTS[pos].pusat_ukm);

			markerPusatKota = new google.maps.Marker({
				position  : new google.maps.LatLng(parseFloat(lokasiPusatKota[0]),parseFloat(lokasiPusatKota[1])),
				map       : map,
				icon : iconBase + 'capital_big_highlight.png',
			});

			markerPusatUkm = new google.maps.Marker({
				position  : new google.maps.LatLng(parseFloat(lokasiPusatUkm[0]),parseFloat(lokasiPusatUkm[1])),
				map       : map,
				icon : iconBase + 'placemark_circle.png',
			});

			(function (markerPusatKota, pos) {  
				google.maps.event.addListener(markerPusatKota, 'click', function (e) {
						infowindow.setContent(dataJSTS[pos].nama_kabupaten);
						infowindow.open(map, markerPusatKota);
						map.setCenter(markerPusatKota.getPosition());
				});
			})(markerPusatKota, pos);

			(function (markerPusatUkm, pos) {  
				google.maps.event.addListener(markerPusatUkm, 'click', function (e) {
						infowindow.setContent('Wilayah : '+dataJSTS[pos].nama_kabupaten);
						infowindow.open(map, markerPusatUkm);
						map.setCenter(markerPusatUkm.getPosition());
				});
			})(markerPusatUkm, pos);

			for (let index = 0; index < lokasi.length; index++) {
				let kumpulanPoint = lokasi[index].split(' ');
				jstsArray[pos].push(new google.maps.LatLng(parseFloat(kumpulanPoint[0]),parseFloat(kumpulanPoint[1])));
			}
		}
		let geometryFactory = new jsts.geom.GeometryFactory();
		let jstsValue = [];
		$.each(jstsArray, function (i, v) {
			let polygon = new google.maps.Polygon({
				paths: v,
				strokeColor : '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 1,
				fillColor: getRandomColor()
			});
			polygon.setMap(map);
			jstsValue.push(createJstsPolygon(geometryFactory, polygon));
		});
		if(option === 'intersect'){
			let intersection = jstsValue[0].intersection(jstsValue[1]);
			if(jstsValue[0].intersects(jstsValue[1]) == false){
				swal('warning','Wilayah tidak saling bersinggungan','warning');
			}else{
				drawIntersectionArea(map, intersection);
			}
		}else if(option === 'union'){
			let union = jstsValue[0].union(jstsValue[1]);
			drawUnionArea(map, union);
		}else if(option === 'intersection-all'){
			for (let index = 0; index < jstsValue.length; index++) {
				for (let j = index+1; j < jstsValue.length; j++) {
					let intersection = '';
					if(jstsValue[index].intersects(jstsValue[j]) == false){

					}else{
						intersection = jstsValue[index].intersection(jstsValue[j]);
						drawIntersectionArea(map, intersection);
					}
				}
			}
		}else if(option === 'union-all'){
			for (let index = 0; index < jstsValue.length; index++) {
				if(index != (jstsValue.length-1)){
					let union = jstsValue[(index)].union(jstsValue[(index+1)]);
					drawUnionArea(map, union);
				}else{
					let union = jstsValue[(index)].union(jstsValue[0]);
					drawUnionArea(map, union);
				}
			}
		}
	}
	
	$(document).ready(function () {
		let base_url = '<?php echo base_url();?>';
    	let lokasiFromDatabase  = <?php echo json_encode($lokasi)?>;
		initMap('map',lokasiFromDatabase);
		initTable('table-body-data',lokasiFromDatabase);

		$("#table-body-data").on('click','.view-data', function () {
			let id = $(this).data('id');
			console.log(id);
			$('html,body').animate({
				scrollTop: 10
			}, 500);
			$.ajax({
				type: "GET",
				url: '<?php echo base_url('index.php/welcome/view');?>',
				data: {'id' : id},
				dataType: "JSON",
				success: function (response) {
					console.log(response);
					$(".map-container").removeClass('col-md-12').addClass('col-md-8');
					$(".map-detail").removeClass('hidden');
					$("#form-detail").removeClass('hidden');
					$("#form-jsts").addClass('hidden');
					initMap('map',response);
					let data = response[0];
					$("#kode-kabupaten").val(data.kode_kabupaten);
					$("#nama-kabupaten").val(data.nama_kabupaten);
					let hasil = getLuasDanJarak(data.plain_wilayah);
					let jarakPusatUKMKota = getJarakPusatUKMKota({'pusat_ukm':data.pusat_ukm,'pusat_kota':data.pusat_kota});
					console.log(hasil);
					$("#luas-wilayah").val(((hasil.luas).toFixed(4) / 1000000).toFixed(4)+' km²');
					$("#keliling-wilayah").val(((hasil.panjang).toFixed(4) / 1000 ).toFixed(4)+' km');
					$("#jarak-ukm-pusat-kota").val((jarakPusatUKMKota.toFixed(4) / 1000).toFixed(4)+' km');
					
				}
			});
		});

		$('#load-all').on('click', function () {
			$.ajax({
				type: "GET",
				url: '<?php echo base_url('index.php/welcome/loadAll');?>',
				dataType: "JSON",
				success: function (response) {
					initMap('map',response);
					$(".map-container").removeClass('col-md-8').addClass('col-md-12');
					$(".map-detail").addClass('hidden');
					$("#form-detail").addClass('hidden');
					$("#form-jsts").addClass('hidden');
				}
			});
		});

		$('#show-modal-tambah').on('click', function () {
			$("#form-tambah").trigger('reset');
			let lokasiTambah = {lat: -7.271392714896101, lng: 112.73542550138382};
			let mapTambah = new google.maps.Map(document.getElementById('map-tambah'), {
				zoom: 8,
				center: lokasiTambah,
				draggableCursor: 'default',
				draggingCursor: 'pointer',
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			google.maps.event.addListener(mapTambah,'click', function(event){
				let locationClicked = event.latLng;
				console.log(locationClicked);
				let markerTambah = new google.maps.Marker({
					position : locationClicked,
					map : mapTambah
				});
				
				if(isPusatKotaClicked == true){
					$("[name='pusat-kota']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
					isPusatKotaClicked = false;
				}

				if(isPusatUkmClicked == true){
					$("[name='pusat-ukm']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
					isPusatUkmClicked = false;
				}

				if(isWilayahClicked == true){
					if($("[name='wilayah']").val() != ''){
						$("[name='wilayah']").val($("[name='wilayah']").val()+","+locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
					}else{
						$("[name='wilayah']").val(locationClicked.lat().toFixed(4) + " " + locationClicked.lng().toFixed(4));
					}
				}
			})
			$("#tambah-modal").modal('show');
		});

		$('#simpan').on('click', function () {
			let formData = $("#form-tambah").serialize();
			console.log(formData);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/tambah')?>',
				data: formData,
				dataType: "JSON",
				success: function (response) {
					if(response.status === 'sukses'){
						swal('success','Data Tersimpan','success');
						$("#tambah-modal").modal('hide');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}else{
						swal('error','Data tidak boleh kosong','error');
						$("#tambah-modal").modal('hide');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}
					isPusatUkmClicked = isPusatKotaClicked = isWilayahClicked = isPusatUkmEditClicked = isPusatKotaEditClicked = isWilayahEditClicked = false;
				}
			});
		});

		$('#table-body-data').on('click','.edit-data',function () {
			let id = $(this).data('id');
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('index.php/welcome/edit');?>",
				data: {'id' : id},
				dataType: "JSON",
				success: function (response) {
					let data = response[0];
					let lokasiPusatKota = data.pusat_kota.replace('POINT(','');
					lokasiPusatKota = lokasiPusatKota.replace(')','');
					let lokasiPusatUkm = data.pusat_ukm.replace('POINT(','');
					lokasiPusatUkm = lokasiPusatUkm.replace(')','');
					let lokasiWilayah = data.plain_wilayah.replace('MULTIPOINT(','');
					lokasiWilayah = lokasiWilayah.replace(/\(/g,"");
					lokasiWilayah = lokasiWilayah.replace(/\)/g,"");
					$('[name="id-edit"]').val(data.id);
					$('[name="kode-kabupaten-edit"]').val(data.kode_kabupaten);
					$('[name="nama-kabupaten-edit"]').val(data.nama_kabupaten);
					$('[name="nama-bupati-edit"]').val(data.nama_bupati);
					$('[name="jumlah-penduduk-edit"]').val(data.jumlah_penduduk);
					$('[name="jumlah-ukm-edit"]').val(data.jumlah_ukm);
					$('[name="pusat-kota-edit"]').val(lokasiPusatKota);
					$('[name="pusat-ukm-edit"]').val(lokasiPusatUkm);
					$('[name="wilayah-edit"]').val(lokasiWilayah);
					lokasiPusatKota = lokasiPusatKota.split(' ');
					let isEditMode = false;
					let lokasiEdit = {lat: parseFloat(lokasiPusatKota[0]), lng: parseFloat(lokasiPusatKota[1])};
					let mapEdit = new google.maps.Map(document.getElementById('map-edit'), {
						zoom: 8,
						center: lokasiEdit,
						draggableCursor: 'default',
						draggingCursor: 'pointer',
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});

					google.maps.event.addListener(mapEdit,'click', function(event){
						let locationEditClicked = event.latLng;
						console.log(isPusatKotaEditClicked);
						let markerEdit = new google.maps.Marker({
							position : locationEditClicked,
							map : mapEdit
						});
						
						if(isPusatKotaEditClicked == true){
							$("[name='pusat-kota-edit']").text(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							$("[name='pusat-kota-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							isPusatKotaEditClicked = false;
						}

						if(isPusatUkmEditClicked == true){
							$("[name='pusat-ukm-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							isPusatUkmEditClicked = false;
						}

						if(isWilayahEditClicked == true){
							if($("[name='wilayah-edit']").val() != ''){
								if(isEditMode == false){
									$("[name='wilayah-edit']").val('');	
									isEditMode = true;
									$("[name='wilayah-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
								}else{
									$("[name='wilayah-edit']").val($("[name='wilayah-edit']").val()+","+locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
								}
							}else{
								$("[name='wilayah-edit']").val(locationEditClicked.lat().toFixed(4) + " " + locationEditClicked.lng().toFixed(4));
							}
						}
					});
					$("#edit-modal").modal('show');
					
				}
			});
		});

		$('#update').on('click', function () {
			let formData = $("#form-edit").serialize();
			console.log(formData);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/update')?>',
				data: formData,
				dataType: "JSON",
				success: function (response) {
					if(response.status === 'sukses'){
						swal('success','Data Tersimpan','success');
						$("#edit-modal").modal('hide');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}else{
						swal('error','Data tidak boleh kosong','error');
						$("#edit-modal").modal('hide');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}
				}
			});
		});

		$("#table-body-data").on('click','.delete-data', function () {
			let id = $(this).data('id');
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/delete')?>',
				data: {'id' : id},
				dataType: "JSON",
				success: function (response) {
					if(response.status === 'sukses'){
						swal('success','Data Terhapus','success');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}else{
						swal('error','Data Gagal Dihapus','error');
						initTable('table-body-data',response.data);
						initMap('map',response.data);
						lokasiFromDatabase = response.data;
					}
				}
			});
		});

		$("#jsts-option").on('click', function () {
			$(".map-container").removeClass('col-md-12').addClass('col-md-8');
			$(".map-detail").removeClass('hidden');
			$("#form-detail").addClass('hidden');
			$("#form-jsts").removeClass('hidden');
		});

		$("#intersection-action").on('click', function () {
			let jsts1 = $('[name="jsts-1"] :selected').val();
			let jsts2 = $('[name="jsts-2"] :selected').val();
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/jsts')?>',
				data: {'jsts1' : jsts1, 'jsts2' : jsts2},
				dataType: "JSON",
				success: function (response) {
					jstsCreate('intersect','map',response);
				}
			});
		});

		$("#union-action").on('click', function () {
			let jsts1 = $('[name="jsts-1"] :selected').val();
			let jsts2 = $('[name="jsts-2"] :selected').val();
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/jsts')?>',
				data: {'jsts1' : jsts1, 'jsts2' : jsts2},
				dataType: "JSON",
				success: function (response) {
					jstsCreate('union','map',response);
				}
			});
		});

		$("#jsts-1").on('change', function () {
			let jsts1 = $('[name="jsts-1"] :selected').val();
			let jsts2 = $('[name="jsts-2"] :selected').val();
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/jsts')?>',
				data: {'jsts1' : jsts1, 'jsts2' : jsts2},
				dataType: "JSON",
				success: function (response) {
					initMap('map',response);
				}
			});
		});

		$("#jsts-2").on('change', function () {
			let jsts1 = $('[name="jsts-1"] :selected').val();
			let jsts2 = $('[name="jsts-2"] :selected').val();
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('index.php/welcome/jsts')?>',
				data: {'jsts1' : jsts1, 'jsts2' : jsts2},
				dataType: "JSON",
				success: function (response) {
					initMap('map',response);
				}
			});
		});

		$("#jsts-intersection").on('click', function () {
			jstsCreate('intersection-all','map',lokasiFromDatabase);
		});

		$("#jsts-union").on('click', function () {
			jstsCreate('union-all','map',lokasiFromDatabase);
		});

		$("[name='pusat-kota']").on('click', function () {
			if(isPusatKotaClicked == false){
				isPusatKotaClicked = true;
			}
			$('#tambah-modal').animate({
				scrollTop: 100
			}, 500);
		});

		$("[name='pusat-ukm']").on('click', function () {
			if(isPusatUkmClicked == false){
				isPusatUkmClicked = true;
			}
			$('#tambah-modal').animate({
				scrollTop: 100
			}, 500);
		});

		$("[name='wilayah']").on('click', function () {
			if(isWilayahClicked == false){
				isWilayahClicked = true;
			}
			$('#tambah-modal').animate({
				scrollTop: 100
			}, 500);
		});

		$("[name='pusat-kota-edit']").on('click', function () {
			if(isPusatKotaEditClicked == false){
				isPusatKotaEditClicked = true;
			}
			$('#edit-modal').animate({
				scrollTop: 100
			}, 500);
		});

		$("[name='pusat-ukm-edit']").on('click', function () {
			if(isPusatUkmEditClicked == false){
				isPusatUkmEditClicked = true;
			}
			$('#edit-modal').animate({
				scrollTop: 100
			}, 500);
		});

		$("[name='wilayah-edit']").on('click', function () {
			if(isWilayahEditClicked == false){
				isWilayahEditClicked = true;
			}
			$('#edit-modal').animate({
				scrollTop: 100
			}, 500);
		});
	});
</script>
</body>
</html>
