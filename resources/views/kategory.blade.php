@extends('main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Kategory </button>
    </div>
    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            @php($i = 1)
            @if(count($kategory) > 0)
            <!-- Column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategory</th>
                                        <th>Keterangan</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach($kategory as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>@if($item->code_kategory == 1)
                                            Pemasukan
                                            @else
                                            Pengeluaran
                                            @endif
                                        </td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning editKategory" data-id="{{ $item->id }}">EDIT</a>
                                            <a href="javascript:void(0)" class="btn btn-danger deleteKategory" data-id="{{ $item->id }}">Hapus</a>
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

<!-- Modal Create-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mt-2">Pilih Tipe Kategory</h5>
                <select class="form-select" id="code" name="code">
                    <option selected>Choose...</option>
                    <option value="1">Pemasukan</option>
                    <option value="2">Pengeluaran</option>
                </select>
                <h5 class="mt-2">Keterangan</h5>
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan" aria-describedby="basic-addon1">
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
<div class="modal fade" id="editKategory" tabindex="-1" aria-labelledby="editKategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoryLabel">Edit Kategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="ide" name="ide">
                <h5 class="mt-2">Pilih Tipe Kategory</h5>
                <select class="form-select" id="codee" name="codee">
                    <option selected>Choose...</option>
                    <option value="1">Pemasukan</option>
                    <option value="2">Pengeluaran</option>
                </select>
                <h5 class="mt-2">Keterangan</h5>
                <input type="text" class="form-control" id="keterangane" name="keterangane" placeholder="Masukan Keterangan" aria-describedby="basic-addon1">
                <h5 class="mt-2">Deskripsi</h5>
                <input type="text" class="form-control" id="deskripsie" name="deskripsie" placeholder="Deskripsi" aria-describedby="basic-addon1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnedit">Edit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function($) {

        $('body').on('click', '.editKategory', function() {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{url('editKategory')}}",
                data: {
                    'id': id,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    $('#editKategory').modal('show');
                    $('#ide').val(res.id);
                    $('#keterangane').val(res.nama);
                    $('#deskripsie').val(res.description);
                    $('#codee').val(res.code_kategory);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);

                }
            });

        });

        $('body').on('click', '#btnedit', function() {
            var id = $("#ide").val();
            var code = $("#codee").val();
            var keterangan = $("#keterangane").val();
            var deskripsi = $("#deskripsie").val();

            // console.log(code, keterangan, deskripsi);
            $.ajax({
                type: "POST",
                url: "{{url('updateKategory')}}",
                data: {
                    'id': id,
                    'keterangan': keterangan,
                    'code': code,
                    'deskripsi': deskripsi,
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

        $('body').on('click', '.deleteKategory', function() {
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: "{{url('deleteKategory')}}",
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
        var keterangan = $("#keterangan").val();
        var deskripsi = $("#deskripsi").val();

        // console.log(keterangan, code, deskripsi);
        $.ajax({
            type: "POST",
            url: "{{url('storekategory')}}",
            data: {
                'keterangan': keterangan,
                'code': code,
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
</script>
@endsection