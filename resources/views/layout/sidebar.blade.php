<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            VOTING</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['dashboard.*']) }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['cctv.*']) }}">
                <a href="{{ route('cctv.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">CCTV</span>
                </a>
            </li>
            {{-- <li class="nav-item {{ active_class(['voter.*']) }}">
                <a href="{{ route('voter.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Voter</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
