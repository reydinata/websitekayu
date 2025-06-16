@extends('dashboard.template')
@section('content')
  <div>
                <h3 class="fw-bold mb-3">About Us</h3>
                    @if (session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
    @endif
   <a href="#modalCreate" data-bs-toggle="modal" class="btn btn-info {{ count($about) > 0 ? 'd-none' : '' }}">Lets Make a First Foundation</a>
              </div>
     <div class="container mt-5">
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Vision</th>
                        <th>Mission</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       @if(count($about) > 0)
       @foreach($about as $a)
          <tr id="tr_{{$a->id}}">
             <td>{{$a->id}}</td>
             <td>{{$a->visi}}</td>
             <td>{{$a->misi}}</td>
             <td>{{$a->deskripsi}}</td>
             <td>{{$a->created_at}}</td>
             <td>{{$a->updated_at}}</td>
             <td><a href="#modalEdit" onclick="getEditForm({{$a->id}})" data-bs-toggle="modal" class="btn btn-warning btn-xs"
                >ubah</a></td>

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
   url:'{{route("about.getEditForm")}}',
   data:{'_token':'<?php echo csrf_token()?>'
   ,'id':id},
   success: function(data){
   $('#modalContent').html(data.msg)
   }
   });
   }
</script>
@endsection
