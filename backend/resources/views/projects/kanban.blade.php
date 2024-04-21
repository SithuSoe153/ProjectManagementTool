<x-layout>


    {{-- <div class="layout layout-nav-side"> --}}

    {{-- Bread Crumb --}}
    <div class="navbar bg-white breadcrumb-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/">Project</a></li>
                <li class="breadcrumb-item" aria-current="page">Kanban Board</li>
            </ol>
        </nav>



    </div>

    <div class="main-container">

        <div class="container-kanban">
            <div class="container-fluid page-header d-flex justify-content-between align-items-start">
                <div>
                    <h1>{{ $project->title }}</h1>
                    <p class="lead d-none d-md-block">
                        {{ $project->description }}
                    </p>
                </div>
                <div class="d-flex align-items-center">



                    <ul class="avatars mt-2">
                        @if (count($project->project_role_assignments) > 0)
                            @foreach ($project->project_role_assignments as $assignment)
                                <li>

                                    {{-- {{ optional($assignment)->user->name ?? 'No members assigned yet' }} --}}
                                    <a href="#" data-toggle="tooltip" title="Kenny">
                                        <img alt="Kenny Tran" class="avatar" {{-- src="/storage/{{ optional($assignment)->user->photo ?? 'images/default.jpg' }}" --}}
                                            src="{{ optional($assignment)->user->photo ? '/storage/' . optional($assignment)->user->photo : 'https://source.unsplash.com/random?' . $assignment->user->id }}"
                                            data-filter-by="alt" />
                                    </a>



                                </li>
                            @endforeach
                        @else
                            No members assigned yet
                        @endif
                    </ul>


                </div>
            </div>

            <div class="kanban-board container-fluid mt-lg-3">
                {{-- <div class="kanban-col">
                    <div class="card-list">
                        <div class="card-list-header">
                            <h6>TO DO</h6>
                            <div class="dropdown">
                                <button class="btn-options" type="button" id="cardlist-dropdown-button-1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item text-danger" href="#">Archive List</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-list-body">


                        </div>
                        <div class="card-list-footer">
                            <button class="btn btn-link btn-sm text-small">
                                Add task
                            </button>
                        </div>
                    </div>
                </div> --}}



                {{-- D1 --}}
                {{-- <div class="card card-kanban">
                                <div class="card-body">
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="kanban-dropdown-button-13"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Archive
                                                Card</a>
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <a href="#" data-toggle="modal" data-target="#task-modal">
                                            <h6>A/B testing</h6>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}


                {{-- D2 --}}
                {{-- <div class="card card-kanban">
                                <div class="card-body">
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="kanban-dropdown-button-14"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Archive
                                                Card</a>
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <a href="#" data-toggle="modal" data-target="#task-modal">
                                            <h6>Email template</h6>
                                        </a>
                                    </div>

                                    <ul class="avatars">
                                        <li>
                                            <a href="#" data-toggle="tooltip" title="David">
                                                <img alt="David Whittaker" class="avatar"
                                                    src="assets/img/avatar-male-4.jpg" />
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Ravi">
                                                <img alt="Ravi Singh" class="avatar"
                                                    src="assets/img/avatar-male-3.jpg" />
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="card-meta d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons">playlist_add_check</i>
                                            <span>-/-</span>
                                        </div>

                                        <span class="text-small">Unscheduled</span>
                                    </div>
                                </div>
                            </div> --}}


                {{-- D3 --}}
                {{-- <div class="card card-kanban">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 12%"
                                        aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="card-body">
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="kanban-dropdown-button-9"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Archive
                                                Card</a>
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <a href="#" data-toggle="modal" data-target="#task-modal">
                                            <h6>HTML / CSS templates</h6>
                                        </a>
                                    </div>

                                    <ul class="avatars">
                                        <li>
                                            <a href="#" data-toggle="tooltip" title="David">
                                                <img alt="David Whittaker" class="avatar"
                                                    src="assets/img/avatar-male-4.jpg" />
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Harry">
                                                <img alt="Harry Xai" class="avatar"
                                                    src="assets/img/avatar-male-2.jpg" />
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Claire">
                                                <img alt="Claire Connors" class="avatar"
                                                    src="assets/img/avatar-female-1.jpg" />
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="card-meta d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons">playlist_add_check</i>
                                            <span>1/8</span>
                                        </div>

                                        <span class="text-small">Due 10 days</span>
                                    </div>
                                </div>
                            </div> --}}

                {{-- D4 --}}
                {{-- <div class="card card-kanban">
                                <div class="card-body">
                                    <div class="dropdown card-options">
                                        <button class="btn-options" type="button" id="kanban-dropdown-button-10"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Archive
                                                Card</a>
                                        </div>
                                    </div>
                                    <div class="card-title">
                                        <a href="#" data-toggle="modal" data-target="#task-modal">
                                            <h6>Photography</h6>
                                        </a>
                                    </div>

                                    <ul class="avatars">
                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Kerri-Anne">
                                                <img alt="Kerri-Anne Banks" class="avatar"
                                                    src="assets/img/avatar-female-5.jpg" />
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" data-toggle="tooltip" title="Masimba">
                                                <img alt="Masimba Sibanda" class="avatar"
                                                    src="assets/img/avatar-male-5.jpg" />
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="card-meta d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons">playlist_add_check</i>
                                            <span>0/5</span>
                                        </div>

                                        <span class="text-small">Due 12 days</span>
                                    </div>
                                </div>
                            </div> --}}






                <div class="kanban-col">
                    <div class="card-list">
                        <button class="btn btn-link btn-sm text-small">Add list</button>
                    </div>
                </div>

            </div>

        </div>

        <!-- Required theme scripts (Do not remove) -->
        <script type="text/javascript" src="{{ asset('assets/js/theme.js') }}"></script>






</x-layout>
