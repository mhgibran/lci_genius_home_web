<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a href="/home" class="navbar-brand">
                <small>
                    Element Apartment
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav">
                <li class="dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle white">
                        <span class="">
                            <i class="ace-icon fa fa-user"></i>
                            @if (Auth::check())
                            {{ Auth::user()->name }}
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="/change_password/{{ Auth::user()->id_user }}/edit">
                                <i class="fa fa-cog"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout')}}">
                                <i class="ace-icon fa fa-power-off"></i>
                                Log Out
                            </a>
                        </li>
                        @else
                        <li><a href="{{ route('login')}}"> Log in</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
