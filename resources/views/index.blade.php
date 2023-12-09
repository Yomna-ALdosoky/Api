{{-- @extends('welcome')
@section('content')

@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  {{-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> --}}
{{-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

</head>
<body>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">path</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($images as $image)
      <tr>
        <th scope="row">{{$image->id}}</th>
        {{-- <td>{{$image->path}}</td> --}}
        {{-- <td><img src="{{asset('imgs/users/pexels-burst-374897.jpg')}}"></td> --}}
        <td><img src="{{asset('imgs/' .$image->path)}}" width="150px" height="100px"></td>
        {{-- <td></td> --}}
      </tr>
      @endforeach

    </tbody>
  </table>
</body>
</html>