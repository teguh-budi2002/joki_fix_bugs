@extends('layout.admin')

@section('content')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Barang Persediaan</title>
  </head>
  <body>
    <br>
    <h1 class="text-center mb-4 mt-5">Edit Barang Persediaan</h1>
    @if ($errors->any())
    <div class="col-md-6 mx-auto">
        <div class="bg-danger text-danger-50 rounded">
            @foreach ($errors->all() as $err)
            <ul>
                <li>{{ $err }}</li>
            </ul>
            @endforeach
        </div>
    </div>
    @endif
        <div class="container">

            <div class="row justify-content-center">
              <div class="col-8">
              <div class="card">
                <div class="card-body">
                  <form action="/persediaan/editbp/{{$data->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                      <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                      <input type="text" class="form-control" id="namabarang" name="nama_barang" aria-describedby="emailHelp" value="{{$data->nama_barang}}">
                    </div>
                    <div class="mb-2">
                      <label for="exampleInputEmail1" class="form-label">Satuan</label>
                      <input type="text" class="form-control" id="satuan" name="satuan" aria-describedby="emailHelp" value="{{$data->satuan}}">
                    </div>
                    <div class="mb-2">
                      <label for="exampleInputPassword1" class="form-label">Stok</label>
                      <input type="number" class="form-control" id="stok" name="stok" value="{{$data->stok}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
  </body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8">
        &nbsp&nbsp&nbsp&nbsp<a href='/persediaan/index'><button type="submit" class="btn btn-danger">back</button>
      </a>
      </div>
    </div>
  </div>
</html>
@endsection