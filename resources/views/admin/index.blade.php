@extends('admin.layout.template')


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
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                <span>Since last years</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span>Since yesterday</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->

    <!-- Invoice Example -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
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
    <div class="col-xl-4 col-lg-5 ">
      <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
        </div>
        <div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                problem I've been having.</div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a href="#">
              <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
              </div>
              <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                ducimus qui blanditiis
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
            </a>
          </div>
          <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
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
  </script>
  @endsection