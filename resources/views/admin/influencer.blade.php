@extends('admin.layout.template')

@section('style')
<link href="{{asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/tools/dist/css/jquery-confirm.min.css')}}">
<link rel="stylesheet" href="{{asset('/tools/dist/css/lobibox.min.css')}}">
@endsection


@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Influencer</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <!-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> -->
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- Datatables -->

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Influencer</h6>
          <button class="btn btn-primary" onclick="add()">Tambah Data</button>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTable">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No WA</th>
                <th>Pekerjaan</th>
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
  <!--Row-->


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
          [0, 'asc']
        ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
        "ajax": {
          "url": "{{url('get-influencer')}}", // URL file untuk proses select datanya
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
            "data": "id_influencer",
            "render": function(data, type, full, meta) {
              return meta.row + 1;
            }
          }, {
            "data": "nama"
          }, // Tampilkan kolom nama_kategori pada table kategori
          {
            "data": "no_wa"
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": "pekerjaan"
          }, // Tampilkan kolom subkat pada table sub kategori
          {
            "data": "id_influencer", // Tampilkan kolomid_kategori pada table kategori
            "render": function(data, type, row, meta) {
              return '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit(' +
                data + ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>' + ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus(' + data + ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }
          },
        ],
      });
    });

    function add() {

      // alert("asd");
      save_method = 'add';

      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block text-danger').empty(); // clear error string
      $('#modal-lg').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Influencer'); // Set Title to Bootstrap modal title

    }

    function edit(id) {
      save_method = 'update';

      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block text-danger').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        url: "{{url('influencer').'/'}}" + id,
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

    function reload_table() {
      table.ajax.reload(null, false); //reload datatable ajax
    }

    function save() {
      $('#btnSave').text('Menyimpan...'); //change button text
      $('#btnSave').attr('disabled', true); //set button disable 
      var url;

      if (save_method == 'add') {
        url = "{{url('influencer')}}";
      } else {
        url = "{{url('influencer-update')}}"; // Update URL here
      }

      // ajax adding data to database

      var formData = new FormData($('#form')[0]);
      formData.append('_token', '{{ csrf_token() }}');

      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status) //if success close modal and reload ajax table
          {
            $('#modal-lg').modal('hide');
            reload_table();
            Lobibox.notify('success', {
              size: 'mini',
              msg: 'Data berhasil Disimpan'
            });
          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block text-danger class set text error string
            }
          }
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable 
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable 
        }
      });
    }

    function hapus(id) {
      $.confirm({
        title: 'Confirm!',
        content: 'Apakah anda yakin menghapus data ini ?',
        buttons: {
          confirm: function() {
            var formData = {
              "_token": "{{ csrf_token() }}"
            };
            $.ajax({
              url: "{{url('influencer').'/'}}" + id,
              data: formData,
              type: "DELETE",
              dataType: "JSON",
              success: function(data) {
                //if success reload ajax table
                reload_table();
                Lobibox.notify('success', {
                  size: 'mini',
                  msg: 'Data berhasil Dihapus'
                });
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
              }
            });
          },
          cancel: function() {

          }
        }
      });
    }
  </script>
  @endsection