@extends('layout.admin')
@push('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Daftar Barang Persediaan</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Barang Persediaan</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>

  <div class="container">
    <a href="/fp/fpindex" class="btn btn-success">Form Permintaan</button></a>&nbsp&nbsp
    <button type="button" class="btn btn-info">Form Kebutuhan</button><br><br>
  
    <div class="row g3 align-items-center">
     <div class="col-auto">
      <form action="/persediaan/index" method="GET">
        <input type="search" id="searchitem" name="search" class="form-control" aria-describedby="search" 
        placeholder="Search...">
      </form>
     </div>
    </div>
  
    <div class="row">
      <table class="table table-sm mt-2">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Satuan</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          @foreach ($datas as $index => $value)
            <tr>
              <td>{{$index + $datas->firstItem()}}</td>
              <td> {{$value->nama_barang}}</td>
              <td> {{$value->satuan}}</td>
              <td> {{$value->stok}}</td>
              <td>
                <a href="/persediaan/tampilbp/{{$value->id }}"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp&nbsp
                <a href="#"><i class="fas fa-trash-alt delete" data-id="{{$value->id}}"
                   data-nama="{{$value->nama_barang}}"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
        {{ $datas->links() }}

        <div class="container mb-3">
          <a href='/persediaan/tambahbp'><button type="button" class="btn btn-primary">+ Barang</button>
          </a>
        </div>
      </div>
    </div> 

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.delete').click(function(){
        var bpid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
          title: "Are you sure?",
          text: "Kamu akan menghapus data "+nama+"",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
          .then((willDelete) => {
              if (willDelete) {
                  window.location = "/persediaan/deletebp/"+bpid+""
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

</div>
@endsection 


