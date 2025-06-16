@extends('dashboard.template')
@section('content')
  <div>
                <h3 class="fw-bold mb-3">Products</h3>
                   @if (session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
    @endif
                  <a href="#modalCreate" data-bs-toggle="modal" class="btn btn-info">+ new product</a>
              </div>
     <div class="container mt-5">
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       @if(count($kayu) > 0)
       @foreach($kayu as $k)
         <tr id="tr_{{$k->id}}">
             <td>{{$k->id}}</td>
             <td>{{$k->nama_kayu}}</td>
             <td><img src="/images/products/{{$k->foto_kayu}}" style="width: 100px; height: 100px;"></td>
             <td>{{$k->deskripsi}}</td>
             <td>{{$k->jumlah_kayu}}</td>
             <td>{{$k->harga_kayu}}</td>
             <td>{{$k->created_at}}</td>
             <td>{{$k->updated_at}}</td>
           <td>
                                <a href="#modalEdit"
                                   data-bs-toggle="modal"
                                   onclick="getEditForm({{ $k->id }})"
                                   class="btn btn-warning btn-sm">
                                   Ubah
                                </a>
                            </td>
         </tr>
       @endforeach
     @else
       <tr>
         <td colspan="8" style="text-align: center">No data found.</td>
       </tr>
     @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function () {
        $('#datatablesSimple').DataTable();
    });
</script>

  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Kayu</label>
        <input type="text" name="namakayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Upload Gambar Kayu</label>
        <input type="file" name="imgkayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="input your file here">
        <small id="nameHelp" class="form-text text-muted">Please insert your image here.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Deskripsi Kayu</label>
        <input type="text" name="desckayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter desc">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Kayu</label>
        <input type="text" name="jumlahkayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">harga Kayu</label>
        <input type="number" name="hargakayu" class="form-control" id="nameProduct" aria-describedby="nameHelp" placeholder="Enter title">
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div>
      {{-- <div class="form-group">
        <label for="exampleInputEmail1">Name Of Admin</label>
        <input type="text" name="namaadmin" class="form-control" id="nameProduct" aria-describedby="nameHelp" readonly value="{{auth()->user()->id}}" >
        <small id="nameHelp" class="form-text text-muted">Please insert your data here.</small>
      </div> --}}
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
      </div>
    </div>
  </div>
   <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">
            </div>
        </div>
    </div>
</div>
<script>
  function getEditForm(id){
    $.ajax({
      type: 'POST',
      url: '{{ route("product.getEditForm") }}',
      data: {
        _token: '{{ csrf_token() }}',
        id: id
      },
      success: function(data){
        $('#modalContent').html(data.msg);
        // munculkan modal jika belum muncul
      },
      error: function(xhr){
        alert('Gagal mengambil data. Silakan coba lagi.');
        console.error(xhr.responseText);
      }
    });
  }
</script>

@endsection
