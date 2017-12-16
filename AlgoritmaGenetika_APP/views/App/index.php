<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Algoritma Genetika</title>
	<link rel="stylesheet" href="<?php echo ROOTPATH.'assets/vendor/bootstrap/css/bootstrap.min.css'?>">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-row">
					<div class="form-group col-md-4 col-sm-4 col-xs-12">
						<label for="individu">Populasi : </label>
						<input type="text" class="form-control" name="individu" id="individu">
						<span class="help-block"></span>
					</div>
					<div class="form-group col-md-4 col-sm-4 col-xs-12">
					<label for="harga">Harga Minimum : </label>
						<input type="text" class="form-control" name="hargaminim" id="hargaminim">
					</div>
					<div class="form-group col-md-4 col-sm-4 col-xs-12">
					<label for="harga">Harga Maksimal : </label>
						<input type="text" class="form-control" name="hargamaks" id="hargamaks">
					</div>
				</div>
				<button type="submit" class="btn btn-primary" id="bangkitkan">Bangkitkan Populasi</button>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<h3>Tabel Harga</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>NO</th>
							<th>RAM</th>
							<th>MOTHERBOARD</th>
							<th>POWER SUPLY</th>
							<th>PROCESSOR</th>
							<th>HARD DISK</th>
						</tr>
					</thead>
					<tbody id="tabelHarga">
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div id="accordion-panel-left" role="tablist">
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-left-one">
							<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapse-generasi" aria-expanded="true" aria-controls="collapse-generasi" id="data-generasi">
								Data Populasi Awal
								</a>
							</h5>
						</div>
						<div id="collapse-generasi" class="collapse show" role="tabpanel" aria-labelledby="heading-panel-left-one" data-parent="#accordion-panel-left">
							<div class="card-body">
								<table class="table table-striped">
									<!-- DISESUAIKAN DENGAN KOMPONEN KOMPUTER-->
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>FITNESS</th>
										</tr>
									</thead>
									<tbody id="hasilPopulasi">
									</tbody>
								</table>
								<button id="doSeleksi" type="submit" class="btn btn-primary" >Lakukan Seleksi</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div id="accordion-panel-right" role="tablist">
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-right-one">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-seleksi" aria-expanded="false" aria-controls="collapse-seleksi" id="data-seleksi">
								Data Seleksi
								</a>
							</h5>
						</div>
						<div id="collapse-seleksi" class="collapse" role="tabpanel" aria-labelledby="heading-panel-right-one" data-parent="#accordion-panel-right">
							<div class="card-body" id="card-hasil-seleksi">
								<table class="table table-striped">
									<!-- DISESUAIKAN DENGAN KOMPONEN KOMPUTER-->
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>FITNESS</th>
										</tr>
									</thead>
									<tbody id="hasilSeleksi">
									</tbody>
								</table>
								<button id="doGenerasi" type="submit" class="btn btn-primary" >Lakukan Generasi</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo ROOTPATH.'assets/vendor/jquery/jquery-3.2.1.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/popper/dist/umd/popper.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/bootstrap/js/bootstrap.min.js';?>"></script>

	<script>
	// untuk harga digunakan perbandingan 1 : 10000
	var RAM = [40,45,50,55,60];
	var MOTHERBOARD = [100,120,140,150,160];
	var POWER_SUPPLY = [20,22,25,30,40];
	var PROCESSOR = [300,350,400,450,500];
	var HARD_DISK = [70,75,80,85,90];
	var KOMPONEN = [RAM, MOTHERBOARD, POWER_SUPPLY, PROCESSOR, HARD_DISK];
	var JUMLAH_KOMPONEN = 5;
	var _FITNESS = 900;

	var fitness = 0, totalBiaya = 0, induk;
	var random, hasil, jumlah = 0;
	var indukSeleksi = [];

	/**
	 * Untuk melakukan seleksi dari indvidu yang telah dibangkitkan
	 * @params individu individu yang dibangkitkan
	 * @return induk dipilih berdasarkan nilai fitness tertinggi
	 */
	function seleksi(individu){
		induk = [];
		var check = 0;
		for(var i = 0; i < individu.length; i++){
			if(check <= parseInt(individu[i][5])){
				check = parseInt(individu[i][5]);
				induk = individu[i];
			}
		}
		return induk;
	}

	function displayHarga(){
		$("#tabelHarga").empty();
		for(var row = 0; row < KOMPONEN.length; row++){
			$("#tabelHarga").append("<tr id=h"+row+"><td>"+(row+1)+"</td></tr>");
		}
		for(var i = 0; i < KOMPONEN.length; i++){
			for(var j =  0; j < KOMPONEN[i].length; j++){
				var id = "#tabelHarga #h"+i;
				hasil = "<td>"+KOMPONEN[j][i]+"</td>";
				$(id).append(hasil);
			}
		}
	}
	$(document).ready(function () {
		
		displayHarga();
		$("#bangkitkan").on('click', function () {	
			var individu = $("#individu").val();
			$("#hasilPopulasi").empty();

			for(var i = 0; i < individu; i++){
				$("#hasilPopulasi").append("<tr id="+i+"></tr>");
			}
			var arr = [];
			for(var j = 0; j < individu; j++){
				arr.push([]);
				jumlah = 0;
				totalBiaya = 0;
				fitness = 0;
				for(var k = 0; k < JUMLAH_KOMPONEN + 1; k++){
					if(k == JUMLAH_KOMPONEN){
						fitness = _FITNESS - totalBiaya;
						arr[j].push(fitness);
						hasil = "<td>"+fitness+"</td>";
						id = "#hasilPopulasi #"+j;
						$(id).append(hasil);
					}else{
						random = Math.floor((Math.random() * 5) + 1);
						arr[j].push(random);
						hasil = "<td>"+random+"</td>";
						id = "#hasilPopulasi #"+j;
						$(id).append(hasil);
						totalBiaya += parseInt(KOMPONEN[k][(parseInt(arr[j][k])-1)]);
					}
				}
			}
			console.log(seleksi(arr));
		});
	});
	</script>
</body>
</html>
