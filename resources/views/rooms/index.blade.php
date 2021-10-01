@extends('layout.main')
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/cart.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('content')
  <div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
      <div class="container-fluid">
        <div class="navbar-wrapper">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <!-- End Navbar -->
    <div class="content">
      <a href="{{ url('/rooms/create')}}" class="btn btn-primary text-center"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>Add Rooms</a>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Rooms Table</h4>
                <p class="card-category"> Dashboard / Table Rooms</p>
              </div>
              {{-- {{ $fitur[0]['fitur1']}} --}}
              <div class="card-body">
                <div class="container">
                  @foreach ($content as $row)
                  <div class="cart-table">
                    <div class="row cart-row">
                      <div class="col-xs-12 col-md-2">
                        <img src="https://images.unsplash.com/photo-1517840901100-8179e982acb7?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80" width="100%">
</div>
<div class="col-md-3">
  <div class="product-articlenr">#{{ $row->id_kamar}}</div>
  <div class="product-name">{{$row->nama_kamar}} Room</div>
  <div class="product-options">
    <?php
      $data = explode(",", $row->fitur);  
    ?>
    @foreach ($data as $fitur)
    <span>&#x2713; {{ $fitur}}</span><br>
    @endforeach
  </div>
</div>
<div class="col-md-3 cart-actions">
  <div class="product-price-total">
    <p>Price</p>
    <p style="font-weight: 700">Rp. {{ number_format($row->price,0,',','.')}}</p>
  </div>
</div>
<div class="col">
  <div class="d-inline">
    <form action="{{ url('rooms/delete/' . $row->id_kamar)}}" style="padding: 0 !important;" method="POST">
      @csrf
      @method("delete")
      <button type="submit" data-toggle="tooltip" title="Delete" onclick="return confirm('Anda yakin akan menghapus kamar ini ?')" class="btn btn-danger btn-round" style="padding: :0 !important;">Hapus</button>
    </form>
  </div>
  </div>
</div>
</div><!-- cart-row-->
@endforeach

</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('sweetalert::alert')
@endsection
<script type="text/javascript">

</script>