<div>
    <h1>Project name: {{ $project->title }}</h1>
    <h4>Due Date: {{ $project->due_date }}</h4>
    <p>Project Creator: {{ $project->user->name }} ({{ $project->user->roles->first()->name }})</p>

    <hr>
    <ul>

        @foreach ($project->tasks as $task)
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
        @endforeach

    </ul>

    <br>
</div>
