<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('member/include/head') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
<style>
    table {
        border-bottom: 0px !important;
    }

    th,
    td {
        border-bottom: 0px !important;
    }
</style>


<body class="no-skin" id="body-saya">
    <div class="main-container" id="main-container" style="margin-top: 50px;">
        <div class="form-group">
            <div class="col-sm-12">
                <select id="bulan" class="form-control">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <select id="tahun" class="form-control">
                    <?php for ($i = 2020; $i < 2025; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <a id="btn_bulanan" class="btn btn-success btn-sm pull-right"><i class="fa fa-search">&nbsp;Tampilkan</i></a>
            </div>
        </div>
        <div style="margin-top: 50px; padding:20px; overflow-y: scroll">
            <table class="table dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Waktu Absensi Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Waktu Absensi Keluar</th>
                        <th>Telat</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div><!-- /.main-container -->

    <?php $this->load->view('member/include/scripts') ?>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.j"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.j"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $('.table').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        $('#btn_bulanan').click(function() {
            $('.dataTable tbody').empty();
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url('admin/report/getData') ?>',
                data: {
                    id: <?= $id ?>,
                    bulan: bulan,
                    tahun: tahun
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var i = 1;
                    $.each(data, function(key, value) {
                        var color = value.jam_mulai == "-" ? "#f0f0f0" : "";
                        $('.dataTable tbody').append('<tr style="background:' + color + '">' +
                            '<td>' + i + '</td>' +
                            '<td>' + value.hari + '</td>' +
                            '<td>' + value.tanggal + '</td>' +
                            '<td>' + value.jam_mulai + '</td>' +
                            '<td>' + value.absen_mulai + '</td>' +
                            '<td>' + value.jam_selesai + '</td>' +
                            '<td>' + value.absen_selesai + '</td>' +
                            '<td>' + value.telat + '</td>' +
                            '</tr>');
                        i++

                    });
                }
            });
        });
    </script>
</body>

</html>