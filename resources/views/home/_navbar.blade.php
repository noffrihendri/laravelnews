<!-- Navigation-->

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: #212529;">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img
                src="{{ asset('bootstrap-agency/assets/img/navbar-logo.svg') }} " alt="" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">

                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('') }}">About</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('') }}">Team</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('news') }}">News</a></li>


                <?php if (Auth::check()) { ?>
                <li class="nav-item"><a class="nav-link " href="{{ url('livecomment') }} ">Live Streaming</a></li>
                <div class="dropdown">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>

                <?php } else { ?>

                <li class="nav-item"><a class="nav-link " href="{{ url('login') }} ">login</a></li>

                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<script>
    // $('.dropdown').click(function(){
    //     $('.dropdown-menu').toggle();
    // });

</script>

@endsection