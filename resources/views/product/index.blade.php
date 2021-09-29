@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/card.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
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
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <a href="{{ url('products/create')}}" class="btn btn-primary ml-2"><i class="material-icons">
add_circle_outline
</i> Add Product</a>
          </div>
          <div class="container page-wrapper">
            <div class="page-inner">
              <div class="row row2">
                @foreach ($content as $row)
                <div class="el-wrapper">
                  <div class="box-up">
                    <img class="img" src="{{ asset('images/product/' . $row->foto)}}" alt="">
                    <div class="img-info">
                      <div class="info-inner">
                        <form action="{{ url('/products/delete/' . $row->product_id)}}" method="POST" onsubmit="return confirm('Anda akan menghapus product ini ?')" style="background: none">
                          @csrf
                          @method("delete")
                          <span class="p-name">{{ $row->nama_product}}</span>
                          <button class="btn-hapus" id="btn-hapus" style="display: none">HAPUS</button>
                        </form>
                      </div>
                      <div class="a-size">Status : <span class="size">{{ $row->status}}</span></div>
                    </div>
                  </div>

                  <div class="box-down">
                    <div class="h-bg">
                      <div class="h-bg-inner"></div>
                    </div>

                    <a class="cart" href="{{ url('products/edit/' . $row->product_id)}}">
                      <span class="price">Rp {{ number_format($row->harga,0,',','.')}}</span>
                      <span class="add-to-cart">
                        <span class="txt">EDIT PRODUCT</span><br>
                      </span>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
              </div>
            </div>
              </div>
              {{-- data table --}}
          </div>
          </div>
        </div>


@endsection

<script type="text/javascript">
  $(document).ready(function(){
    $('.body').hover(function(){
      $('.btn-hapus').css("display","none");
    });

    $('.page-inner').hover(function(){
      $('.btn-hapus').css("display","none");
    });
    $('.row2').hover(function(){
      $('.btn-hapus').css("display","none");
    });

    $('.img').hover(function(){
      $('.btn-hapus').css("display","")
      $('.btn-hapus').animate({
        left : '250px'
      });
    });
  });
</script>