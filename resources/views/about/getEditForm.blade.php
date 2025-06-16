<form method="POST" action="{{route('about.update',$data->id)}}">
    @csrf
    @method("PUT")
<div class="form-group" >
    <label for="exampleInputEmail1">Visi Perusahaan</label>
    <textarea type="text" name="visi" class="form-control" id="nameProduct" aria-describedby="nameHelp" >{{$data->visi}}</textarea>
    <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Misi Perusahaan</label>
    <textarea type="text" name="misi" class="form-control" id="nameProduct" aria-describedby="nameHelp" >{{$data->misi}}</textarea>
    <small id="nameHelp" class="form-text text-muted">Please insert your data here.
        click enter to make a new line</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Deskripsi singkat perusahaan</label>
    <textarea name="desc" class="form-control" id="nameProduct" aria-describedby="nameHelp" >{{$data->deskripsi}}</textarea>
    <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
  </div>
</div>
</div>
</form>
