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
           <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
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
</div>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{asset('adminview3/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('adminview3/assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('adminview3/assets/js/kaiadmin.min.js')}}"></script>

<script>
 $("#basic-datatables").DataTable({});
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
