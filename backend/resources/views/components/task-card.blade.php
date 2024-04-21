{{-- Task Section Start --}}

<div>

    <div class="row content-list-head">
        <div class="col-auto">
            <h3>Tasks</h3>


            @can('create_Task', App\Models\Task::class)
                {{-- <div class="mb-3"> --}}
                <button class="btn btn-round" data-toggle="modal" data-target="#task-add-modal">
                    <i class="material-icons">add</i>
                </button>
                {{-- </div> --}}
            </div>
        </div>


        {{-- Hidden Add Task form initially --}}
        {{-- <div id="taskForm" style="display: none;">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="/project/{{ $project->id }}/task" method="POST">
                        @csrf
                        <h5 class="card-title">Add Task</h5>
                        <div class="mb-3">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date">Due Date:</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
            <hr>
        </div> --}}

        {{-- New Hidden Add Task form initially --}}

        <div id="modal-container"></div>


        <form action="/project/{{ $project->id }}/task" method="POST" enctype="multipart/form-data" class="modal fade"
            id="task-add-modal" tabindex="-1" aria-hidden="true">
            @csrf

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Task</h5>
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
                        <li class="nav-item">
                            <a class="nav-link" id="project-add-members-tab" data-toggle="tab" href="#project-add-members"
                                role="tab" aria-controls="project-add-members" aria-selected="false">Members</a>
                        </li>
                    </ul>
                    <div class="modal-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                <h6>General Details</h6>
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Name</label>
                                    <input class="form-control col" type="text" placeholder="Task name" name="title"
                                        value="{{ old('title') }}" />

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
                                        placeholder="Select a date" data-flatpickr value="{{ old('due_date') }}"
                                        data-default-date="2021-09-15" data-alt-input="true" id="due_date" />


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
                                                <input type="checkbox" name="selected_users[]" value="{{ $user->user->id }}"
                                                    class="custom-control-input" id="{{ $user->user->id }}">

                                                <label class="custom-control-label" for="{{ $user->user->id }}">
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


    @endcan

    {{-- Tasks List --}}


    {{-- <ul class="list-group" @can('check_Task', $task) id="sortable" @endcan> --}}
    <ul class="list-group" id="sortable">
        @forelse ($tasks as $task)
            {{-- CheckBox and Text Title Start --}}
            <div class="card my-2">



                <div class="card-header ui-state-default" style="padding: 0;">

                    <div class="task-container" data-task-id="{{ $task->id }}">

                        <div class="content-list-body">
                            <form class="checklist">

                                <div class="custom-control custom-checkbox">

                                    <div class="card-body" style="padding-bottom: 0;">

                                        <input {{ $task->is_completed ? 'checked' : '' }} type="checkbox"
                                            id="task-{{ $task->id }}" class="task-checkbox custom-control-input"
                                            value="{{ $task->id }}"
                                            @cannot('check_Task', $task) disabled @endcannot />


                                        <label class="custom-control-label" for="task-{{ $task->id }}"></label>

                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="{{ $task->title }}" data-filter-by="value" />

                                            <div class="checklist-strikethrough"></div>

                                        </div>


                                        <h6><span style=" color: #888;"><small>Due Date:
                                                    {{ $task->due_date }}</small></span></h6>

                                        <div class="dropdown card-options">
                                            <button class="btn-options" type="button" id="project-dropdown-button-1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                @can('update_Task', $task)
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter{{ $task->id }}">
                                                        Edit
                                                    </button>
                                                @endcan



                                                <form action="/task/{{ $task->id }}/delete" method="POST"
                                                    hidden>
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm ms-2" hidden>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </button>
                                                </form>



                                                @can('delete_Task', $task)
                                                    <form action="/task/{{ $task->id }}/delete" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="dropdown-item text-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endcan


                                                </a>
                                            </div>
                                        </div>


                                        <ul class="avatars mt-2">



                                            {{-- @if (!$task->is_completed)
                                                @can('assign_Member', $task)
                                                    <x-btn-assign-member :project='$project' :task="$task" />
                                                @endcan
                                            @endif --}}


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

                                    </div>



                                    <br>



                                </div>

                            </form>
                        </div>
                    </div>


                </div>


                {{-- <div class="d-flex m-3 card-footer">
                    <ul class="avatars mt-2">
                        @if (count($project->project_role_assignments) > 0)
                            @foreach ($task->users as $assignment)
                                <li>

                                    <a href="#" data-toggle="tooltip" title="Kenny">
                                        <img alt="Kenny Tran" class="avatar"
                                            src="{{ optional($assignment)->photo ? '/storage/' . optional($assignment)->photo : 'https://source.unsplash.com/random?' . $assignment->id }}"
                                            data-filter-by="alt" />
                                    </a>



                                </li>
                            @endforeach
                        @else
                            No members assigned yet
                        @endif
                    </ul>
                </div> --}}

                {{-- @can('update_Task', $task)
                    <div class="d-flex m-3">
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter{{ $task->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </button>
                    @endcan

                    @can('delete_Task', $task)
                        <form action="/task/{{ $task->id }}/delete" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endcan --}}



            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter{{ $task->id }}" tabindex="-1"
                aria-labelledby="exampleModalCenterTitle{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle{{ $task->id }}">
                                Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-3">
                            <form id="editProjectForm{{ $task->id }}" action="/task/{{ $task->id }}/update"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label>Task Title</label>
                                    <input type="text" name="title" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                        value="{{ old('title') ?: $task->title }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Description:</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                        value="{{ old('description') ?: $task->description }}">
                                    @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" id="due_date"
                                        value="{{ old('due_date') ?: $task->due_date }}">
                                    @error('due_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"
                                onclick="submitForm('{{ $task->id }}')">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function submitForm(projectId) {
                    // Submit the form associated with the given project ID
                    document.getElementById('editProjectForm' + projectId).submit();
                }
            </script>


            {{-- CheckBox and Text Title End --}}

        @empty
            <p>No Tasks Here</p>
        @endforelse

    </ul>
</div>



{{-- Task Section End --}}
