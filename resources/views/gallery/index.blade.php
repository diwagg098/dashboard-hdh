@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/card.css')}}">
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
    <div class="content">
        
        <div class="row">
            <a href="{{ url('gallery/create')}}" class="btn btn-primary ml-3"><i class="material-icons">
add_circle_outline
</i> Add Gallery</a>
        </div>
    <div class="row">
        @foreach ($content as $row)
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mt-2">
            <div class="hovereffect">
                <form action="{{ url('/gallery/delete/' . $row->upload_path)}}" method="POST" onsubmit="return confirm('Anda yakin akan menghapus foto ini ?')">
                    @csrf
                    <img class="img-responsive" src="{{ asset('images/gallery/' . $row->upload_path)}}" alt="" width="300">
            @method("delete")
            <div class="overlay">
                <button class="info" href="#">Hapus</button>
            </div>
        </form>
    </div>
</div>
 @endforeach
    </div>
    </div>
    <!-- End Navbar -->
            </div>
            {{-- data table --}}
        </div>
        </div>
    </div>


@endsection