<x-layout>

    <div class="container my-4">
        {{-- Project Details Card Start --}}
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title">Project name: {{ $project->title }}</h1>
                <h6>Start Date: {{ $project->start_date }}</h6>
                <h6>Due Date: {{ $project->due_date }}</h6>
                <p>Project Creator: {{ $project->user->name }}
                    ({{ $role = optional($project->user->roles->first())->name ?: '' }})</p>
                {{-- Show Members --}}
                <div class="mb-3">
                    <strong>Members:
                        {{ $project->project_role_assignments->unique('user_id')->count() ?: 'No members assigned yet' }}</strong>
                    <a href="#" onclick="toggleFormMember()">Add Member</a>
                </div>
            </div>
            {{-- Hidden Add Member form initially --}}
            <div id="memberForm" style="display: none;">
                <div class="card-body">
                    <form action="/project/{{ $project->id }}/member" method="POST">
                        @csrf
                        <h5 class="card-title">Add Member</h5>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="roles">Roles:</label>
                            <select name="roles[]" id="roles" class="form-select" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save Members</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Project Details Card End --}}

        {{-- Task Section Start --}}
        <div>
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

            {{-- Tasks List --}}

            <ul class="list-group">
                {{-- CheckBox and Text Title Start --}}
                @forelse ($project->tasks as $task)

                    <div class="card">

                        <h6 class="card-header">


                            <input {{ $task->is_completed ? 'checked' : '' }}
                                class="form-check-input task-checkbox ms-0 me-2" value="{{ $task->id }}"
                                type="checkbox" value="" id="task-{{ $task->id }}"
                                {{ optional($task->users()->first())->id == auth()->user()->id ||
                                auth()->user()->roles->first()->name == 'Admin'
                                    ? ''
                                    : 'disabled' }}>



                            {{-- {{ optional($task->users()->first())->id == auth()->user()->id && (auth()->user()->id = 1) ? 'disabled' : '' }} --}}

                            <span class="task-text {{ $task->is_completed ? 'task-completed' : '' }}">



                                {{ $task->title }}
                                |

                                @foreach ($task->users as $user)
                                    {{ $user->name }}
                                @endforeach

                            </span>

                            @if (!$task->is_completed)
                                <a onclick="toggleFormAssign({{ $task->id }})" href="" class="mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>

                                </a>
                            @endif


                            <br>

                            <span class="task-text {{ $task->is_completed ? 'task-completed' : '' }}">
                                <small class="mx-4">Due Date: {{ $task->due_date }}</small>
                            </span>

                        </h6>


                        <!-- Hidden Member Assign form initially -->
                        <div class="container
                                col-8"
                            id="assignForm-{{ $task->id }}" style="display: none;">
                            <div class="card-body">
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var membersSelect = new MultiSelectTag('members_{{ $task->id }}');
                                    });
                                </script>
                                {{-- <div class="card"> --}}
                                <form action="{{ route('task.assignMembers', $task->id) }}" method="POST"
                                    class="card-body" id="assignMemberForm">
                                    @csrf
                                    <div class="form-group">
                                        <h6 class="card-title">Assign Member</h6>
                                    </div>
                                    {{ $project->project_role_assignments->unique('user_id')->count() ? '' : 'No members assigned yet' }}

                                    <div class="form-group">
                                        <select name="members[]" id="members_{{ $task->id }}" multiple>
                                            {{-- Populate options from roles table --}}
                                            @foreach ($project->project_role_assignments->unique('user_id') as $assignment)
                                                <option value="{{ $assignment->user->id }}">
                                                    {{ $assignment->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success my-3">Assign Members</button>
                                </form>
                                {{-- </div> --}}
                            </div>

                        </div>



                        {{-- CheckBox and Text Title End --}}
                    </div>



                    <hr>


                @empty
                    <p>No Tasks Here</p>
                @endforelse

                <!-- Hidden Toast form initially -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">

                            <i class="fas fa-bell me-2"></i>

                            <strong class="me-auto">{{ session('toast') }}</strong>
                            <small>now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('toast') }}
                        </div>
                    </div>
                </div>

                {{-- Toast Session Check Start --}}
                @if (session('toast'))
                    <script>
                        const toastLiveExample = document.getElementById('liveToast');
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(
                            toastLiveExample);
                        toastBootstrap.show();
                    </script>
                    {{-- Optionally, clear the message after showing it to prevent it from reappearing on refresh --}}
                    @php session()->forget('toast'); @endphp
                @endif
                {{-- Toast Session Check End --}}

                {{-- CheckBox and Text Title End --}}



            </ul>
        </div>
        {{-- Task Section End --}}
    </div>

    {{-- Toast Notification --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-bell me-2"></i>
                <strong class="me-auto">Success</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Task Updated Successfully
            </div>
        </div>
    </div>

    {{-- Toast Session Check --}}
    @if (session('toast'))
        <script>
            const toastLiveExample = document.getElementById('liveToast');
            const toastBootstrap = new bootstrap.Toast(toastLiveExample);
            toastBootstrap.show();
        </script>
    @endif

</x-layout>

<script>
    // Toogle Script Start

    function toggleFormTask() {
        var form = document.getElementById("taskForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    function toggleFormMember() {
        event.preventDefault();
        var form = document.getElementById("memberForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    function toggleFormAssign(taskId) {
        event.preventDefault();
        var form = document.getElementById("assignForm-" + taskId);
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    // Toogle Script End


    // CheckBox Script query, toast Start
    document.querySelectorAll('.task-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var taskId = this.getAttribute(
                'value'); // Assuming the checkbox has a value attribute with the task ID
            var taskText = this.parentElement.querySelector('.task-text');
            if (this.checked) {
                taskText.classList.add('task-completed');
                // Correct URL construction for route model binding

                document.addEventListener('DOMContentLoaded', function() {
                    // Check if there's a Laravel session flash message for the toast
                    @if (session('toast'))
                        console.log('oka');
                        const toastLiveExample = document.getElementById('liveToast');
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(
                            toastLiveExample);
                        toastBootstrap.show();

                        // Optionally, clear the message after showing it to prevent it from reappearing on refresh
                        @php session()->forget('toast'); @endphp
                    @endif
                });

                window.location.href = '/task/toggle-completed/' + taskId;


            } else {
                taskText.classList.remove('task-completed');

                // const toastLiveExample = document.getElementById('liveToast')
                // const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                // toastBootstrap.show()
                // Optionally handle the uncheck action differently
                window.location.href = '/task/toggle-completed/' + taskId;
            }
        });
    });
    // CheckBox Script query, toast Start

    var rolesSelect = new MultiSelectTag('roles');
</script>
