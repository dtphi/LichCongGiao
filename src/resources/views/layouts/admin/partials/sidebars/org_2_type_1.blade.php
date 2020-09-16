<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="javascript:void(0);"><i class="fas fa-users"></i>ユーザー管理</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item"><a class="nav-link pl-4" href="{{route('admin.user.index')}}"><i class="fas fa-users"></i>ユーザー一覧</a></li>
                    <li class="nav-item"><a class="nav-link pl-4" href="{{route('admin.user.registry')}}"><i class="fas fa-users"></i>ユーザー新規作成</a></li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="javascript:void(0);"><i class="fas fa-info-circle"></i>お知らせ管理</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item"><a class="nav-link pl-4" href="{{route('admin.info.index')}}"><i class="fas fa-info-circle"></i>お知らせ一覧</a></li>
                    <li class="nav-item"><a class="nav-link pl-4" href="{{route('admin.info.registry')}}"><i class="fas fa-info-circle"></i>お知らせ新規作成</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('admin.version.index')}}"><i class="fas fa-list-ol"></i>バージョン管理</a></li>
        </ul>
    </nav><button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
