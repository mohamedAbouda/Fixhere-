<header id="sidebar">
    <div class="l-sidebar" id="side">
        <div class="logo ">
            <div class="logo__txt ">
                <a href="#">
                    <img src="{{ asset('panel-assets/images/icons/01_icon.png') }}" class="img-responsive hamburger-toggle js-hamburger" />
                </a>
            </div>
        </div>
        <div class="l-sidebar__content">
            <nav class="c-menu js-menu">
                <ul class="u-list">
                    <li class="c-menu__item {{ (request()->route()->getName() === 'dashboard.index') ? 'is-active' : '' }}" data-toggle="tooltip" title="Dashboard">
                        <a href="{{ route('dashboard.index') }}">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-dashboard"></i>
                                <div class="c-menu-item__title">
                                    <span>Dashboard</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->hasRole('superadmin'))
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.admins') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Admins">
                        <a href="{{ route('dashboard.admins.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>Admins</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user() && Auth::user()->hasRole(['superadmin','admin']))
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.centers') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Centers">
                        <a href="{{ route('dashboard.centers.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-group"></i>
                                <div class="c-menu-item__title">
                                    <span>Centers</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.clients') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Clients">
                        <a href="{{ route('dashboard.clients.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-user"></i>
                                <div class="c-menu-item__title">
                                    <span>Clients</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.orders') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Orders">
                        <a href="{{ route('dashboard.orders.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-shopping-basket"></i>
                                <div class="c-menu-item__title">
                                    <span>Orders</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.agents') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Technical agents">
                        <a href="{{ route('dashboard.agents.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Technical agents</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.cities') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Cities">
                        <a href="{{ route('dashboard.cities.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Cities</span>
                                </div>
                            </div>
                        </a>
                    </li>
                      <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.services') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Services">
                        <a href="{{ route('dashboard.services.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Services</span>
                                </div>
                            </div>
                        </a>
                    </li>
                         <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.promo_codes') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Promo Codes">
                        <a href="{{ route('dashboard.promo_codes.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Promo Codes</span>
                                </div>
                            </div>
                        </a>
                    </li>
                           <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.regions') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Regions">
                        <a href="{{ route('dashboard.regions.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Regions</span>
                                </div>
                            </div>
                        </a>
                    </li>
                         <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.refers') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Refers">
                        <a href="{{ route('dashboard.refers.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-address-card-o"></i>
                                <div class="c-menu-item__title">
                                    <span>Refers</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->hasRole(['center']))
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.enquiries') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Enquiries">
                        <a href="{{ route('dashboard.enquiries.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-reply"></i>
                                <div class="c-menu-item__title">
                                    <span>Enquiries</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user() && Auth::user()->hasRole(['admin' ,'superadmin']))
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.chats') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Order chats">
                        <a href="{{ route('dashboard.chats.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-envelope"></i>
                                <div class="c-menu-item__title">
                                    <span>Order chats</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="c-menu__item has-submenu {{ strpos(request()->route()->getName() , 'dashboard.faqs') !== FALSE ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="FAQ">
                        <a href="{{ route('dashboard.faqs.index') }}" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-facebook-f"></i>
                                <div class="c-menu-item__title">
                                    <span>FAQ</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
