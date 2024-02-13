{{-- Task Section Start --}}

<div>

    @can('create_Task', App\Models\Task::class)
        <div class="mb-3">
            <a href="#" class="btn btn-danger" onclick="toggleFormTask()">Add Task</a>
        </div>


        {{-- Hidden Add Task form initially --}}
        <div id="taskForm" style="display: none;">
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
        </div>
    @endcan

    {{-- Tasks List --}}


    <ul class="list-group" id="sortable">

        {{-- CheckBox and Text Title Start --}}
        @forelse ($tasks as $task)
            <div class="card my-2">


                <div class="card-header ui-state-default">

                    <div class="task-container" data-task-id="{{ $task->id }}">

                        <input {{ $task->is_completed ? 'checked' : '' }}
                            class="form-check-input task-checkbox ms-0 me-2" value="{{ $task->id }}" type="checkbox"
                            id="task-{{ $task->id }}" @cannot('check_Task', $task) disabled @endcannot>

                        <span class="task-text  {{ $task->is_completed ? 'task-completed' : '' }}">
                            {{ $task->title }}
                            |
                            @foreach ($task->users as $user)
                                {{ $user->name }}
                            @endforeach
                        </span>
                        @if (!$task->is_completed)
                            @can('assign_Member', $task)
                                <x-btn-assign-member :project='$project' :task="$task" />
                            @endcan
                        @endif
                        <br>
                        <span>
                            <small class="mx-4">Due Date: {{ $task->due_date }}</small>
                        </span>
                    </div>


                    @can('update_Task', $task)
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
                    @endcan

                </div>



                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{ $task->id }}" tabindex="-1"
                    aria-labelledby="exampleModalCenterTitle{{ $task->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header mx-3">
                                <h5 class="modal-title" id="exampleModalCenterTitle{{ $task->id }}">
                                    Edit Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mx-3">
                                <form id="editProjectForm{{ $task->id }}"
                                    action="/task/{{ $task->id }}/update" method="POST"
                                    enctype="multipart/form-data">
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
                            <div class="modal-footer mx-3">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="submitForm('{{ $task->id }}')">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <script>
                    function submitForm(projectId) {
                        // Submit the form associated with the given project ID
                        document.getElementById('editProjectForm' + projectId).submit();
                    }
                </script> --}}


                {{-- CheckBox and Text Title End --}}
            </div>


            {{-- <hr> --}}


        @empty
            <p>No Tasks Here</p>
        @endforelse


        <!-- Hidden Toast form initially -->



        {{-- CheckBox and Text Title End --}}


    </ul>
</div>



{{-- Task Section End --}}
