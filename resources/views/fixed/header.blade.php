<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="{{asset('assets/theme/img/icon-deal.png')}}" alt="Icon" style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">Real Estate</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{route("home")}}" class="nav-item nav-link active">Home</a>
                <a href="{{route("properties.index")}}" class="nav-item nav-link">Properties</a>
                <a href="{{route("about")}}" class="nav-item nav-link">About Author</a>
                <a href="{{route("contact")}}" class="nav-item nav-link">Contact</a>
                @if(auth()->user())
                    <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link">Sign in</a>
                @endif
                @if (auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.index') }}" class="nav-item nav-link">Manager</a>
                @endif
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->
