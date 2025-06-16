@extends('dashboard.template')
@section('content')
<style>
.rating-box {
    max-width: 300px;
    padding: 20px;
    border: 1px solid #f8f8f8;
    font-family: sans-serif;
}
.rating-average {
    font-size: 48px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
}
.rating-bar {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    gap: 8px;
}
.rating-bar .stars {
    width: 40px;
    text-align: right;
    color: #f9c700;
}
.rating-bar .bar {
    flex: 1;
    background-color: #f1f1f1;
    border-radius: 5px;
    height: 8px;
    overflow: hidden;
}
.rating-bar .bar-inner {
    background-color: #00dbc3;
    height: 100%;
    width: 0%;
    transition: width 0.3s;

}


.rating-bar .count {
    width: 30px;
    text-align: left;
    font-size: 14px;
}
</style>

<div class="row">
    {{-- Chart Section --}}
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-chart-area me-1"></i> Penjualan per Hari</span>
                <form method="GET" class="d-flex gap-2">
                    <select name="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                        @for ($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            <div class="card-body">
                <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated at {{ now()->format('d F Y H:i') }}</div>
        </div>
    </div>

    {{-- Rating Section --}}
    <div class="col-md-4 ">
        <div class="card">
            <div class="card-header">
                <strong>Rating</strong>
            </div>
            <div class="card-body">
                <div class="rating-box">
                    <h4>Rating</h4>
                    <div class="rating-average">
                        {{ $average }} <span style="color: #f9c700;">★</span>
                    </div>
                    @for ($i = 5; $i >= 1; $i--)
                        @php
                            $percent = $total > 0 ? ($counts[$i] / $total) * 100 : 0;
                        @endphp
                        <div class="rating-bar">
                            <div class="stars">★ {{ $i }}</div>
                            <div class="bar"><div class="bar-inner" style="width: {{ $percent }}%;"></div></div>
                            <div class="count">{{ $counts[$i] }}</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
      <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-chart-bar me-1"></i> Top 3 Best-Selling Woods
      </div>
      <div class="card-body">
        <canvas id="myBarChart" width="100%" height="50"></canvas>
      </div>
      <div class="card-footer small text-muted">Updated {{ now()->format('F d, Y H:i') }}</div>
    </div>
  </div>
</div>
  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
 // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: "Jumlah Penjualan",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: @json($values),
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'day'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

</script>
<script>
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($topKayu->pluck('nama_kayu')) !!},
        datasets: [{
            label: "Jumlah Terjual",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: {!! json_encode($topKayu->pluck('total_terjual')) !!}
        }]
    },
    options: {
        scales: {
            xAxes: [{
                gridLines: { display: false },
                ticks: { maxTicksLimit: 6 }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    maxTicksLimit: 5
                },
                gridLines: { display: true }
            }]
        },
        legend: { display: false }
    }
});
</script>

@endsection
