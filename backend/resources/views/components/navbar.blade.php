{{-- <div class="container">
        <a class="navbar-brand" href="/">Project Management</a>
        <div class="d-flex">
            <a href="/" class="nav-link">Home</a>

            @if (auth()->check())
                @if (auth()->user()->roles->first()->id == 1)
                    <a href="/register" class="nav-link">Add New User</a>
                @endif
            @endif


            <a href="/user/tasks" class="nav-link">Assigned Task</a>


            @if (auth()->check())
                <a href="/profile/{{ auth()->user()->id }}/edit" class="nav-link">{{ auth()->user()->username }}
                    <img src=" /storage/{{ auth()->user()->photo ?: 'images/default.jpg' }}"
                        style="width: 25px; height: 25px" class="img-fluid">
                </a>
            @endif

            @if (!auth()->check())
                <a href="/login" class="nav-link">login</a>
                <a href="/register" class="nav-link">register</a>
            @else
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-link">logout</button>
                </form>
            @endif
        </div>
    </div> --}}


<div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="index.html">
        <img alt="Pipeline" src="{{ asset('assets/img/logo.svg') }}" />
    </a>


    <div class="d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
            aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-block d-lg-none ml-2">
            <div class="dropdown">
                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img alt="Image" src=" /storage/{{ auth()->user()->photo ?: 'images/default.jpg' }}"
                        class="avatar" />
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="nav-side-user.html" class="dropdown-item">Profile</a>
                    <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                    <a href="#" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
    </div>


    <div class="collapse navbar-collapse justify-content-between" id="navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>

            @if (auth()->check())
                @if (auth()->user()->roles->first()->id == 1)
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Add New User</a>
                    </li>
                @endif
            @endif

            <li class="nav-item">
                <a class="nav-link" href="#">Manage Users</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user/tasks">Assigned Task</a>
            </li>


            {{-- <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                aria-expanded="false" aria-haspopup="true" id="nav-dropdown-2">Pages</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="pages-app.html">App Pages</a>

                                <a class="dropdown-item" href="pages-utility.html">Utility Pages</a>

                                <a class="dropdown-item" href="pages-layouts.html">Layouts</a>
                            </div>
                        </div>
                    </li> --}}


        </ul>


        <div class="d-lg-flex align-items-center">
            {{-- <form class="form-inline my-lg-0 my-2">
                        <div class="input-group input-group-dark input-group-round">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">search</i>
                                </span>
                            </div>
                            <input type="search" class="form-control form-control-dark" placeholder="Search"
                                aria-label="Search app" />
                        </div>
                    </form> --}}

            {{-- <div class="dropdown mx-lg-2">
                        <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="newContentButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Team</a>
                            <a class="dropdown-item" href="#">Project</a>
                            <a class="dropdown-item" href="#">Task</a>
                        </div>
                    </div> --}}

            <ul class="navbar-nav">

                @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link">
                            {{ auth()->user()->username }}
                        </a>
                    </li>
                @endif

            </ul>

            @if (auth()->check())
                <div class="d-none d-lg-block">
                    <div class="dropdown">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img alt="Image" src=" /storage/{{ auth()->user()->photo ?: 'images/default.jpg' }}"
                                class="avatar" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/profile/{{ auth()->user()->id }}/edit" class="dropdown-item">Profile</a>
                            <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                            {{-- <a href="#" class="dropdown-item">Log Out</a> --}}

                            <div class="dropdown-divider"></div>
                            @if (!auth()->check())
                                <a href="/login" class="nav-link">login</a>
                                <a href="/register" class="nav-link">register</a>
                            @else
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">Log Out</button>
                                </form>
                            @endif


                        </div>
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>
