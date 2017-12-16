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
					<div class="form-group col-md-6 col-sm-6 col-xs-12">
						<label for="individu">Populasi : </label>
						<input type="text" class="form-control" name="individu" id="individu">
						<span class="help-block"></span>
					</div>
					<div class="form-group col-md-6 col-sm-6 col-xs-12">
					<label for="harga">Harga Maksimal : </label>
						<input type="text" class="form-control" name="hargamaks" id="hargamaks" placeholder="lebih besar 6.000.000">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<button type="submit" class="btn btn-primary" id="bangkitkan">Bangkitkan Populasi</button>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<h6>Fungsi Fitness : </h6>
						<p><code> 1 &#47; &#40; abs&#40;Biaya Maksimal - &Sigma; Biaya Komponen&#41; &#47; Biaya Maksimal &#41;</code></p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div id="accordion-panel-price" role="tablist">
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-price">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-price" aria-expanded="false" aria-controls="collapse-price" id="price-data">
								Tabel Harga
								</a>
							</h5>
						</div>
						<div id="collapse-price" class="collapse" role="tabpanel" aria-labelledby="heading-panel-price" data-parent="#accordion-panel-price">
							<div class="card-body">
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
					</div>
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-price-total">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-price-total" aria-expanded="false" aria-controls="collapse-price-total" id="price-total-data">
								Harga Total Hasil Generasi
								</a>
							</h5>
						</div>
						<div id="collapse-price-total" class="collapse" role="tabpanel" aria-labelledby="heading-panel-price-total" data-parent="#accordion-panel-price-total">
							<div class="card-body">
								<table class="table table-striped table-responsive">
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>FITNESS</th>
											<th>TOTAL</th>
										</tr>
									</thead>
									<tbody id="tabelHargaTotal">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
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
								<table class="table table-striped table-responsive">
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>FITNESS</th>
											<th>TOTAL</th>
										</tr>
									</thead>
									<tbody id="hasilGenerasi">
									</tbody>
								</table>
								<button id="doProbabilitas" type="submit" class="btn btn-primary" >Hitung Probabilitas Roullete</button>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-left-two">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-roullete" aria-expanded="true" aria-controls="collapse-roullete" id="data-roullete">
								Data Seleksi
								</a>
							</h5>
						</div>
						<div id="collapse-roullete" class="collapse" role="tabpanel" aria-labelledby="heading-panel-left-two" data-parent="#accordion-panel-left">
							<div class="card-body">
								<table class="table table-striped table-responsive">
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
									<tbody id="hasilRoullete">
									</tbody>
								</table>
								<button id="doKawinSilang" type="submit" class="btn btn-primary" >Lakukan Kawin Silang</button>
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
								<a class="collapsed" data-toggle="collapse" href="#collapse-probabilitas" aria-expanded="false" aria-controls="collapse-probabilitas" id="data-probabilitas">
								Data Roullete
								</a>
							</h5>
						</div>
						<div id="collapse-probabilitas" class="collapse" role="tabpanel" aria-labelledby="heading-panel-right-one" data-parent="#accordion-panel-right">
							<div class="card-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>PERSENTASE</th>
											<th>ROULETTE</th>
										</tr>
									</thead>
									<tbody id="hasilProbabilitas">
									</tbody>
								</table>
								<button id="doSeleksi" type="submit" class="btn btn-primary" >Lakukan Seleksi</button>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab" id="heading-panel-right-two">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapse-kawin-silang" aria-expanded="false" aria-controls="collapse-kawin-silang" id="data-kawin-silang">
								Data Kawin Silang
								</a>
							</h5>
						</div>
						<div id="collapse-kawin-silang" class="collapse" role="tabpanel" aria-labelledby="heading-panel-right-two" data-parent="#accordion-panel-right">
							<div class="card-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
											<th>PERSENTASE</th>
											<th>ROULETTE</th>
										</tr>
									</thead>
									<tbody id="hasilKawinSilang">
									</tbody>
								</table>
								<button id="doMutasi" type="submit" class="btn btn-primary" >Lakukan Mutasi</button>
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
	/**
	 * STATIC VARIABEL
	 */
	var RAM = [40,45,47,56,58,62,72,73,80,91];
	var MOTHERBOARD = [100,140,160,175,210,230,240,260,290,320];
	var POWER_SUPPLY = [41,43,46,58,65,66,70,78,83,85];
	var PROCESSOR = [300,375,450,480,510,525,560,589,611,643];
	var HARD_DISK = [82,86,92,94,97,102,113,124,136,145];
	var KOMPONEN = [RAM, MOTHERBOARD, POWER_SUPPLY, PROCESSOR, HARD_DISK];
	var JUMLAH_KOMPONEN = 5;
	var _FITNESS = 2000;

	/**
	 * Variabel yang digunakan untuk algoritma genetika
	 */
	var fitness = 0, totalBiaya = 0, fungsi_fitness = 0, induk;
	var random, hasil;
	var hasilTerbaik = [], arr = [];

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

	/**
	 * Untuk menampilkan harga
	 * @target tbody id=tabelHarga
	 */
	function displayHarga(){
		$("#tabelHarga").empty();
		for(var row = 0; row < KOMPONEN[0].length; row++){
			$("#tabelHarga").append("<tr id=h"+row+"><td>"+(row+1)+"</td></tr>");
		}
		for(var i = 0; i < KOMPONEN[0].length; i++){
			for(var j =  0; j < KOMPONEN.length; j++){
				var id = "#tabelHarga #h"+i;
				var hasil = "<td>"+KOMPONEN[j][i]+"</td>";
				$(id).append(hasil);
			}
		}
	}

	/**
	 * Menampilkan harga total
	 * @target tbody id=tabelHargaTotal
	 */
	function displayHargaTotal(populasi){
		$("#tabelHargaTotal").empty();
		for(var row = 0; row < 1; row++){
			$("#tabelHargaTotal").append("<tr id=t"+row+"></tr>");
			for(var i = 0; i < populasi.length; i++){
				var id = "#tabelHargaTotal #t"+row;
				var hasil = "<td>"+populasi[i]+"</td>";
				$(id).append(hasil);
			}
		}
	}

	function checkInput(varA, varB){
		if(varA.length == 0 || varB.length == 0){
			return 'FALSE';
		}else{
			if(parseInt(varB) < 6000000){
				return 'FALSE';
			}else{
				return 'TRUE';
			}
		}
	}

	/**
	 * Kegiatan mulai dilakukan disini
	 */
	$(document).ready(function () {

		// cek apakah ketika document di load, inputan masih kosong
		if($("#individu").val().length == 0 || $("#hargamaks").val().length == 0){
			$("#bangkitkan").attr('disabled',true);
		}else{
			$("#bangkitkan").attr('disabled',false);
		}

		// menampilkan harga barang
		displayHarga();

		// jika tidak focus di inputan populasi, lakukan cek
		$("#individu").on('blur', function(){
			if(checkInput($("#individu").val(),$("#hargamaks").val()) === 'FALSE'){
				$("#bangkitkan").attr('disabled',true);
			}else{
				$("#bangkitkan").attr('disabled',false);
			}
		});

		// jika tidak focus di inputan harga maksimal, lakukan cek
		$("#hargamaks").on('blur', function(){
			if(checkInput($("#individu").val(),$("#hargamaks").val()) === 'FALSE'){
				$("#bangkitkan").attr('disabled',true);
			}else{
				$("#bangkitkan").attr('disabled',false);
			}
		});

		/**
		 * Flowchart pada saat bangkitkan populasi
		 * 1. Siapkan array untuk menampung data
		 * 2. Baca inputan dari individu dan harga maksimal, untuk harga maksimal kita samakan dengan harga komponen
		 * 3. Kosongkan tabel hasil generasi
		 * 4. Lakukan perulangan hingga batas individu
		 * 5. Siapkan array lagi didalam array yang telah diinisialisasi, kosongkan semua variabel yang digunakan
		 * 6. Lakukan perulangan hingga batas komponen
		 * 7. Jika indeks tidak sama dengan jumlah komponen, lakukan random angka untuk mendapatkan gen
		 * 8. Tampung hasil random tersebut kedalam array kedua, lakukan perhitungan total biaya
		 * 9. Jika indeks sama dengan jumlah komponen, lakukan perhitungan untuk mengetahui fungsi fitness nya
		 * 10. Tampilkan hasil bangkitkan ke dalam tabel hasil generasi
		 */
		$("#bangkitkan").on('click', function () {
			//step 1
			arr = [];

			//step 2
			var individu = $("#individu").val();
			var maksimal = $("#hargamaks").val() / 10000; // dibagi sepuluh ribu, karena komponen juga dalam perbandingan 1 : 1000

			//step 3
			$("#hasilGenerasi").empty();

			for(var i = 0; i < individu; i++){
				$("#hasilGenerasi").append("<tr id="+i+"></tr>");
			}
			
			/**
			 * Contoh array yang tercipta dari komponen adalah sebagai berikut
			 * KOMPONEN = [[1,2,3,4],[1,2,3,4]];
			 */

			//step 4
			for(var j = 0; j < individu; j++){
				//step 5
				arr.push([]);
				totalBiaya = 0;
				fitness = 0;
				fungsi_fitness = 0;
				//step 6
				for(var k = 0; k < JUMLAH_KOMPONEN + 1; k++){
					if(k == JUMLAH_KOMPONEN){ //step 9
						// FUNGSI FITNESS
						fungsi_fitness = 1 / (Math.abs(maksimal - totalBiaya) / maksimal);
						arr[j].push(fungsi_fitness);
						arr[j].push(totalBiaya);
						hasil = "<td>"+fungsi_fitness+"</td><td>"+totalBiaya+"</td>";
						id = "#hasilGenerasi #"+j;
						$(id).append(hasil);
					}else{ //step 7
						//step 8
						random = Math.floor((Math.random() * 10) + 1); //random komponen
						arr[j].push(random);
						hasil = "<td>"+random+"</td>";
						id = "#hasilGenerasi #"+j;
						$(id).append(hasil);
						totalBiaya += parseInt(KOMPONEN[k][(parseInt(arr[j][k])-1)]);
					}
				}
			}
			//console.log(arr);
			hasilTerbaik = seleksi(arr);
			console.log(hasilTerbaik);
			displayHargaTotal(hasilTerbaik);
		});

		/**
		 * Flowchart untuk 
		 */

		$("#doProbabilitas").on('click',function(){
			console.log(arr);
		});

		$("#doSeleksi").on('click',function(){
			
		});

		$("#doKawinSilang").on('click',function(){
			
		});

		$("#doMutasi").on('click',function(){
			
		});
	});
	</script>
</body>
</html>
