<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <div class="logo pull-left">
                            <a href="{{URL::to('')}}"><img style="" src="{{ asset('Eshopper/images/home/logo4.jpg') }}" alt="" width="200" /></a>
                        </div>
                        <ul class="nav navbar-nav collapse navbar-collapse" style="margin-top: 150px">
                            <li><a href="{{URL::to('')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('homes.show_cart') }}">Gi??? h??ng</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Li??n h???</a></li>
                            <li><a href="{{ route('homes.show_cart') }}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="search_box pull-right" style=" width: 300px">
                        <form action="{{ url('/search_home') }}" autocomplete="off" method="get">
                            @csrf
                            <input  type="text" name="search" placeholder="T??m ki???m" id="keywords"/>
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                        </form>
                        <div id="search_ajax"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
