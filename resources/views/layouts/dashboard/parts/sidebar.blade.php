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
                    <li class="c-menu__item has-submenu {{ (request()->route()->getName() === 'dashboard.admins.index') ? 'is-active' : '' }} ? 'is-active' : '' }}" data-toggle="tooltip" title="Admins">
                        <a href="" style="text-decoration: none;">
                            <div class="c-menu__item__inner">
                                <i class="fa fa-binoculars"></i>
                                <div class="c-menu-item__title">
                                    <span>Admins</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
