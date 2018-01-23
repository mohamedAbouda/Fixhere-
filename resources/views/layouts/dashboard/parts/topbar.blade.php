<header id="topbar">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="left-nav-bar-section">
                    <li>
                        <div class="input-group">
                            <span class="input-group-addon bg-transparent navbar-search-span"><i class="fa fa-search search-input"></i></span>
                            <input type="text" class="form-control navbar-input-search" placeholder="Type to Search...">
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right margin-top0">
                    <li class="margin-top10">
                        <a href="#"><i class="fa fa-clock-o"></i></a>
                    </li>
                    <li class="margin-top10">
                        <a href="#"><i class="fa fa-bell"></i><span class="notification-span">2</span></a>
                    </li>
                    <li class="dropdown pad0">
                        <a href="#" class="dropdown-toggle pad-bottom0 margin-top5" data-toggle="dropdown">
                            <span class="top-bar-username">{{ Auth::user() ? Auth::user()->name : 'Not logged in' }} </span>
                            <img scr="" src="{{ asset('panel-assets/images/profile-picutre/01_img.png') }}" class="navbar-profile-picture">
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li>
                                <a href="#">Action</a>
                            </li>
                            <li>
                                <a href="#">Another action</a>
                            </li>
                            <li>
                                <a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li> -->
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="fa fa-lock"></i>
                                  Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
