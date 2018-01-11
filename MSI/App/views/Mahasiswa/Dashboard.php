<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
  
    <section class="content-header">
        <h1>Daftar Praktikum</h1>
        <p>Tahun Ajaran 2017 / 2018</p>
        <ol class="breadcrumb">
            <li class="active">Dashboard</li>
        </ol>
    </section>
  
    <section class="content">
        <!-- content box -->
        <div class="box">
            <div class="box-body">
                <table id="dt-1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Praktikum</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- content box -->

        <!-- another content goes here-->
    </section>

</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="daftar_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 id="daftar_title" class="modal-title">Ambil Praktikum</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open('#','class="form-horizontal", id="form_daftar"');?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Praktikum</label>
                            <div class="col-md-10">
                                <input name="praktikum" id="praktikum" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input name="nama" id="nama" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">NBI</label>
                            <div class="col-md-10">
                                <input name="nbi" id="nbi" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Hari</label>
                            <div class="col-md-3">
                                <select class="form-control" id="hari" name="hari" required>
                                </select>
                                <span id="kapasitas" class="help-block"></span>
                            </div>
                            <label class="control-label col-md-1">Kelas</label>
                            <div class="col-md-2">
                                <input name="kelas" id="kelas" class="form-control" type="text" readonly>
                            </div>
                            <label class="control-label col-md-1">Jam</label>
                            <div class="col-md-3">
                                <input name="jam" id="jam" class="form-control" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="lihat_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 id="daftar_title" class="modal-title">Lihat Praktikum</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open('#','class="form-horizontal", id="form_lihat"');?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Praktikum</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="lnomorpraktikum"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Praktikum</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="lpraktikum"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="lnama"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NBI</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="lnbi"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Hari</label>
                            <div class="col-md-2">
                                <p class="p-reset" id="lhari"></p>
                            </div>
                            <label class="control-label col-md-1">Kelas</label>
                            <div class="col-md-2">
                                <p class="p-reset" id="lkelas"></p>
                            </div>
                            <label class="control-label col-md-1">Jam</label>
                            <div class="col-md-3">
                                <p class="p-reset" id="ljam"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status Validasi</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="lvalidasi"></p>
                            </div>
                        </div>
                        <div id="nvalid" class="form-group">
                            <label id="labelvalidasi"class="control-label col-md-3">Nomor Validasi</label>
                            <div class="col-md-9">
                                <p class="p-reset" id="nomorvalidasi"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
    let save_method, i, hari, pa,table, oid,resHari;
    $(document).ready(function(){
        table = $('#dt-1').DataTable({
            language:{
                processing:"memuat data ...",
            },
            processing: true,
            serverSide: true, 
            order: [], 
            ajax: {
                url: '<?php echo site_url('Mahasiswa/Dashboard/list_praktikum')?>',
                type: 'POST',
            },
            ordering: false,
            searching : false,
            paging : false,
            info : false,

        });

        $("#hari").on('change', function(e){
            e.preventDefault();
            var dataHari = $("#hari option:selected").val();
            if(dataHari.length == 0){
                $("#kelas").val('');
                $("#jam").val('');
            }else{
                $.each(hari, function(key,value){
                    if(key == dataHari){
                        $("#kelas").val(value[0]);
                        $("#jam").val(value[1]);
                    }
                });
            }
            var kelas = $("#kelas").val();
            var request = {'kelas': kelas};
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Mahasiswa/Dashboard/checkKapasitas')?>",
                data: request,
                dataType: "JSON",
                success: function (response) {
                    if(response === 'kosong'){
                        $("#kapasitas").text('');
                        $("#btnSave").attr('disabled',false);
                    }else if(response == 0){
                        $("#kapasitas").text('kelas penuh');
                        $("#btnSave").attr('disabled',true);
                    }else{
                        if(dataHari == resHari){
                            $("#kapasitas").text('pilihan tidak berubah');
                            $("#btnSave").attr('disabled',true);
                        }else{
                            $("#kapasitas").text('sisa kapasitas '+response);
                            $("#btnSave").attr('disabled',false);
                        }
                    }
                }
            });
        });

        $("#form_daftar").validate({
            rules:{
                hari: "required",
            },
            messages:{
                hari: "pilih hari",
            },
            submitHandler:function(form){
                var url;
                var get;
                $('#btnSave').text('saving...');
                $('#btnSave').attr('disabled',true);

                if(save_method == 'daftar') {
                    url = "<?php echo site_url('Mahasiswa/Dashboard/daftar_praktikum')?>";
                    get = $(form).serialize();
                } else {
                    url = "<?php echo site_url('Mahasiswa/Dashboard/update_praktikum')?>";
                    get = $(form).serialize() + "&val=" + oid;
                }
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: get,
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status)
                        {
                            $('#daftar_modal').modal('hide');
                            if(save_method == 'daftar'){
                                swal("Sukses", "Daftar Praktikum Sukses", "success");
                            }else{
                                swal("Sukses", "Edit Praktikum Sukses", "success");
                            }
                            refresh();
                        }
                        $('#btnSave').text('save');
                        $('#btnSave').attr('disabled',false);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Penambahan data gagal", "error");
                        $('#btnSave').text('save');
                        $('#btnSave').attr('disabled',false);
                    }
                });
            }
        });

        $("#form_validasi").validate({
            rules:{
                validasi: "required",
            },
            messages:{
                validasi: "Isikan nomor validasi yang valid",
            },
            submitHandler:function(form){
                var url;
                var get;
                $('#btnValidasi').text('saving...');
                $('#btnValidasi').attr('disabled',true);

                url = "<?php echo site_url('Mahasiswa/Dashboard/validasi_praktikum')?>";
                get = $(form).serialize()+"&val="+oid;
                $.ajax({
                    url : url,
                    type: "POST",
                    data: get,
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status){
                            $('#validasi_modal').modal('hide');
                            swal("Sukses", "Validasi Praktikum Sukses", "success");
                            refresh();
                        }else{
                            swal("Error", "Nomor validasi salah", "error");
                        }
                        $('#btnValidasi').text('save');
                        $('#btnValidasi').attr('disabled',false);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Validasi data gagal", "error");
                        $('#btnValidasi').text('save');
                        $('#btnValidasi').attr('disabled',false);
                    }
                });
            }
        });


    });

    function ambil_praktikum(praktikum){
        save_method = 'daftar';
        $('#form_daftar')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $("#hari").empty();
        $('[name="nama"]').empty();
        $('[name="nbi"]').empty();
        $('[name="praktikum"]').empty();
        $("#hari").append('<option value="" selected>-- Pilih Hari --</option>');
        var pesan = {'praktikum':praktikum};
        $.ajax({
            url : "<?php echo site_url('Mahasiswa/Dashboard/dataKHK')?>",
            type: "POST",
            dataType: "JSON",
            data: pesan,
            success: function(dt)
            {   
                $('[name="nama"]').val(dt.user[0]);
                $('[name="nbi"]').val(dt.user[1]);
                hari = dt.hari;
                prak = dt.praktikum;
                $.each(prak, function(key,value){
                    if(praktikum == value){
                        $('[name="praktikum"]').val(key);
                    }
                });
                $.each(hari, function(key){
                    $("#hari").append('<option value='+key+'>'+key+'</option>')
                });
                $('#daftar_modal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Error", "Error Mendapatkan Data Ajax", "error");
            }
        });
    }

    function edit_praktikum(id, praktikum){
        save_method = 'update';
        $('#form_daftar')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $("#hari").empty();
        $('[name="nama"]').empty();
        $('[name="nbi"]').empty();
        $('[name="praktikum"]').empty();
        $("#hari").append('<option value="" selected>-- Pilih Hari --</option>');
        var data = {'id' : id, 'praktikum' : praktikum };
        $.ajax({
            url : "<?php echo site_url('Mahasiswa/Dashboard/edit_praktikum')?>",
            type: "POST",
            dataType: "JSON",
            data : data,
            success: function (dt) {
                $('[name="praktikum"]').val(dt.result.id_praktikum);
                $('[name="nama"]').val(dt.result.nama);
                $('[name="nbi"]').val(dt.result.id_user);
                $('[name="jam"]').val(dt.result.jam);
                $('[name="kelas"]').val(dt.result.kelas);
                oid = dt.result.id_jadwal_praktikum;
                resHari = dt.result.hari;
                hari = dt.hari;
                $.each(hari, function(key){
                    if(dt.result.hari == key){
                        $("#hari").append('<option value='+key+' selected>'+key+'</option>');
                    }else{
                        $("#hari").append('<option value='+key+'>'+key+'</option>');
                    }
                    
                });
                $('#daftar_modal').modal('show');
                $('#daftar_title').text('Edit Praktikum');
            },
            error: function (jqXHR, textStatus, errorThrown){
                swal("Error", "Error Mendapatkan Data Ajax", "error");
            }
        });
    }

    function lihat_praktikum(id){
        $('#form_lihat')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $("#lhari").empty();
        $('#lnama').empty();
        $('#lnbi').empty();
        $('#lpraktikum').empty();
        var data = {'id' : id};
        $.ajax({
            url : "<?php echo site_url('Mahasiswa/Dashboard/lihat_praktikum')?>",
            type: "POST",
            dataType: "JSON",
            data : data,
            success: function (dt) {
                $('#lpraktikum').text(dt.result.id_praktikum);
                $('#lnomorpraktikum').text(dt.result.nomor_pendaftaran_praktikum);
                $('#lnama').text(dt.result.nama);
                $('#lnbi').text(dt.result.id_user);
                $('#lhari').text(dt.result.hari);
                $('#ljam').text(dt.result.jam);
                $('#lkelas').text(dt.result.kelas);
                if(dt.result.is_validasi === '0'){
                    $('#nvalid').show();
                    $('#nomorvalidasi').text(dt.result.nomor_validasi);
                    $('#lvalidasi').text('Belum Validasi');
                }else{
                    $('#nvalid').hide();
                    $('#lvalidasi').text('Sudah Validasi');
                }
                $('#lihat_modal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown){
                swal("Error", "Error Mendapatkan Data Ajax", "error");
            }
        });
    }

    function cetak_voucher(id){
        var data = {'id' : id};
        let cpraktikum, cnama, cnbi, chari,cjam,ckelas, cnomorvalid, cnomorpraktikum;
        $.ajax({
            url : "<?php echo site_url('Mahasiswa/Dashboard/lihat_praktikum')?>",
            type: "POST",
            dataType: "JSON",
            data : data,
            success: function (response) {
                cnomorpraktikum = response.result.nomor_pendaftaran_praktikum;
                cpraktikum = response.result.id_praktikum;
                cnama = response.result.nama;
                cnbi = response.result.id_user;
                chari = response.result.hari;
                cjam = response.result.jam;
                ckelas = response.result.kelas;
                cnomorvalid = response.result.nomor_validasi;
                var dd = {
                    content: [
                        {
                            text: ['Universitas 17 Agustus 1945\n','Fakultas Teknik\n','Program Studi Teknik Informatika\n'],
                            style: 'header',
                            alignment: 'center'
                        },
                        {
                            text: ['\n\nVoucher Pembayaran\n',cpraktikum+'\n\n'],
                            style: 'header',
                            bold: false,
                            alignment: 'center'
                        },
                        {
                            style : 'tableExample',
                            table:{
                                widths: ['*', 'auto', 'auto'],
				                headerRows: 2,
                                body:[
                                    [{text: 'Nomor Pendaftaran', style: 'tableHeader', alignment: 'center'}, {text: 'Data Mahasiswa', style: 'tableHeader', alignment: 'center'}, {text: 'Praktikum', style: 'tableHeader', alignment: 'center'}],
                                    [{text: cnomorpraktikum, alignment: 'center',margin:[0,20,0,20]},{text: cnama+'\n\n'+cnbi},{text: cpraktikum+'\n\n hari : '+chari+', kelas : '+ckelas+', jam : '+cjam}],
                                    [{text: 'Nomor Validasi', alignment: 'center',margin:[0,20,0,20]}, {colSpan: 2, text: cnomorvalid, margin:[0,20,0,20], alignment :'center'}],
                                ]
                            }
                        },
                    ],
                    styles: {
                        header: {
                            fontSize: 18,
                            bold: true,
                            alignment: 'justify'
                        },
                        isi: {
                            fontSize:12
                        },
                        tableExample: {
                            margin: [0, 5, 0, 15],
                            bold:false
                        },
                        tableHeader: {
                            bold: true,
                            fontSize: 13,
                            color: 'black'
                        }
                    }
                    
                }
                pdfMake.createPdf(dd).open();
            }
        });
        
    }

    function refresh(){
        table.ajax.reload();
    }
</script>