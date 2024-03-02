<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{asset('admin/img/logo/awas-banjir.png')}}">
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item {{Request::is('banjir') ? 'active' : ''}}">
        <a class="nav-link" href="/banjir">
            <i class="fas fa-fw fa-water"></i>
            <span>Banjir</span>
        </a>
    </li>
    <li class="nav-item {{Request::is('influencer') ? 'active' : ''}}">
        <a class="nav-link" href="/influencer">
            <i class="fas fa-fw fa-users"></i>
            <span>Influencer</span>
        </a>
    </li>
    <li class="nav-item {{Request::is('whatsapp') ? 'active' : ''}}">
        <a class="nav-link" href="/whatsapp">
            <i class="fab fa-fw fa-whatsapp"></i>
            <span>Whats App</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        More
    </div>
    <!-- <li class="nav-item">
        <a class="nav-link" href="/admin/user">
            <i class="fas fa-fw fa-cogs"></i>
            <span>User</span>
        </a>
    </li> -->


    <li class="nav-item">
        <form action="/logout" method="POST" class="" style="">
            @csrf
            <button type="submit" class="nav-link" style="border: none;">
                <i class="fas fa-sign-out-alt "></i>
                Logout
            </button>

        </form>
    </li>







</ul>