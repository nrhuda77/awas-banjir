@extends('admin.layout.template')

@section('content')


<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">WhatsApp</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
    </ol>
  </div>

  <!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">WhatsApp</h6>
          <div class="nav_add">
            <!-- <button type="submit" class="btn btn-primary" onclick="editLogo()">Logo</button> -->
            <button type="submit" class="btn btn-primary" onclick="save()">Save</button>
          </div>
        </div>
        <div class="card-body p-3">
          <form action="#" id="form" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{$whatsapp->id_umum}}" name="id">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <label for="description">Description</label>
                  <textarea name="description_wa" value="" id="description_wa" class="form-control" cols="30" rows="3">{{$whatsapp->description_wa}}</textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Content -->

  @endsection

  @section('script')
  <script>
    function save() {
      $('#btnSave').text('Menyimpan...'); //change button text
      $('#btnSave').attr('disabled', true); //set button disable 
      var url;


      url = "{{url('whatsapp')}}";
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
            $('#modal-lg-logo').modal('hide');
            // reload_table();
            save_method = '';
            Lobibox.notify('success', {
              size: 'mini',
              msg: 'Data berhasil Disimpan'
            });
          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
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
  </script>
  @endsection