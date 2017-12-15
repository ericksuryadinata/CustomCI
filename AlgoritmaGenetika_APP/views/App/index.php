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
					<div class="form-group col-md-6">
						<label for="individu">Populasi : </label>
						<input type="text" class="form-control" name="individu" id="individu">
					</div>
					<div class="form-group col-md-6">
					<label for="harga">Harga Maksimal : </label>
						<input type="text" class="form-control" name="hargamaks" id="hargamaks">
					</div>
				</div>
				<button type="submit" class="btn btn-primary" id="bangkitkan">Bangkitkan Populasi</button>
				<hr>
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
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<h3>Tabel Harga</h3>
				<table class="table">
				</table>
			</div>
		</div>
	</div>

	<script src="<?php echo ROOTPATH.'assets/vendor/jquery/jquery-3.2.1.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/popper/dist/umd/popper.min.js';?>"></script>
	<script src="<?php echo ROOTPATH.'assets/vendor/bootstrap/js/bootstrap.min.js';?>"></script>

	<script>
	$(document).ready(function () {
		var JUMLAH_KOMPONEN = 5;
		// var FITNESS = 25;
		var random, hasil, jumlah = 0;
		var totalBiaya = 0;
		// untuk harga digunakan perbandingan 1 : 10000
		var RAM = [40,45,50,55,60];
		var MOTHERBOARD = [100,120,140,150,160];
		var POWER_SUPPLY = [20,22,25,30,40];
		var PROCESSOR = [300,350,400,450,500];
		var HARD_DISK = [70,75,80,85,90];
		var KOMPONEN = [RAM, MOTHERBOARD, POWER_SUPPLY, PROCESSOR, HARD_DISK];
		
		$("#bangkitkan").on('click', function () {
			var arr = [];
			
			var individu = $("#individu").val();
			$("#hasilPopulasi").empty();
			for(var i = 0; i < individu; i++){
				$("#hasilPopulasi").append("<tr id="+i+"></tr>");
			}
			for(var j = 0; j < individu; j++){
				arr.push([]);
				jumlah = 0;
				for(var k = 0; k < JUMLAH_KOMPONEN + 1; k++){
					if(k == 5){
						hasil = "<td>"+jumlah+"</td>";
						id = "#hasilPopulasi #"+j;
						$(id).append(hasil);	
					}else{
						random = Math.floor((Math.random() * 5) + 1);
						arr[j].push(random);
						hasil = "<td>"+random+"</td>";
						id = "#hasilPopulasi #"+j;
						$(id).append(hasil);
						jumlah = jumlah + parseInt(arr[j][k]);
					}
				}
			}
			totalHarga(arr);
			console.log(arr);
		});

		function totalHarga(kode){
			console.log(kode.length);
			for(var i = 0; i < kode.length; i++){
				totalBiaya = 0;
				for(var j = 0; j < kode[i].length; j++){
					totalBiaya += parseInt(KOMPONEN[j][(parseInt(kode[i][j])-1)]);
				}
				console.log(totalBiaya);
			}
		}
	});
	</script>
</body>
</html>
