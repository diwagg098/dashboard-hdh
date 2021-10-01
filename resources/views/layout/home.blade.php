@extends('layout.main')

@section('content')
    <div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
            <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
                </button>
            </div>
            </form>
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                <i class="material-icons">dashboard</i>
                <p class="d-lg-none d-md-block">
                    Stats
                </p>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification">{{ $reservCount}}</span>
                <p class="d-lg-none d-md-block">
                    Some Actions
                </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    @if (!$reserv)
                        <a class="dropdown-item" href="#"></a>
                    @else
                    @foreach ($reserv as $reservv)
                    <a class="dropdown-item" href="{{ url('report')}}">Ada pesanan baru nih dari {{ $reservv->name}}</a>
                    @endforeach
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">person</i>
                <p class="d-lg-none d-md-block">
                    Account
                </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('/logout')}}">Log out</a>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                </div>
                <p class="card-category">Income</p>
                <h3 class="card-title">Rp. 1.500.000
                </h3>
                </div>
                <div class="card-footer">
                <div class="stats">
                    <p>Bulan Ini</p>
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">store</i>
                </div>
                <p class="card-category">Tamu hari ini</p>
                <h3 class="card-title">50</h3>
                </div>
                <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                </div>
                <p class="card-category">Pengunjung Website</p>
                <h3 class="card-title">{{ $datap}}</h3>
                </div>
                <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">local_offer</i> Hari ini
                                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card card-chart">
                <div class="card-header card-header"><h3>Data statistik reservasi bulan ini</h3>
                  <canvas id="myChart" width="200" height="74"></canvas>
                </div>
                <div class="card-body">
                  <p class="card-category">
                  </p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card card-chart">
                <div class="card-header card-header"><h3>Data statistik reservasi bulan ini</h3>
                  <canvas id="myChart2" width="200" height="74"></canvas>
                </div>
                <div class="card-body">
                  <p class="card-category">
                  </p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
           /* JS comes here */
    askForApproval({{$reservCount}});
    
    function askForApproval(reserv) {
        if(Notification.permission === "granted") {
            createNotification('HDH HOTEL', 'Hallo ada ' + reserv + ' reservasi nih baru masuk');
        }
        else {
            Notification.requestPermission(permission => {
                if(permission === 'granted') {
                    createNotification('Wow! This is great', 'created by @study.tonight', 'https://www.studytonight.com/css/resource.v2/icons/studytonight/st-icon-dark.png');
                }
            });
        }
    }
    
    function createNotification(title, text, icon) {
        const noti = new Notification(title, {
            body: text,
            icon
        });
    }
    </script>
       <script>
      var ctx = document.getElementById('myChart');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {{ json_encode($tgl)}},
            datasets: [{
                label: 'Reservasi Bulan Ini',
                data: {{ json_encode($chart)}},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    override: true,
                                stepValue: 5,
                                max: 50

                }
            }
        }
      });
      var ctx = document.getElementById('myChart2');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {{json_encode($tgl)}},
            datasets: [{
                label: 'Pengunjung Bulan Ini',
                data: {{json_encode($guest)}},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
           options: {
            scales: {
                y: {
                    beginAtZero: true,
                    override: true,
                                stepValue: 5,
                                max: 30

                }
            }
        }
      });
</script>
<script>
$(document).ready(function() {
    $("#container").load("home.blade.php");
    var refreshId = setInterval(function()
        {
            $("#container").load("home.blade.php");
        }, 1000);
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>

@endsection