<x-layout>

    <div class="container my-4 col-8">
        <h1>Project name: {{ $project->title }}</h1>
        <h4>Due Date: {{ $project->due_date }}</h4>
        <p>Project Creator: {{ $project->user->name }} ({{ optional($project->user->roles->first())->name }})</p>

        <hr>


        <div>
            <!-- Existing code -->
            <div class="container my-3">
                <a href="#" class="btn btn-danger" onclick="toggleFormTask()">Add Task</a>
                <a href="#" class="btn btn-danger" onclick="toggleFormMember()">Add Members</a>

                <div class="my-4">
                    <strong>
                        Members:
                        {{ $count = $project->project_role_assignments->unique('user_id')->count() ?: 'No members yet' }}
                    </strong>

                </div>

            </div>

            <!-- Hidden form initially -->
            <div class="container my-4 col-8" id="taskForm" style="display: none;">
                <div class="card">


                    <form action="/project/{{ $project->id }}/task" method="POST" class="card-body">@csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="due_date">Due Date:</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary my-3">Save</button>
                    </form>
                </div>
            </div>


            <!-- Hidden form initially -->
            <div class="container my-4 col-8" id="memberForm" style="display: none;">
                <div class="card">


                    <form action="/project/{{ $project->id }}/member" method="POST" class="card-body"
                        id="addMemberForm">
                        @csrf

                        <div class="form-group">
                            <h5 class="card-title">Add Member</h5>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="roles">Roles:</label>
                            <select name="roles[]" id="roles" multiple>
                                {{-- Populate options from roles table --}}
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="button" onclick="addMember()" class="btn btn-primary my-3">Add Member</button>
                        <button type="submit" class="btn btn-success my-3">Save Members</button>
                    </form>


                    @forelse ($project->project_role_assignments->unique('user_id') as $assignment)
                        <div class="container">
                            {{ $assignment->user->name }} : {{ $assignment->user->email }}
                        </div>
                    @empty
                        No members assigned yet.
                    @endforelse

                </div>
            </div>



        </div>


        <ul>

            @forelse ($project->tasks as $task)
                <li>Task name: {{ $task->title }} | was assigned to |

                    <a onclick="toggleFormAssign()" href="">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                    </a>

                    <!-- Hidden form initially -->
                    <div class="container my-4 col-8" id="assignForm" style="display: none;">
                        <div class="card">
                            <form action="{{ route('task.assignMembers', $task->id) }}" method="POST"
                                class="card-body" id="assignMemberForm">
                                @csrf
                                <div class="form-group">
                                    <h5 class="card-title">Assign Member</h5>
                                </div>
                                <div class="form-group">
                                    <select name="members[]" id="assignMember" multiple>
                                        {{-- Populate options from roles table --}}
                                        @foreach ($project->project_role_assignments->unique('user_id') as $assignment)
                                            <option value="{{ $assignment->user->id }}">
                                                {{ $assignment->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" onclick="addAssignMember()" class="btn btn-primary my-3">Add
                                    Member</button>
                                <button type="submit" class="btn btn-success my-3">Save Members</button>
                            </form>
                        </div>
                    </div>


                    @foreach ($task->users as $user)
                        {{ $user->name }}
                    @endforeach
                    <p>Due Date: {{ $task->due_date }}</p>
                    <hr>
                </li>
            @empty
                <p>No Tasks Here</p>
            @endforelse

        </ul>

        <br>
    </div>



    <script>
        function toggleFormTask() {
            var form = document.getElementById("taskForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function toggleFormMember() {
            var form = document.getElementById("memberForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function toggleFormAssign() {
            event.preventDefault();
            var form = document.getElementById("assignForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>


    {{-- <script>
        // Store selected members in an array
        var selectedMembers = [];

        function addMember() {
            // Get selected email and roles
            var email = document.getElementById('email').value;
            var rolesSelect = document.getElementById('roles');
            var selectedRoles = [...rolesSelect.selectedOptions].map(option => option.text);

            // Add member data to the array
            selectedMembers.push({
                email: email,
                roles: selectedRoles
            });

            // Display selected members
            displaySelectedMembers();

            // Clear the form
            document.getElementById('email').value = '';
            rolesSelect.selectedIndex = -1;
        }

        function displaySelectedMembers() {
            // Display selected members in the 'selectedRoles' div
            var selectedRolesDiv = document.getElementById('selectedRoles');
            selectedRolesDiv.innerHTML = '';

            selectedMembers.forEach(function(member) {
                selectedRolesDiv.innerHTML += '<p><strong>Email:</strong> ' + member.email + '</p>';
                selectedRolesDiv.innerHTML += '<p><strong>Roles:</strong> ' + member.roles.join(', ') + '</p>';
                selectedRolesDiv.innerHTML += '<hr>';
            });
        }
    </script> --}}

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

    <script>
        // Initialize the multi-select tag
        var rolesSelect = new MultiSelectTag('roles');

        var selectedMembers = [];

        function addMember() {
            var email = document.getElementById('email').value;
            var selectedRoles = rolesSelect.getSelectedValues();

            selectedMembers.push({
                email,
                roles: selectedRoles
            });

            displaySelectedMembers();
        }

        function displaySelectedMembers() {
            var selectedRolesDiv = document.getElementById('selectedRoles');
            selectedRolesDiv.innerHTML = '';

            selectedMembers.forEach((member, index) => {
                selectedRolesDiv.innerHTML += `<p><strong>Member ${index + 1}:</strong></p>`;
                selectedRolesDiv.innerHTML += `<p><strong>Email:</strong> ${member.email}</p>`;
                selectedRolesDiv.innerHTML += `<p><strong>Roles:</strong> ${member.roles.join(', ')}</p>`;
                selectedRolesDiv.innerHTML += '<hr>';
            });
        }
    </script>



    <script>
        // Initialize the multi-select tag for assigning members
        var assignMemberSelect = new MultiSelectTag('assignMember');

        var assignedMembers = [];

        function addAssignMember() {
            var selectedMembers = assignMemberSelect.getSelectedValues();

            assignedMembers.push({
                members: selectedMembers
            });

            displayAssignedMembers();
        }

        function displayAssignedMembers() {
            var assignedMembersDiv = document.getElementById('assignedMembers');
            assignedMembersDiv.innerHTML = '';

            assignedMembers.forEach((member, index) => {
                assignedMembersDiv.innerHTML += `<p><strong>Assigned Member ${index + 1}:</strong></p>`;
                assignedMembersDiv.innerHTML += `<p><strong>Email:</strong> ${member.email}</p>`;
                assignedMembersDiv.innerHTML += `<p><strong>Roles:</strong> ${member.roles.join(', ')}</p>`;
                assignedMembersDiv.innerHTML += '<hr>';
            });
        }
    </script>



</x-layout>
