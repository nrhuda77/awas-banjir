@extends('admin.layout.template')

@section('style')

<style>
  .card-cuaca {
    width: 100%;
    height: 250px;
    position: relative;
    padding: 20px;
    color: #fff;
    display: flex;
    border-radius: 20px 350px 20px 20px;
    flex-direction: column;
    justify-content: space-between;
  }

  .background {
    fill: #5936B4;
    /* Set the initial fill color */
    position: absolute;
    inset: 0;
    z-index: -1;
    transition: fill 1s ease;
    /* Add a transition effect */
  }

  .card-cuaca:hover .background {
    fill: #362A84;
    /* Change the fill color on hover */
  }

  .cloud {
    position: absolute;
    right: 0;
    top: -12px;
  }

  .cloud svg {
    height: 120px;
  }

  .card-cuaca .main-text {
    font-size: 48px;
    z-index: 2;
  }

  .card-cuaca .info {
    display: flex;
    font-size: 22px;
    justify-content: space-between;
  }

  .card-cuaca .info .text-gray {
    color: rgba(235, 235, 245, 0.60);
  }

  .card-cuaca .info .info-right {
    align-self: flex-end;
  }
</style>
@endsection
@section('content')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    @if($cuacaStatus == 'Hujan')
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card-cuaca" style="background: #362A84;">
        <div class="cloud">
          <img src="/weather/storm.svg" alt="">
        </div>
        <p class="main-text">{{ str_replace('&deg;', '°', $temperatur[0]) }}</p>
        <div class="info">
          <div class="info-left">
            <p class="text-gray">{{ str_replace('&nbsp;', ' ', $waktu[0]) }}</p>
            <p>Balikpapan, Indonesia</p>
          </div>
          <p class="info-right">{{$cuaca[0]}}</p>
        </div>
      </div>
    </div>
    @elseif($cuacaStatus == 'Berawan')
    <!-- berawan -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card-cuaca" style="background: #7D7C7C;">
        <div class="cloud">
          <img src="/weather/cloud.svg" alt="">
        </div>
        <p class="main-text">{{ str_replace('&deg;', '°', $temperatur[0]) }}</p>

        <div class="info">
          <div class="info-left">
            <p><i class="fas fa-tint"></i> {{str_replace('<i class="wi wi-raindrop"></i>', ' ', $air[0])}}</p>
            <p class="text-gray">{{ str_replace('&nbsp;', ' ', $waktu[0]) }}</p>
            <p>Balikpapan, Indonesia</p>
          </div>
          <p class="info-right">{{$cuaca[0]}}</p>
        </div>
      </div>
    </div>
    @else
    <!-- cerah -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card-cuaca" style="background: #7BD3EA;">
        <div class="cloud">
          <img src="/weather/sunny.svg" alt="">
        </div>
        <p class="main-text">{{ str_replace('&deg;', '°', $temperatur[0]) }}</p>
        <div class="info">
          <div class="info-left">
            <p class="text-gray">{{ str_replace('&nbsp;', ' ', $waktu[0]) }}</p>
            <p>Balikpapan, Indonesia</p>
          </div>
          <p class="info-right">{{$cuaca[0]}}</p>
        </div>
      </div>
    </div>
    @endif
  </div>
  <div class="row">



    <!-- Area Chart -->

    <!-- Invoice Example -->
    <div class="col-xl-12 col-lg-7 mb-4">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Harian</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas id="myAreaChart" width="2256" height="640" style="display: block; height: 320px; width: 1128px;" class="chartjs-render-monitor"></canvas>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <!-- Message From Customer-->
  </div>
  <!--Row-->

  <!-- End Content -->

  <!---Container Fluid-->

  @endsection

  @section('script')
  <script>
    $(document).ready(function() {
      // Membuat permintaan AJAX untuk mengambil data dari server
      $.ajax({
        url: "{{ url('harian') }}",
        type: "GET",
        dataType: "JSON",
        success: function(response) {
          renderAreaChart(response); // Menggunakan respons JSON yang diterima untuk menggambar grafik area
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error fetching earnings data:', errorThrown);
        }
      });
    });

    function renderAreaChart(data) {
      var ctx = document.getElementById("myAreaChart");
      var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: data.labels,
          datasets: [{
            label: "Tinggi",
            lineTension: 0.3,
            backgroundColor: "rgba(110, 231, 255, 0.5)",
            borderColor: "rgba(0, 145, 255, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(0, 145, 255, 1)",
            pointBorderColor: "rgba(0, 145, 255, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(0, 145, 255, 1)",
            pointHoverBorderColor: "rgba(0, 145, 255, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: data.values,
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 7
              }
            }],
            yAxes: [{
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return value;
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ' ' + tooltipItem.yLabel + 'cm';
              }
            }
          }
        }
      });
    }



    // $(document).ready(function() {
    //   $.ajax({
    //     url: '/balikpapan',
    //     type: 'GET',
    //     success: function(response) {
    //       console.log(response);
    //     },
    //     error: function(xhr, status, error) {
    //       console.error(xhr.responseText);
    //     }
    //   });
    // });
  </script>
  @endsection