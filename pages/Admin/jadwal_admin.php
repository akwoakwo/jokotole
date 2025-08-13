<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
$sql2 = "SELECT * FROM aktor WHERE role = 'Admin'";
$tampil2 = mysqli_query($koneksi, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jadwal</title>

    <link rel="stylesheet" href="../../dist/css/fullcalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../../dist/js/jquery.min.js"></script>
    <script src="../../dist/js/moment.min.js"></script>
    <script src="../../dist/js/fullcalendar.min.js"></script>
</head>

<body>
    <br>
    <div class="container" style="width: 900px;height:600px;">

        <div>
            <div id="calendar"></div>
            <button id="openModalButton" class="btn" style="margin-left: 56rem;margin-top: -88.6rem;height: 2rem;width:2rem;border:2px solid black;background-color:rgb(7, 169, 163);"><img src="../../dist/img/blackplus.png" alt="Ikon Kustom" style="height: 2rem;width:2rem;margin-top:-0.8rem;margin-left:-0.83rem"></button>


            <div id="eventModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Add">FORM TAMBAH JADWAL LATIHAN </h4>
                            <h4 class="modal-title" id="Edit">FORM EDIT JADWAL LATIHAN</h4>
                        </div>
                        <div class="modal-body">
                            <form id="eventForm">
                                <div class="form-group">
                                    <label for="Event_nama_latihan">Nama Latihan:</label>
                                    <input type="text" class="form-control" id="Event_nama_latihan" name="Event_nama_latihan">
                                </div>

                                <div class="form-group" id="Event_pel_id">
                                    <label for="Event_pelatih_id">Nama Pelatih:</label>
                                    <select class="form-select" aria-label="Default select example" id="Event_pelatih_id" name="Event_pelatih_id">
                                        <option selected>PILIH NAMA PELATIH</option>
                                        <?php
                                        while ($baris1 = mysqli_fetch_assoc($tampil2)) {
                                        ?>
                                            <option value="<?php echo $baris1["id_aktor"]; ?>"><?php echo $baris1["nama"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Event_jenis_latihan">Jenis Latihan:</label>
                                    <input type="text" class="form-control" id="Event_jenis_latihan" name="Event_jenis_latihan">
                                </div>
                                <div class="form-group">
                                    <label for="Event_deskripsi_latihan">Deskripsi Latihan:</label>
                                    <textarea class="form-control" id="Event_deskripsi_latihan" name="Event_deskripsi_latihan"></textarea>
                                </div>
                                <div class="form-group" hidden>
                                    <textarea class="form-control" id="Event_id_jadwal" name="Event_id_jadwal"></textarea>
                                </div>
                                <div class="form-group" hidden>
                                    <textarea class="form-control" id="event_pelatih_id" name="event_pelatih_id"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="eventStartDate">Date:</label>
                                    <input type="date" class="form-control eventStartPicker" id="eventStartDate" name="eventStartDate">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="closeModal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="saveEvent">Save</button>

                            <button type="button" style="display: none;" class="btn btn-primary" id="EditEvent">Edit</button>

                            <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        //Persiapa JQuery
        $(document).ready(function() {
            $('#openModalButton').click(function() {
                $('#eventModal').modal('show');
                $('#EditEvent').hide();
                $('#Edit').hide();
                $('#saveEvent').show();
                $('#Add').show();
                $('#Event_pel_id').show();
            });
            var calendar = $('#calendar').fullCalendar({
                //izinkan tabel bisa di edit
                editable: true,
                header: {
                    left: 'prev ,next ,today',
                    center: 'title',
                    right: 'month, agendaWeek ,agendaDay'
                },
                //tampilkan data dari DB
                events: "../tampil2.php",
                selectable: true,
                selectHelper: true,
                eventClick: function(event) {
                    // Handle event editing here
                    $('#eventModal').modal('show');
                    $('#EditEvent').show();
                    $('#Edit').show();
                    $('#saveEvent').hide();
                    $('#Add').hide();
                    $('#Event_pel_id').hide();
                    $('#Event_nama_latihan').val(event.nama_latihan);
                    $('#Event_jenis_latihan').val(event.title.split('Latihan : ')[1].split('\n')[0].trim());
                    $('#Event_nama_pelatih').val(event.title.split('Pelatih : ')[1].split('\n')[0].trim());
                    $('#Event_deskripsi_latihan').val(event.deskripsi_latihan);
                    $('#Event_id_jadwal').val(event.id_jadwal);
                    $('#event_pelatih_id').val(event.pelatih_id);
                    $('#eventStartDate').val(event.start.format('YYYY-MM-DD'));
                    // Attach the event ID to the save button to identify which event to update

                },
                eventDrop: function(event) {
                    var jadwal_latihan = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var id_jadwal = event.id_jadwal;
                    $.ajax({
                        url: "../update21.php",
                        type: "POST",
                        data: {
                            jadwal_latihan: jadwal_latihan,
                            id_jadwal: id_jadwal
                        },
                        success: function() {
                            $('#eventModal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            alert('Update sukses....!');
                        }
                    });


                }
            });
            $('#saveEvent').click(function() {
                var nama_latihan = $('#Event_nama_latihan').val();
                var pelatih_id = $('#Event_pelatih_id').val();
                var jenis_latihan = $('#Event_jenis_latihan').val();
                var deskripsi_latihan = $('#Event_deskripsi_latihan').val();
                var jadwal_latihan = $('#eventStartDate').val();
                $.ajax({
                    url: "../simpan2.php",
                    type: "POST",
                    data: {
                        nama_latihan: nama_latihan,
                        pelatih_id: pelatih_id,
                        jenis_latihan: jenis_latihan,
                        deskripsi_latihan: deskripsi_latihan,
                        jadwal_latihan: jadwal_latihan
                    },
                    success: function() {
                        $('#eventModal').modal('hide');
                        calendar.fullCalendar('refetchEvents');
                        alert('Simpan sukses....!');
                    }
                });
            });
            $('#EditEvent').click(function() {
                var id_jadwal = $('#Event_id_jadwal').val();
                var nama_latihan = $('#Event_nama_latihan').val();
                var jenis_latihan = $('#Event_jenis_latihan').val();
                var deskripsi_latihan = $('#Event_deskripsi_latihan').val();
                var jadwal_latihan = $('#eventStartDate').val();
                var pelatih_id = $('#event_pelatih_id').val();
                // If eventId exists, it's an edit operation
                $.ajax({
                    url: "../update2.php",
                    type: "POST",
                    data: {
                        id_jadwal: id_jadwal,
                        pelatih_id: pelatih_id,
                        nama_latihan: nama_latihan,
                        jenis_latihan: jenis_latihan,
                        deskripsi_latihan: deskripsi_latihan,
                        jadwal_latihan: jadwal_latihan
                    },
                    success: function() {
                        $('#eventModal').modal('hide');
                        calendar.fullCalendar('refetchEvents');
                        alert('Edit sukses....!');
                        location.reload();
                    }
                });
            });

            $('#deleteEvent').click(function() {
                var id_jadwal = $('#Event_id_jadwal').val();

                if (confirm('Apakah Anda yakin ingin menghapus peristiwa ini?')) {
                    $.ajax({
                        url: "../hapus.php", // Ganti dengan URL yang sesuai
                        type: "POST",
                        data: {
                            id_jadwal: id_jadwal
                        },
                        success: function() {
                            $('#eventModal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            alert('Hapus sukses....!');
                            location.reload();
                        }
                    });
                }
            });

            //event ketika ingin update jadwal dengan drag and drop

            $('#eventStartPicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            $('#eventEndPicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
        $('#closeModal').click(function() {
            $('#eventModal').modal('hide');
            location.reload();
        });
    </script>
</body>

</html>