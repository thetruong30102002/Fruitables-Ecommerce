<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        {{-- <img alt="image" class="img-circle" width="50px" height="50px" src="{{asset($auth->image)}}" /> --}}
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        {{-- <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{$auth->name}}</strong> --}}
                            </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            {{-- @if($auth->user_catelogue_id == 1) --}}
            <li class="active">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý sản phẩm</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="/category">Quản lý danh mục</a></li>
                    <li><a href="/product">Quản lý sản phẩm</a></li>
                </ul>
            </li>
            {{-- @endif --}}
            <li>
                <a href="/banner"><i class="fa fa-laptop"></i> <span class="nav-label">Quản lý Banner</span></a>
            </li>
            <li>
                <a href="/order"><i class="fa fa-laptop"></i> <span class="nav-label">Quản lý đơn hàng</span></a>
            </li>
            <li>
                <a href="/sale"><i class="fa fa-laptop"></i> <span class="nav-label">Quản lý khuyến mãi</span></a>
            </li>
            
            @if(Auth::user()->role == 2)
            <li>
                <a href="/sale"><i class="fa fa-laptop"></i> <span class="nav-label">Quản lý tài khoản</span></a>
            </li>
            @endif
        </ul>

    </div>
</nav>
