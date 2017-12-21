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
					</div>
					<div class="form-group col-md-6 col-sm-6 col-xs-12">
					<label for="harga">Harga Mendekati : </label>
						<input type="text" class="form-control" name="hargamaks" id="hargamaks" placeholder="lebih besar 6.000.000">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6 col-sm-6 col-xs-12">
						<label for="probcross">Probabilitas Kawin Silang : </label>
						<input type="text" class="form-control" name="probcros" id="probcrossover">
						<span class="help-block"></span>
					</div>
					<div class="form-group col-md-6 col-sm-6 col-xs-12">
					<label for="probmut">Probabilitas Mutasi : </label>
						<input type="text" class="form-control" name="probmut" id="probmutasi">
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
											<th>GENERASI KE - </th>
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
									<div id="rodaPutar">
									</div>
									<div id="persentasiPopulasi">
									</div>
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
										</tr>
									</thead>
									<tbody id="hasilRoullete">
									</tbody>
									<div id="hasilRoulleteTemp">
									</div>
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
								<table class="table table-striped table-responsive">
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
								<table class="table table-striped table-responsive">
									<thead>
										<tr>
											<th>RAM</th>
											<th>MOTHERBOARD</th>
											<th>POWER SUPLY</th>
											<th>PROCESSOR</th>
											<th>HARD DISK</th>
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
	'use strict';
	/**
	 * STATIC VARIABEL
	 * untuk harga digunakan perbandingan 1 : 10000
	 * pastikan untuk setiap komponen mempunyai panjang yang sama
	 */
	const RAM = [40,45,47,56,58,62,72,73,80,91];
	const MOTHERBOARD = [100,140,160,175,210,230,240,260,290,320];
	const POWER_SUPPLY = [41,43,46,58,65,66,70,78,83,85];
	const PROCESSOR = [300,375,450,480,510,525,560,589,611,643];
	const HARD_DISK = [82,86,92,94,97,102,113,124,136,145];
	const KOMPONEN = [RAM, MOTHERBOARD, POWER_SUPPLY, PROCESSOR, HARD_DISK];
	const JUMLAH_KOMPONEN = 5;

	/**
	 * Untuk menampilkan harga
	 * @target tbody id=tabelHarga
	 */
	function displayHarga(){
		let row, i, j, id, hasil;
		$("#tabelHarga").empty();
		for(row = 0; row < KOMPONEN[0].length; row++){
			$("#tabelHarga").append("<tr id=h"+row+"><td>"+(row+1)+"</td></tr>");
		}
		for(i = 0; i < KOMPONEN[0].length; i++){
			for(j =  0; j < KOMPONEN.length; j++){
				id = "#tabelHarga #h"+i;
				hasil = "<td>"+KOMPONEN[j][i]+"</td>";
				$(id).append(hasil);
			}
		}
	}

	/**
	 * Menampilkan harga total
	 * @target tbody id=tabelHargaTotal
	 */
	function displayHargaTotal(populasi){
		let row, col, id, hasil;
		$("#tabelHargaTotal").empty();
		for(row = 0; row < populasi.length; row++){
			$("#tabelHargaTotal").append("<tr id=t"+row+"></tr>");
		}
		for(row = 0; row < populasi.length; row++){
			for(col = 0; col <= populasi[row].length; col++){
				if(col == 0){
					id = "#tabelHargaTotal #t"+row;
					hasil = "<td>"+row+"</td>";
					$(id).append(hasil);
				}else{
					id = "#tabelHargaTotal #t"+row;
					hasil = "<td>"+populasi[row][col-1]+"</td>";
					$(id).append(hasil);
				}
			}
		}
	}

	/**
	 * Untuk mengetahui validitas dari input
	 * @params varA inputan pertama
	 * @params varB inputan kedua
	 * @return TRUE jika inputan terisi semua, FALSE jika salah satu tidak diinput
	 */
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
	 * Untuk melakukan seleksi dari indvidu yang telah dibangkitkan
	 * @params individu individu yang dibangkitkan
	 * @params maksimal harga maksimal permintaan
	 * @return induk dipilih berdasarkan nilai fitness tertinggi
	 */
	function seleksi(individu){
		let induk = [],check = 0, i;
		for(i = 0; i < individu.length; i++){
			// check apakah fitnessnya lebih besar dan total harga komponen lebih kecil sama dengan harga maksimal
			if( check <= parseInt(individu[i][5]) ){
				check = parseInt(individu[i][5]);
				induk = individu[i];
			}
		}
		return induk;
	}

	/**
	 * Untuk menghitung total fitness
	 * @params populasi populasi dari hasil generasi
	 * @return total total fitness keseluruhan
	 */
	function totalFitness(populasi){
		let total = 0, i;
		for(i = 0; i < populasi.length; i++){
			total += parseFloat(populasi[i][5]);
		}
		return total;
	}

	function generasiRandom(individu, maksimal) {  
		let populasi_array, j, k, random, fungsi_fitness, total_biaya;
		populasi_array = [];
		for(j = 0; j < individu; j++){
			populasi_array.push([]);
			total_biaya = 0;
			fungsi_fitness = 0;
			random = 0;
			for(k = 0; k < JUMLAH_KOMPONEN + 1; k++){
				if(k == JUMLAH_KOMPONEN){
					fungsi_fitness = 1 / (Math.abs(maksimal - total_biaya) / maksimal);
					populasi_array[j].push(fungsi_fitness);
					populasi_array[j].push(total_biaya);
				}else{
					random = Math.floor((Math.random() * 10) + 1);
					populasi_array[j].push(random);
					total_biaya += parseInt(KOMPONEN[k][(parseInt(populasi_array[j][k])-1)]);
				}
			}
		}
		return populasi_array;
	}

	function regenerasi(populasi, maksimal){
		let populasi_generasi, j, i, random, fungsi_fitness, total_biaya;
		populasi_generasi = [];
		for(i = 0; i < populasi.length; i++){
			populasi_generasi.push([]);
			total_biaya = 0;
			fungsi_fitness = 0;
			random = 0;
			for(j = 0; j < JUMLAH_KOMPONEN + 1; j++){
				if(j == JUMLAH_KOMPONEN){
					fungsi_fitness = 1 / (Math.abs(maksimal - total_biaya) / maksimal);
					populasi_generasi[i].push(fungsi_fitness);
					populasi_generasi[i].push(total_biaya);
				}else{
					random = populasi[i][j];
					populasi_generasi[i].push(random);
					total_biaya += parseInt(KOMPONEN[j][(parseInt(populasi_generasi[i][j])-1)]);
				}
			}
		}

		return populasi_generasi;
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

		$("#bangkitkan").on('click', function () {
			let i, populasi_bangkit = [], row, col, id, hasil;
			let individu = $("#individu").val();
			let maksimal = $("#hargamaks").val() / 10000; // dibagi sepuluh ribu, karena komponen juga dalam perbandingan 1 : 1000
			console.log("awal bangkitkan");
			console.log(populasi_bangkit);
			populasi_bangkit = generasiRandom(individu, maksimal);

			$("#hasilGenerasi").empty();
			for(i = 0; i < individu; i++){
				$("#hasilGenerasi").append("<tr id=hg"+i+"></tr>");
			}

			for(row = 0; row < populasi_bangkit.length; row++){
				for(col = 0; col < populasi_bangkit[row].length; col++){
					id = "#hasilGenerasi #hg"+row;
					hasil = "<td>"+populasi_bangkit[row][col]+"</td>";
					$(id).append(hasil);
				}
			}
			
			$("#hasilGenerasi").data(populasi_bangkit);
			$("#doProbabilitas").attr("disabled",false);
			console.log("akhir bangkitkan");
			console.log(populasi_bangkit);
		});

		$("#doProbabilitas").on('click',function(){
			let indeks = 0, i, persentasi_populasi = [], row, col, id, hasil;
			let populasi_bangkit_probabilitas = [], total_fitness = 0, persentasi_fitness = 0, roda_putar = [];
			populasi_bangkit_probabilitas = $.map( $("#hasilGenerasi").data(),function(value, index){
				return [value];
			});
			console.log("awal probabilitas");
			console.log(populasi_bangkit_probabilitas);
			// step 1
			total_fitness = totalFitness(populasi_bangkit_probabilitas);
			
			for(i = 0; i < populasi_bangkit_probabilitas.length; i++){
				// step 2
				persentasi_fitness = Math.round(parseFloat(100 * populasi_bangkit_probabilitas[i][5] / total_fitness));
				persentasi_populasi.push(persentasi_fitness);
				// step 3
				for(var j = 0; j < persentasi_fitness; j++){
					roda_putar[indeks] = i;
					indeks += 1;
				}
			}

			// tampilkan kedalam tabel hasil probabilitas
			$("#hasilProbabilitas").empty();
			for(row = 0; row < populasi_bangkit_probabilitas.length; row++){
				$("#hasilProbabilitas").append("<tr id=hp"+row+"></tr>");
			}
			for(row = 0; row < populasi_bangkit_probabilitas.length; row++){
				for(col = 0; col < populasi_bangkit_probabilitas[row].length; col++){
					if(col == 5){
						id = "#hasilProbabilitas #hp"+row;
						hasil = "<td>"+persentasi_populasi[row]+" %</td>";
						$(id).append(hasil);
					}else if(col == 6){

					}else{
						id = "#hasilProbabilitas #hp"+row;
						hasil = "<td>"+populasi_bangkit_probabilitas[row][col]+"</td>";
						$(id).append(hasil);
					}
				}
			}

			$("#hasilProbabilitas").data(populasi_bangkit_probabilitas);
			$("#rodaPutar").data(roda_putar);
			$("#persentasiPopulasi").data(persentasi_populasi);
			console.log("akhir probabilitas");
			console.log(populasi_bangkit_probabilitas);
			$("#doProbabilitas").attr('disabled',true);
			$("#doSeleksi").attr('disabled',false);
			$("#data-probabilitas").trigger('click');

		});

		/**
		 * Flowchart untuk melakukan seleksi
		 * 1. Tampung hasil populasi sebelumnya, kosongkan populasi utama
		 * 2. Random angka dari angka 1 - 100
		 * 3. Pilih kromosom dari populasi tampung dengan indeks hasil roda_putar[random]
		 * 4. Tampung hasilnya ke populasi Utama
		 */
		$("#doSeleksi").on('click',function(){
			let populasi_seleksi = [], populasi_seleksi_temp = [], populasi_tampung_seleksi = [], row, col, random_seleksi = 0, kromosom_terpilih = 0;
			let roda_putar = [], id = 0, hasil, persentasi_seleksi = [];
			populasi_tampung_seleksi = $.map( $("#hasilProbabilitas").data(),function(value, index){
				return [value];
			});
			roda_putar = $.map( $("#rodaPutar").data(),function(value, index){
				return [value];
			});
			persentasi_seleksi = $.map( $("#persentasiPopulasi").data(),function(value, index){
				return [value];
			});
			console.log("awal seleksi menggunakan populasi tampung");
			console.log(populasi_tampung_seleksi);
			console.log(roda_putar);

			$("#hasilProbabilitas").empty();
			for(row = 0; row < populasi_tampung_seleksi.length; row++){
				$("#hasilProbabilitas").append("<tr id=hp"+row+"></tr>");
			}

			for(row = 0; row < populasi_tampung_seleksi.length; row++){
				// step 2
				random_seleksi = Math.floor((Math.random() * 100)); //random
				// step 3
				kromosom_terpilih = roda_putar[random_seleksi];
				// step 4
				populasi_seleksi[row] = $.map(populasi_tampung_seleksi[kromosom_terpilih],function(value, index){
					return [value];
				});
				for(col = 0; col < populasi_tampung_seleksi[row].length; col++){
					if(col == 5){
						id = "#hasilProbabilitas #hp"+row;
						hasil = "<td>"+persentasi_seleksi[row]+" %</td>";
						$(id).append(hasil);
					}else if(col == 6){
						id = "#hasilProbabilitas #hp"+row;
						hasil = "<td>"+kromosom_terpilih+"</td>";
						$(id).append(hasil);
					}else{
						id = "#hasilProbabilitas #hp"+row;
						hasil = "<td>"+populasi_tampung_seleksi[row][col]+"</td>";
						$(id).append(hasil);
					}
				}
			}
			console.log("akhir seleksi menggunakan populasi bangkit");
			console.log(populasi_seleksi);
			// hasil dari roullete ditampilkan kedalam tabel roullete
			$("#hasilRoullete").empty();
			for(row = 0; row < populasi_seleksi.length; row++){
				$("#hasilRoullete").append("<tr id=hr"+row+"></tr>");
			}

			for(row = 0; row < populasi_seleksi.length; row++){
				for(col = 0; col < populasi_seleksi[row].length; col++){
					if(col == 5 || col == 6){
					}else{
						id = "#hasilRoullete #hr"+row;
						hasil = "<td>"+populasi_seleksi[row][col]+"</td>";
						$(id).append(hasil);
					}
				}
			}
			
			$("#hasilRoullete").data(populasi_seleksi);
			$("#hasilRoulleteTemp").data(populasi_seleksi);
			$("#data-roullete").trigger('click');
			$("#doSeleksi").attr('disabled',true);
			$("#doKawinSilang").attr('disabled',false);
		});	

		$("#doKawinSilang").on('click',function(e){
			let populasi_kawin_silang = [], populasi_terpilih = [], nomor_terpilih = [], populasi_kawin = [];
			let probabilitas_kawin_silang = 0, random_kawin = 0, cut_point_pertama = 0, cut_point_kedua = 0,tampung_gen = 0;
			let i,j, row, col, id, hasil;
			
			populasi_kawin_silang = $.map( $("#hasilRoullete").data(),function(value, index){
				return [value];
			});
			
			console.log(populasi_kawin_silang);

			probabilitas_kawin_silang = $("#probcrossover").val() / 100;
			for(i = 0; i < populasi_kawin_silang.length; i++){
				random_kawin = Math.random();
				if(random_kawin < probabilitas_kawin_silang){
					nomor_terpilih.push(i);
					populasi_terpilih.push(populasi_kawin_silang[i]);
				}
			}

			// console.log(populasi_terpilih);
			// console.log(nomor_terpilih);
			if(populasi_terpilih.length == 0 || populasi_terpilih.length == 1){

			}else{
				for(i = 1; i <= populasi_terpilih.length; i++){
					if(i == populasi_terpilih.length){
						
					}else{
						cut_point_pertama = Math.floor(Math.random() * JUMLAH_KOMPONEN);
						cut_point_kedua = Math.floor(Math.random() * (JUMLAH_KOMPONEN - cut_point_pertama)) + cut_point_pertama;
						// console.log(cut_point_pertama);
						// console.log(cut_point_kedua);
						// console.log(populasi_terpilih[i - 1]);
						// console.log(populasi_terpilih[i]);
						for(j = cut_point_pertama; j <= cut_point_kedua; j++){
							tampung_gen = populasi_terpilih[i-1][j];
							populasi_terpilih[i - 1][j] = populasi_terpilih[i][j];
							populasi_terpilih[i][j] = tampung_gen;
						}
					}
					populasi_kawin[i - 1] = $.map(populasi_terpilih[i - 1], function(value, index){
						return [value];
					});	
					// console.log(populasi_kawin);
					// console.log(populasi_terpilih[i - 1]);
					// console.log(populasi_terpilih[i]);
				}
			}
			console.log(populasi_kawin_silang);
			$("#hasilKawinSilang").empty();
			for(row = 0; row < populasi_kawin_silang.length; row++){
				$("#hasilKawinSilang").append("<tr id=hks"+row+"></tr>");
			}

			for(row = 0; row < populasi_kawin_silang.length; row++){
				for(col = 0; col < populasi_kawin_silang[row].length; col++){
					if(col == 5 || col == 6){
					}else{
						id = "#hasilKawinSilang #hks"+row;
						hasil = "<td>"+populasi_kawin_silang[row][col]+"</td>";
						$(id).append(hasil);
					}
				}
			}

			$("#hasilKawinSilang").data(populasi_kawin_silang);
			$("#data-kawin-silang").trigger('click');
			$("#doKawinSilang").attr('disabled',true);
			$("#doMutasi").attr('disabled',false);
			
		});

		$("#doMutasi").on('click',function(){
			let populasi_mutasi = [], populasi_mutasi_generasi = [];
			let probabilitas_mutasi = 0, random_mutasi = 0, angka_mutasi = 0, biaya_maksimal = 0;
			let i, j, id, hasil, row, col;
			biaya_maksimal  = $("#hargamaks").val() / 10000;
			populasi_mutasi= $.map( $("#hasilKawinSilang").data(),function(value, index){
				return [value];
			});
			console.log(populasi_mutasi);
			probabilitas_mutasi = $("#probmutasi").val() / 100;
			for(i = 0; i < populasi_mutasi.length; i++){
				for(j = 0; j < populasi_mutasi[i].length - 2; j++){
					random_mutasi = Math.random();
					if(random_mutasi < probabilitas_mutasi){
						angka_mutasi = Math.floor((Math.random() * 10) + 1);
						populasi_mutasi[i][j] = angka_mutasi;
						console.log("mutasi");
						console.log(angka_mutasi);
						console.log(j);
					}
				}
			}
			console.log(populasi_mutasi);
			populasi_mutasi_generasi = regenerasi(populasi_mutasi, biaya_maksimal);
			console.log(populasi_mutasi_generasi);

			$("#hasilGenerasi").empty();
			for(i = 0; i < populasi_mutasi_generasi.length; i++){
				$("#hasilGenerasi").append("<tr id=hg"+i+"></tr>");
			}

			for(row = 0; row < populasi_mutasi_generasi.length; row++){
				for(col = 0; col < populasi_mutasi_generasi[row].length; col++){
					id = "#hasilGenerasi #hg"+row;
					hasil = "<td>"+populasi_mutasi_generasi[row][col]+"</td>";
					$(id).append(hasil);
				}
			}
			$("#hasilGenerasi").data(populasi_mutasi_generasi);
			$("#data-generasi").trigger('click');
			$("#doMutasi").attr('disabled',true);
			$("#doProbabilitas").attr("disabled",false);
			
		});
	});
	</script>
</body>
</html>