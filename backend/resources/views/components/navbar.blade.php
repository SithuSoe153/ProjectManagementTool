<nav class="navbar" style="background-color: rgb(42, 57, 77)">
    <div class="container">
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
    </div>
</nav>
