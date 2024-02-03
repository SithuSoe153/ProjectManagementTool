<x-layout>

    <div class="container my-4 col-8">
        <h1>Project name: {{ $project->title }}</h1>
        <h4>Due Date: {{ $project->due_date }}</h4>
        <p>Project Creator: {{ $project->user->name }} ({{ optional($project->user->roles->first())->name }})</p>

        <hr>


        <div>
            <!-- Existing code -->

            <a href="#" class="btn btn-danger" onclick="toggleForm()">Add Task</a>

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


        </div>


        <ul>

            @forelse ($project->tasks as $task)
                <li>Task name: {{ $task->title }} | was assigned to |
                    @foreach ($task->users as $user)
                        {{ $user->name }}
                        @foreach ($user->roles as $role)
                            ({{ $role->name }})
                        @endforeach
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
        function toggleForm() {
            var form = document.getElementById("taskForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function saveTask() {
            // Add logic to save the task data
            alert("Task saved!"); // Replace this with your actual logic
            toggleForm(); // Optionally hide the form after saving
        }
    </script>

</x-layout>
