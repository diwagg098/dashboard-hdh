@extends('layout.main')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<link rel="stylesheet" href="{{ asset('css/table.css')}}">
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-dt/css/jquery.dataTables.min.css')}}"> --}}

@section('content')
        <div class="main-panel" style="margin:0; padding:0;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Reservation Table</a>
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
                  <span class="notification">0</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
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
                  <a class="dropdown-item" href="#">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {{-- Content --}}
      <div class="content">          
<!-- 
  
  Radio version of tabs.

  Requirements:
  - not rely on specific IDs for CSS (the CSS shouldn't need to know specific IDs)
  - flexible for any number of unkown tabs [2-6]
  - accessible

  Caveats:
  - since these are checkboxes the tabs not tab-able, need to use arrow keys

  Also worth reading:
  http://simplyaccessible.com/article/danger-aria-tabs/
-->

<div class="tabset" style="width: 100%">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Reserv</label>

  
  <div class="tab-panels">
   <section id="rauchbier" class="tab-panel">
        <div class="row">
        <button class="btn btn-round" id="download" onclick="downloadexcel('allreserv_table')" style="background-color: #349148 !important; width: 20%;"><i class="material-icons">
file_download
</i> Download Excel</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #349148 !important; width: 20%;">
  Cari Tanggal
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Date Search</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" style="background-color: transparent !important;">x</button>
      </div>
      <form action="{{ url('/report/search')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="col-md-12">
            <input type="date" name="keyword" class="form-control" value="{{ date('Y-m-d')}}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>
    </div>
  </div>
  </div>
    <div class="table-responsive">
    <table class="table table-hover" id="example" border="1">
      <thead>
        <tr>
          <th class='active'>No</th>
          <th class='active'>For</th>
          <th class='success text-center'>Data Pengunjung</th>
          <th class='warning text-center'>Detail Pemesanan</th>
          <th class='warning text-center'>Detail Pembayaran</th>
          <th class="info">Tanggal Pemesanan</th>
          <th class="info">Status Pembayaran</th>
          <th class="info">#</th>
        </tr>
      </thead>
        <tbody>
          @foreach ($allreserv as $row)
          <tr>
            <td>{{ $loop->iteration}}</td>
              <td>
                <div style="width: 75px;">
                  {{ $row->for}}
                </div>
              </td>
              <td>
                <div class="main">
                    <div class="main2" style="width: 55px">Nama</div>
                    <div class="">:</div>  
                    <div class="main3">{{ $row->name}}</div><br>
                </div>
                <div class="main">
                  <div class="main2" style="width: 55px">Email</div>
                    <div>:</div>  
                    <div class="mani3" >{{ $row->email}}</div><br>
                  </div>
                  <div class="main">
                    <div class="main2" style="width: 55px">No. Hp</div>
                    <div>:</div>  
                    <div class="main3">{{ $row->telp}}</div><br>
                  </div>
                </td>
                <td>
                  <div class="main">
                    <div class="main2" style="width: 85px;">Tipe Kamar</div>
                    <div class="">:</div>  
                    <div class="main3">{{ $row->tipe_kamar}}</div><br>
                </div>
                <div class="main">
                  <div class="main2" style="width: 85px;">Checkin</div>
                    <div>:</div>  
                    <div class="mani3" >{{ date('D, d/m/Y', strtotime($row->checkin))}}</div><br>
                  </div>
                  <div class="main">
                    <div class="main2" style="width: 85px;">Checkout</div>
                    <div>:</div>  
                    <div class="main3">{{ date('D, d/m/Y', strtotime($row->checkout))}}</div><br>
                  </div>
                </td>
                <td>
                  <div class="main">
                    <div class="main2" style="width: 85px;">Pembayaran</div>
                    <div>:</div>  
                    <div class="main3">{{ $row->payment}}</div><br>
                  </div>
                  <div class="main">
                    <div class="main2" style="width: 85px;">Bayar</div>
                    <div>:</div>  
                    <div class="main3">Rp. {{ number_format($row->gross_amount,0,',','.')}}</div><br>
                  </div>
                  @if ($row->payment == 'bayar ditempat')
                  <div class="main">
                    <div class="main2" style="width: 85px;">Sub Total</div>
                    <div>:</div>  
                    <div class="main3">Rp. {{ number_format($row->sub_total,0,',','.')}}</div><br>
                  </div>
                  <div class="main">
                    <div class="main2" style="width: 85px;">Sisa</div>
                    <div>:</div>  
                    <div class="main3">Rp. {{ number_format($row->sub_total - $row->gross_amount,0,',','.')}}</div><br>
                  </div>
                  @endif
                </td>
                <td>{{ $row->transaction_time}}</td>
                @if ($row->status_code == '201')
                <td><span class="badge badge-primary">Menunggu Pembayaran</span></td>
                @else
                <td><span class="badge badge-success">PAID</span></td>
                @endif
                @if ($row->status_booking == 0)
                <form action="{{ url('report/checkin/' . $row->id_booking)}}" method="POST">
                  @csrf
                  <td><button class="btn btn-success" type="submit"><i class="material-icons">
check_circle
</i> Check-in</button></td>
                  </form>
                  @else
                  <td></td>
                  @endif
              </tr>
              @endforeach
        </tbody>
    </table>
  </div>
    </section>
    <table id="checkin_table" style="display:none;">
      <thead>
        <th>No</th>
        <th>Nama Pengunjung</th>
        <th>Email</th>
        <th>Telpon</th>
        <th>Tipe Kamar</th>
        <th>Checkin</th>
        <th>Checkout</th>
        <th>Total</th>
      </thead>
      <tbody>
        @foreach ($allreserv as $row)
        <tr>
          <td>{{ $loop->iteration}}</td>
          <td>{{ $row->name}}</td>
          <td>{{ $row->email}}</td>
          <td>0{{ $row->telp}}</td>
          <td>{{ $row->tipe_kamar}}</td>
          <td>{{ $row->checkin}}</td>
          <td>{{ $row->checkout}}</td>
          <td>{{ $row->sub_total}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
</div>
        </div>
      </div>
      {{-- End of Content --}}
        </div>
      </div>
    </div>
<script>
  $(document).ready(function() {
	//Only needed for the filename of export files.
	//Normally set in the title tag of your page.
	document.title='Reservasi Kamar';
	// DataTable initialisation
	$('#example').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": false,
			"columnDefs": [
				{ "orderable": false, "targets": 5 }
			],
			"buttons": [
				// 'print'
			]
		}
	);

  	$('#example2').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": false,
			"columnDefs": [
				{ "orderable": false, "targets": 5 }
			],
			"buttons": [
				// 'print'
			]
		}
	);
  	$('#example3').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": false,
			"columnDefs": [
				{ "orderable": false, "targets": 5 }
			],
			"buttons": [
				// 'print'
			]
		}
	);
  
});
</script>
<script>
  function getbulan() {
    const moonLanding = new Date('July 20, 69 00:20:18');

    var month = moonLanding.getMonth();
    var bulan = '';

    if(month == '0') {
      bulan = "Januari";
    }else if(month == '1'){
      bulan = "Februari";
    }else if(month == '2'){
      bulan = "Maret"
    }else if(month == '3'){
      bulan = "April"
    }else if(month == '4'){
      bulan = "Mei";
    }else if(month == '5'){
      bulan = "Juni";
    }else if(month == '6'){
      bulan = "Juli";
    }else if(month == '7'){
      bulan = "Agustus";
    }else if(month == '8'){
      bulan = "September";
    }else if(month == '9'){
      bulan = "Oktober"; 
    }else if(month == '10'){
      bulan = "November";
    }else if(month == '11'){
      bulan = "Desember";
    }


    return bulan;

  }
</script>
<script type="text/javascript">
  // window.onload = function () {
  //   var table = document.getElementById('checikin_table'),
  //   download = document.getElementById('download');

  //   download.addEventListener('click', function () {
  //     window.open('data:application/vnd.ms-excel,' + encodeURIComponent(table.outerHTML));
  //   });
  // }

</script>
<script>
  function downloadexcel(tableID) {
    var table = document.getElementById(tableID);
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent(table.outerHTML));
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection