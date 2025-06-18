@extends('dashboard.template')
@section('content')
  <div>
                <h3 class="fw-bold mb-3">Penjualan</h3>
                   {{-- @if (session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
    @endif --}}
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
                        <th>Id</th>
                        <th>Name Wood</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>proof of debt</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       @if(count($penjualans) > 0)
       @foreach($penjualans as $p)
         <tr >
             <td>{{$p->kode_penjualan}}</td>
             <td>{{$p->nama_kayu}}</td>
             <td>{{$p->jumlah_beli}}</td>
             <td>{{$p->harga_kayu}}</td>
             <td>{{$p->total}}</td>
             <td>{{$p->status}}</td>
             <td>
    @if($p->bukti_pembayaran)
        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
            data-bs-target="#buktiModal"
            onclick="showBukti('{{ asset('images/bukti/' . $p->bukti_pembayaran) }}')">
            Lihat Bukti
        </button>
    @else
        <span class="badge bg-warning text-dark">Belum Bayar</span>
    @endif
</td>
             <td>{{$p->created_at}}</td>
             <td>{{$p->updated_at}}</td>
             <td>
    @if($p->status === 'proses')
        <a href="{{ route('penjualan.updateStatus', $p->id) }}" class="btn btn-sm btn-success"
           onclick="return confirm('Yakin ingin menyelesaikan pesanan ini?')">
            Selesaikan
        </a>
    @else
        <span class="badge bg-success">Selesai</span>
    @endif
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
     </div>
<!-- Modal untuk Bukti Pembayaran -->
<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img id="buktiImage" src="" class="img-fluid rounded" alt="Bukti Pembayaran">
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
<script>
function showBukti(imageUrl) {
    document.getElementById('buktiImage').src = imageUrl;
}
</script>


   {{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
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
</script> --}}

@endsection
