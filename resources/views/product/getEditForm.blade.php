<form method="POST" action="{{ route('product.update', $data->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="form-group">
    <label for="exampleInputEmail1">Nama Kayu</label>
    <input type="text" name="namakayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title" value="{{$data->nama_kayu}}">
    <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Upload Gambar Kayu</label>
    <input type="file" name="imgkayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="input your file here" value="{{$data->foto_kayu}}">
    <small id="nameHelp" class="form-text text-muted">Please insert your image here.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Dekripsi Kayu</label>
    <textarea name="desckayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter desc">{{$data->deskripsi}}</textarea>
    <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
  </div>
  <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Kayu</label>
        <input type="text" name="jumlahkayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title"  value="{{$data->jumlah_kayu}}">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">harga Kayu</label>
        <input type="number" name="hargakayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title" value="{{$data->harga_kayu}}">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
  <button type="submit"  class="btn btn-primary">Submit</button>
</form>
