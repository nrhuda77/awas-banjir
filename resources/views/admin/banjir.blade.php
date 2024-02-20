@extends('admin.layout.template')

@section('style')
<link href="{{asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/tools/dist/css/jquery-confirm.min.css')}}">
<link rel="stylesheet" href="{{asset('/tools/dist/css/lobibox.min.css')}}">
<style>
  table#dataTable {
    width: -webkit-fill-available !important;
  }
</style>
@endsection


@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Banjir</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Banjir</li>
    </ol>
  </div>






  <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Area Chart</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Data Table</a>
    </li>
  </ul>



  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <!-- area chart -->
      <div class="row mb-3">
        <div class="col-xl-12 col-lg-12 mb-4">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
            </div>
            <div class="card-body">
              <div>
                <label for="periode">Pilih Periode:</label>
                <select id="periode" class="btn btn-primary" onchange="loadData()">
                  <option value="semua_waktu">Semua Waktu</option>
                  <option value="tahun_ini">Tahun Ini</option>
                  <option value="bulan_ini">Bulan Ini</option>
                </select>
              </div>
              <div class="chart-area">
                <canvas id="myAreaChart" width="2256" height="640" style="display: block; height: 320px; width: 1128px;" class="chartjs-render-monitor"></canvas>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <!-- end Area Chart -->
    </div>

    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Influencer</h6>
            </div>
            <div class="table-responsive p-3">
              <table class="table align-items-center table-flush table-hover" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>Tanggal</th>
                    <th>Tinggi</th>
                    <th>Waktu</th>
                    <th>WA</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Row-->

  <!-- End Content -->

  <!---Container Fluid-->




  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Extra Large Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <form action="#" id="form" class="form-horizontal" method="POST">
            <input type="hidden" value="" name="id" id="id" />

            <div class="form-group row">
              <label class="col-sm-3 control-label">Influencer Name</label>
              <div class="col-md-7">
                <input name="nama" type="text" class="form-control" id="nama" value="">
                <span class="help-block text-danger"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Whats App</label>
              <div class="col-md-7">
                <input name="no_wa" type="text" class="form-control" id="no_wa" value="">
                <span class="help-block text-danger"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Pekerjaan</label>
              <div class="col-md-7">
                <input name="pekerjaan" type="text" class="form-control" id="pekerjaan" value="">
                <span class="help-block text-danger"></span>
              </div>
            </div>
          </form>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  @endsection

  @section('script')

  <script>
    var myChart; // Simpan referensi ke instance chart

    function loadData() {
      var periode = document.getElementById("periode").value;
      $.ajax({
        url: "{{ url('banjir-data') }}",
        method: "GET",
        data: {
          periode: periode
        },
        success: function(response) {
          // Periksa apakah chart sudah ada, jika ya, hapus
          if (myChart) {
            myChart.destroy();
          }
          updateChart(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error fetching chart data:', errorThrown);
        }
      });
    }

    function updateChart(data) {
      var labels = data.map(function(item) {
        return item.tanggal_banjir;
      });

      var tinggi = data.map(function(item) {
        return item.height;
      });

      var durasi = data.map(function(item) {
        return calculateDuration(item.awal_banjir, item.akhir_banjir);
      });


      var ctx = document.getElementById('myAreaChart').getContext('2d');
      myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
              label: 'Tinggi Banjir',
              data: tinggi,
              lineTension: 0.3,
              backgroundColor: "rgba(110, 231, 255, 0.2)",
              borderColor: "rgba(0, 145, 255, 1)",
              pointRadius: 3,
              pointBackgroundColor: "rgba(0, 145, 255, 1)",
              pointBorderColor: "rgba(0, 145, 255, 1)",
              pointHoverRadius: 3,
              pointHoverBackgroundColor: "rgba(0, 145, 255, 1)",
              pointHoverBorderColor: "rgba(0, 145, 255, 1)",
              pointHitRadius: 10,
              pointBorderWidth: 2,
            },
            {
              label: 'Durasi Banjir (Menit)',
              data: durasi,
              lineTension: 0.3,
              backgroundColor: "rgba(255, 99, 132, 0.2)",
              borderColor: "rgba(255, 99, 132, 1)",
              pointRadius: 3,
              pointBackgroundColor: "rgba(255, 99, 132, 1)",
              pointBorderColor: "rgba(255, 99, 132, 1)",
              pointHoverRadius: 3,
              pointHoverBackgroundColor: "rgba(255, 99, 132, 1)",
              pointHoverBorderColor: "rgba(255, 99, 132, 1)",
              pointHitRadius: 10,
              pointBorderWidth: 2,
            }
          ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                if (tooltipItem.datasetIndex === 0) {
                  return datasetLabel + ' ' + tooltipItem.yLabel + 'cm';
                } else {
                  return datasetLabel + ' ' + tooltipItem.yLabel + ' menit';
                }
              }
            }
          }
        }
      });
    }


    function calculateDuration(startDate, endDate) {
      var startTime = Date.parse(startDate);
      var endTime = Date.parse(endDate);
      var durationInMilliseconds = endTime - startTime;
      var durationInMinutes = durationInMilliseconds / 60000;
      return durationInMinutes;
    }

    window.onload = loadData;
  </script>

  <!-- Page level plugins -->
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('tools/dist/js/jquery-confirm.min.js')}}"></script>
  <script src="{{asset('tools/dist/js/lobibox.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script>
    var table = null;
    $(document).ready(function() {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      table = $('#dataTable').DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        "ordering": true, // Set true agar bisa di sorting
        "order": [
          [0, 'desc']
        ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
        "ajax": {
          "url": "{{url('get-banjir')}}", // URL file untuk proses select datanya
          "type": "POST",
          "data": {
            "_token": csrfToken // Menyertakan CSRF token di sini
          }
        },
        "deferRender": true,
        "aLengthMenu": [
          [10, 25, 50],
          [10, 25, 50]
        ], // Combobox Limit
        "columns": [{
            "data": "tanggal_banjir"
          }, // Tampilkan kolom nama_kategori pada table kategori
          {
            "data": "height"
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": null,
            "render": function(data, type, row, meta) {
              return calculateDuration(row.awal_banjir, row.akhir_banjir) + " menit";
            }
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": null,
            "render": function(data, type, row, meta) {
              return row.wa == 1 ? "Terkirim" : "Belum Terkirim";
            }
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": null,
            "render": function(data, type, row, meta) {
              return row.status == 1 ? "Selesai" : "Belum Selesai";
            }
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": "id_banjir", // Tampilkan kolomid_kategori pada table kategori
            "render": function(data, type, row, meta) {
              return '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view(' +
                data + ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>' + ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus(' + data + ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }
          },
        ],
      });
    });


    function view(id) {
      save_method = 'update';

      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block text-danger').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        url: "{{url('banjir').'/'}}" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="id"]').val(data.id_influencer);
          $('[name="nama"]').val(data.nama);
          $('[name="no_wa"]').val(data.no_wa);
          $('[name="pekerjaan"]').val(data.pekerjaan);
          $('#modal-lg').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit Influencer'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }
  </script>
  @endsection