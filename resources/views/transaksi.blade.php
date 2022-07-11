@extends('main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Transaksi </button>
  </div>
  <div class="container-fluid">
    <!-- Row -->
    <div class="row">
      @php($i = 1)
      @if(count($transaksi) > 0)
      <!-- Column -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div>
              <H2>Total Saldo = {{$saldo}}</H2>
            </div>
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis Transaksi</th>
                    <th>Kategory</th>
                    <th>Nominal</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                @foreach($transaksi as $item)
                <tbody>
                  <tr>
                    <td>{{$i++}}</td>
                    <td>@if($item->code == 1)
                      Pemasukan
                      @else
                      Pengeluaran
                      @endif
                    </td>
                    <td>{{$item->kategory}}</td>
                    <td>{{$item->nominal}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                      <a href="javascript:void(0)" class="btn btn-warning editTransaksi" data-id="{{ $item->id }}">EDIT</a>
                      <a href="javascript:void(0)" class="btn btn-danger deleteTransaksi" data-id="{{ $item->id }}">Hapus</a>
                    </td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Column -->
      @else
      <h2 class="font-weight-light mb-0">Data tidak tersedia, silahkan tambahkan data</h2>
      @endif
    </div>
    <!-- Row -->
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="mt-2">Pilih Jenis Kategory</h5>
        <select class="form-select" id="code" name="code" onchange="kategory(this)">
          <option selected>Choose...</option>
          <option value="1">Pemasukan</option>
          <option value="2">Pengeluaran</option>
        </select>
        <h5 class="mt-2">Pilih Kategory</h5>
        <select class="form-select" id="code1" name="code1">
        <option selected>Choose...</option>
        </select>
        <h5 class="mt-2">Nominal</h5>
        <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukan Nominal" aria-describedby="basic-addon1">
        <h5 class="mt-2">Deskripsi</h5>
        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" aria-describedby="basic-addon1">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="store()">Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editTransaksi" tabindex="-1" aria-labelledby="editTransaksiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTransaksiLabel">Edit Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" class="form-control" id="ide" name="ide">  
      <h5 class="mt-2">Pilih Jenis Kategory</h5>
        <select class="form-select" id="codee" name="codee">
          <option selected>Choose...</option>
          <option value="1">Pemasukan</option>
          <option value="2">Pengeluaran</option>
        </select>
        <h5 class="mt-2">Pilih Kategory</h5>
        <select class="form-select" id="code1e" name="code1e">
        </select>
        <h5 class="mt-2">Nominal</h5>
        <input type="text" class="form-control" id="nominale" name="nominale" placeholder="Masukan Nominal" aria-describedby="basic-addon1">
        <h5 class="mt-2">Deskripsi</h5>
        <input type="text" class="form-control" id="deskripsie" name="deskripsie" placeholder="Deskripsi" aria-describedby="basic-addon1">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnedit">EDIT</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function($) {

    $('body').on('click', '.editTransaksi', function() {
      var id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: "{{url('editTransaksi')}}",
        data: {
          'id': id,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function(res) {
          console.log(res)
          $('#editTransaksi').modal('show');
          $('#ide').val(res.id);
          $('#codee').val(res.code);
          $('#code1e').append($('<option>',{
							value : res.kategory,
							text : res.kategory,
						}));
          $('#deskripsie').val(res.description);
          $('#nominale').val(res.nominal);
        },
        error: function(data, textStatus, errorThrown) {
          console.log(data);

        }
      });

    });

    $('body').on('click', '#btnedit', function() {
      var id = $("#ide").val();
      var code = $("#codee").val();
      var kategory = $("#code1e").val();
      var nominal = $("#nominale").val();
      var deskripsi = $("#deskripsie").val();

      // console.log(code, nominal, deskripsi);
      $.ajax({
        type: "POST",
        url: "{{url('updateTransaksi')}}",
        data: {
          'id': id,
          'kategory': kategory,
          'nominal': nominal,
          'code': code,
          'description': deskripsi,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function(res) {
          alert("Berhasil Ubah Data");
          setTimeout(location.reload.bind(location), 500);
        },
        error: function(data, textStatus, errorThrown) {
          console.log(data);

        }
      });
    });

    $('body').on('click', '.deleteTransaksi', function() {
      var id = $(this).data('id');

      $.ajax({
        type: "POST",
        url: "{{url('deleteTransaksi')}}",
        data: {
          'id': id,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function(res) {
          alert("Berhasil Hapus Data");
          setTimeout(location.reload.bind(location), 100);
        },
        error: function(data, textStatus, errorThrown) {
          console.log(data);

        }
      });
    });

  });

  function store() {
    var code = $("#code").val();
    var kategory = $("#code1").val();
    var nominal = $("#nominal").val();
    var deskripsi = $("#deskripsi").val();

    // console.log(nominal, code, kategory,  deskripsi);
    $.ajax({
      type: "POST",
      url: "{{url('storetransaksi')}}",
      data: {
        'nominal': nominal,
        'code': code,
        'kategory': kategory,
        'deskripsi': deskripsi,
        _token: '{{csrf_token()}}',
      },
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        alert("Berhasil Tambah Data");
        setTimeout(location.reload.bind(location), 100);
      },
      error: function(data, textStatus, errorThrown) {
        console.log(data);

      }
    });
  }

  function kategory() {
    var x = document.getElementById("code").value;

    // console.log(x);
    $.ajax({
        type: "POST",
        url: "{{url('changeKategory')}}",
        data: {
          'code_kategory': x,
          _token: '{{csrf_token()}}',
        },
        dataType: 'json',
        success: function(res) {
          
          // $('#code1').append(res.nama);
          for (var i = 0; i < res.length; i++)
           {
            $("#code1").empty().append($('<option>',{
              value : res[i]['nama'],
              text : res[i]['nama'],
            }));
          }
        },
        error: function(data, textStatus, errorThrown) {
          console.log(data);

        }
      });
  }
</script>
@endsection