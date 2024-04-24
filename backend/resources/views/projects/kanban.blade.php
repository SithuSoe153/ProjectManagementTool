<x-layout>


    {{-- <div class="layout layout-nav-side"> --}}


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

            {{-- @php

                $projectId = $project->id;
                $kanbanBoardId = 1;

                $tasks = $project->kanbanBoards
                    ->first()
                    ->columns->flatMap(function ($column) {
                        return $column->tasks;
                    })
                    ->where('project_id', $projectId)
                    ->unique('id');
            @endphp

            dd($tasks); --}}


            {{-- @dd(
                $project->kanbanBoards->first()->columns->first()->tasks->where('project_id', $project->id)->unique('id')
            ); --}}

            <div class="kanban-board container-fluid mt-lg-3">

                @if ($project->kanbanBoards->isNotEmpty())
                    @foreach ($project->kanbanBoards->first()->columns as $column)
                        <div class="kanban-col">
                            <div class="card-list">
                                <div class="card-list-header">
                                    <h6>{{ $column->title }}</h6>
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

                                    @foreach ($column->tasks->where('project_id', $project->id)->unique('id') as $task)
                                        <div class="card card-kanban">
                                            <div class="card-body">
                                                <div class="dropdown card-options">
                                                    <button class="btn-options" type="button"
                                                        id="kanban-dropdown-button-10" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
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
                                                        <h6>{{ $task->title }}</h6>
                                                    </a>
                                                </div>

                                                <ul class="avatars mt-2">

                                                    @if (count($project->project_role_assignments) > 0)
                                                        @foreach ($task->users as $assignment)
                                                            <li>

                                                                {{-- {{ optional($assignment)->user->name ?? 'No members assigned yet' }} --}}
                                                                <a href="#" data-toggle="tooltip" title="Kenny">
                                                                    <img alt="Kenny Tran" class="avatar"
                                                                        {{-- src="/storage/{{ optional($assignment)->user->photo ?? 'images/cat.jpg' }}" --}}
                                                                        src="{{ optional($assignment)->photo ? '/storage/' . optional($assignment)->photo : 'https://source.unsplash.com/random?' . $assignment->id }}"
                                                                        data-filter-by="alt" />
                                                                </a>



                                                            </li>
                                                        @endforeach
                                                    @else
                                                        No members assigned yet
                                                    @endif



                                                </ul>

                                                <div class="card-meta d-flex justify-content-between">

                                                    <span class="text-small">Due 12 days</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                @can('create_Task', App\Models\Task::class)
                                    <div class="card-list-footer">
                                        <button class="btn btn-link btn-sm text-small" data-toggle="modal"
                                            data-target="#task-add-modal">
                                            Add task
                                        </button>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    @endforeach
                @endif


                <form action="/project/{{ $project->id }}/task" method="POST" enctype="multipart/form-data"
                    class="modal fade" id="task-add-modal" tabindex="-1" aria-hidden="true">
                    @csrf

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Task</h5>
                                <button type="button" class="close btn btn-round" data-dismiss="modal"
                                    aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <!--end of modal head-->
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="project-add-details-tab" data-toggle="tab"
                                        href="#project-add-details" role="tab" aria-controls="project-add-details"
                                        aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="project-add-members-tab" data-toggle="tab"
                                        href="#project-add-members" role="tab" aria-controls="project-add-members"
                                        aria-selected="false">Members</a>
                                </li>
                            </ul>
                            <div class="modal-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                        <h6>General Details</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Name</label>
                                            <input class="form-control col" type="text" placeholder="Task name"
                                                name="title" value="{{ old('title') }}" />

                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">Description</label>
                                            <textarea class="form-control col" rows="3" placeholder="Task description" name="description"></textarea>
                                        </div>
                                        <hr>


                                        <h6>Timeline</h6>
                                        {{-- <div class="form-group row align-items-center">
                                                <label class="col-3">Start Date</label>

                                                <input name="start_date" class="form-control col" type="text"
                                                    placeholder="Select a date" data-flatpickr value="{{ old('start_date') }}"
                                                    data-default-date="2021-04-21" data-alt-input="true" id="start_date" />


                                                <script>
                                                    // Initialize Flatpickr
                                                    flatpickr("#start_date", {
                                                        altInput: true,
                                                        altFormat: "F j, Y",
                                                        dateFormat: "Y/m/d",
                                                        defaultDate: "{{ old('start_date') ? old('start_date') : '2021-04-21' }}"
                                                    });
                                                </script>

                                                @error('start_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div> --}}
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Due Date</label>
                                            <input name="due_date" class="form-control col" type="text"
                                                placeholder="Select a date" data-flatpickr
                                                value="{{ old('due_date') }}" data-default-date="2021-09-15"
                                                data-alt-input="true" id="due_date" />


                                            <script>
                                                // Initialize Flatpickr
                                                flatpickr("#due_date", {
                                                    altInput: true,
                                                    altFormat: "F j, Y",
                                                    dateFormat: "Y/m/d",
                                                    defaultDate: "{{ old('due_date') ? old('due_date') : 'today' }}"
                                                });
                                            </script>

                                            @error('due_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="alert alert-warning text-small" role="alert">
                                            <span>You can change due dates at any time.</span>
                                        </div>

                                    </div>



                                    {{-- Mambers Start --}}
                                    <div class="tab-pane fade" id="project-add-members" role="tabpanel">
                                        <div class="users-manage" data-filter-list="form-group-users">

                                            <div class="form-group-users">



                                                @foreach ($project->project_role_assignments->unique('user_id') as $user)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="selected_users[]"
                                                            value="{{ $user->user->id }}"
                                                            class="custom-control-input" id="{{ $user->user->id }}">

                                                        <label class="custom-control-label"
                                                            for="{{ $user->user->id }}">
                                                            <span class="d-flex align-items-center">
                                                                <img alt="Claire Connors"
                                                                    src=" /storage/{{ optional($user)->photo ?: 'images/cat.jpg' }}"
                                                                    class="avatar mr-2" />

                                                                <span class="h6 mb-0"
                                                                    data-filter-by="text">{{ $user->user->name }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end of modal body-->
                            <div class="modal-footer">
                                <button role="button" class="btn btn-primary" type="submit">
                                    Create Task
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


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
                                                    <i class="material-icons">playlist_add_check</i>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="card-meta d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
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
                        <a class="btn btn-link btn-sm text-small" data-toggle="modal"
                            data-target="#board-add-modal">Add
                            Column</a>
                    </div>
                </div>

            </div>

        </div>




        <form action="{{ route('columns.store') }}" method="POST" enctype="multipart/form-data" class="modal fade"
            id="board-add-modal" tabindex="-1" aria-hidden="true">
            {{-- @method('POST') --}}
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Column</h5>
                        <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <!--end of modal head-->
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="project-add-details-tab" data-toggle="tab"
                                href="#project-add-details" role="tab" aria-controls="project-add-details"
                                aria-selected="true">Details</a>
                        </li>

                    </ul>

                    <div class="modal-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                <h6>General Details</h6>
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Name</label>
                                    <input class="form-control col" type="text" placeholder="Column name"
                                        name="title" value="{{ old('title') }}" />

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                            </div>

                        </div>
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                        <button role="button" class="btn btn-primary" type="submit">
                            Create Column
                        </button>
                    </div>
                </div>
            </div>
        </form>



        <!-- Required theme scripts (Do not remove) -->
        <script type="text/javascript" src="{{ asset('assets/js/theme.js') }}"></script>






</x-layout>
