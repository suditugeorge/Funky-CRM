        <!--Double navigation-->
        <header>
            <!-- Sidebar navigation -->
            <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">
                <!-- Logo -->
                <li>
                    <div class="user-box">
                        @if (file_exists(public_path('images/users/'.$user->id.'.jpg')))
                            <img src="{{URL::asset('images/users/'.$user->id.'.jpg')}}" class="img-fluid rounded-circle">
                        @else
                            <img src="{{URL::asset('images/users/default.png')}}" class="img-fluid rounded-circle">
                        @endif
                        <p class="user text-center">{{$user->name}}</p>
                    </div>
                </li>
                <!--/. Logo -->
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="/dashboard" class="collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i> Profil</a>
                        
                        <li><a href="/users" class="collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Utilizatori</a>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-code"></i> Acțiuni<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="/add-funky" class="waves-effect">Adaugă funky</a>
                                    </li>
                                    <li><a href="/add-citizen" class="waves-effect">Adaugă cetățean</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--/. Side navigation links -->
                <div class="sidenav-bg mask-strong"></div>
            </ul>
            <!--/. Sidebar navigation -->
            <!-- Navbar -->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
                <!-- SideNav slide-out button -->
                <div class="float-left">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
                </div>
                <!-- Breadcrumb-->
                <div class="breadcrumb-dn mr-auto">
                    <p>Funky CRM</p>
                </div>
                <ul class="nav navbar-nav nav-flex-icons ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"><i class="fa fa-envelope"></i> <span class="hidden-sm-down">Contact</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge red">99</span> <i class="fa fa-bell"></i></a>
                        </a>
                        <div class="dropdown-menu header-notifications animated dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <ul>
                                <li><a href="#"><i class="fa fa-bullhorn" aria-hidden="true"></i> Your campaign is about to end <span class="float-right grey-text"><i class="fa fa-clock-o" aria-hidden="true"></i> 3 hours</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" type="button" aria-haspopup="true" aria-expanded="false" href="/logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </nav>
            <!-- /.Navbar -->
        </header>
        <!--/.Double navigation-->