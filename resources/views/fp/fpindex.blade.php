@extends('layout.admin')
@push('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="content-wrapper">
        <!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <title>Form Permintaan Barang</title>
          </head>
          <body>
            <h1 class="text-center mb-4">Form Permintaan Barang</h1>

                <div class="container row-8">
                    <a href="/fp/tambahfp" class="btn btn-success mb-3" >+ Form Permintaan Barang</button></a>
                    <div class="row g3 align-items-center">
                      <div class="col-auto">
                       <form action="/fp/fpindex" method="GET">
                         <input type="search" id="searchitem" name="search" class="form-control" aria-describedby="search"
                         placeholder="Search...">
                       </form>
                      </div>
                     </div>

                    <div class="row">
                        <table class="table table-sm mt-2">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Fungsi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($dataFps as $fps)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fps->no_surat }}</td>
                                <td>{{ $fps->kf->fungsi }}</td>
                                <td>{{ $fps->tanggal }}</td>
                                @if ($fps->bp !== null)
                                  <td>{{ $fps->bp->nama_barang }}</td>
                                @else
                                  <td>Barang Kosong</td>
                                @endif
                                <td>{{ $fps->jumlah }}</td>
                                <td>
                                  <a href="tampilfp/{{$fps->id}}"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
                                  <a href="#"><i class="fas fa-trash-alt delete" datas-id="{{$fps->id}}"
                                    datas-nomor="{{$fps->no_surat}}"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                    </table>
                    {{-- @foreach ($dataFps->kf as $kf)
                      <p>{{ $kf }}</p>
                    @endforeach --}}
                    {{ $dataFps->links() }}
                </div>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

          </body>
            <script>
              $('.delete').click(function(){
                var fpsid = $(this).attr('datas-id');
                var nomor = $(this).attr('datas-nomor');

                swal({
                  title: "Are you sure?",
                  text: "Kamu akan menghapus data "+nomor+"",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                    .then((willDelete) => {
                    if (willDelete) {
                    window.location = "/fp/deletefp/"+fpsid+""
                    swal("Data Berhasil di Hapus", {
                      icon: "success",
                    });
                  } else {
                    swal("Data tidak di Hapus");
                  }
                });
              });
            </script>

        <script>
          @if (Session::has('success'))
          toastr.success("{{Session::get('success')}}")
          @endif
        </script>

        </html>
@endsection