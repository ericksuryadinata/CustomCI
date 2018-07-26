<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shuffle Me !</title>

	<link rel="stylesheet" href="<?php echo ROOTPATH.'assets/vendor/bootstrap/css/bootstrap.min.css'?>">
</head>
<body>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12">
			<h1>Shuffle Soal Ujian Praktikum Web</h1>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					Daftar Mahasiswa
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Jumlah Mahasiswa</label>
						<input type="text" class="form-control form-control-sm" placeholder="Jumlah Mahasiswa" id="jumlah-mahasiswa">
					</div>
					<button class="btn btn-primary" type="button" id="create-mahasiswa">Buat List Mahasiswa</button>
				</div>
				<div class="card-footer list-mahasiswa">
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					Hasil Shuffle
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>NBI</td>
								<td>SOAL</td>
							</tr>
						</thead>
						<tbody id="hasil-shuffle">
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					List Soal
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Jumlah Soal</label>
						<input type="text" class="form-control form-control-sm" placeholder="Jumlah Soal" id="jumlah-soal">
					</div>
					<button class="btn btn-primary" type="button" id="create-soal">Shuffle Soal</button>
				</div>
				<div class="card-footer">
					<ul class="list-soal"></ul>
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

	function shuffleSoal(array){

		let currentIndex = array.length, temporaryValue, randomIndex;

		// While there remain elements to shuffle...
		while (0 !== currentIndex) {

			// Pick a remaining element...
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;

			// And swap it with the current element.
			temporaryValue = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex] = temporaryValue;
		}

		return array;
	}

	function createNumber(data){
		let array = [];
		for (let index = 1; index <= data; index++) {
			array.push(index);
		}
		return array;
	}

	function listSoal(array){
		let listSoal = $('.list-soal');
		listSoal.empty();
		for (let index = 0; index < array.length; index++) {
			listSoal.append('<li>DB_POS_'+array[index]+'_UJIAN</li>');
		}
	}

	function createMahasiswa(data){
		let html = '';
		let wrapper = $('.list-mahasiswa');
		wrapper.empty();
		for (let index = 1; index <= data; index++) {
			html = '<div class="form-group">';
			html += '<input type="text" class="form-control form-control-sm mahasiswa-list" placeholder="Mahasiswa Ke - '+index+'" id="mahasiswa-'+index+'">';
			html += '</div>';
			wrapper.append(html);	
		}
		wrapper.append('<button class="btn btn-primary" type="button" id="shuffle-all">Acak Soal dan Mahasiswa</button>');
	}


	$(document).ready(function () {
		$("#jumlah-mahasiswa").on('keyup keypress', function (e) {
			var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
				let data = $(this).val();
				createMahasiswa(data);
            }
		});

		$("#create-mahasiswa").on('click', function () {
			let data = $("#jumlah-mahasiswa").val();
			createMahasiswa(data);
		});

		$("#jumlah-soal").on('keyup keypress', function (e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) { 
				let data = $(this).val();
				listSoal(shuffleSoal(createNumber(data)));
            }
		});

		$("#create-soal").on('click', function () {
			let data = $("#jumlah-soal").val();
			listSoal(shuffleSoal(createNumber(data)));
		});

		$(".list-mahasiswa").on('click','#shuffle-all',function () {
			let wrapperHasilShuffle = $('#hasil-shuffle');
			wrapperHasilShuffle.empty();
			let listSoalGet = [], listMahasiswaGet = [], htmlHasil = '', soalMahasiswa = [] ;
			const listItems = document.querySelectorAll('.list-soal li');
			
			for (let i = 0; i < listItems.length; i++) {
				listSoalGet.push(listItems[i].textContent);
			}

			$('.form-group .mahasiswa-list').each(function () {  
				listMahasiswaGet.push($(this).val());
			});

			soalMahasiswa = shuffleSoal(listSoalGet);

			for (let index = 0; index < listMahasiswaGet.length; index++) {
				htmlHasil += '<tr>';
				htmlHasil += '<td>'+listMahasiswaGet[index]+'</td>';
				htmlHasil += '<td>'+soalMahasiswa[index]+'</td>';
				htmlHasil += '</tr>';
			
			}

			wrapperHasilShuffle.append(htmlHasil);
		});
	});
</script>
</body>
</html>
