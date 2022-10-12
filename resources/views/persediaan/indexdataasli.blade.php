<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Barang Persediaan</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Barang Persediaan</h1>

        <div class="container">
            <button type="button" class="btn btn-success">+ Form Permintaan</button><br><br>
            <button type="button" class="btn btn-info">+ Form Kebutuhan</button><br><br>
          
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
                        <th scope="col">Edit</th>
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
                        <a href ="/persediaan/tampilbp/{{$value->id}}"><button type="button" class="btn btn-warning">Edit</button>
                        <a href ="#"><button type="button" class="btn btn-danger delete" data-id="{{$value->id}}"
                          data-nama="{{$value->nama_barang}}">Hapus</button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                {{ $datas->links() }}


                <div class="container">
                <a href='/persediaan/tambahbp'><button type="button" class="btn btn-primary">+ Barang</button>
                </a>
                </div>
              </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
    <script>
      $('.delete').click(function(){
        var bpid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama_barang');

        
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

</html>