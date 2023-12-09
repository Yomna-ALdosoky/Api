<form action="{{route('photo.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo"> <br><br>
    <button type="submit">submit</button> <br>

</form>