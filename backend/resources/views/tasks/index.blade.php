<x-layout>


    <div class="container my-4">
        @foreach ($groupedTasks as $projectId => $tasks)
            <div class="card">
                <div class="card-header">
                    <x-project-hero :project="$tasks->first()->project" :roles="$roles" />

                </div>
                <div class="card-body">
                    @foreach ($tasks as $task)
                        <div>
                            {{ $task->title }}
                            {{-- @dd($tasks->first()->project->tasks) --}}
                            <x-task-card :project=$project />

                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <br>
        @endforeach
    </div>


    {{-- <div class="container my-4">
        @foreach ($groupedTasks as $projectId => $tasks)
            <div class="card">
                <div class="card-header">
                    <x-project-hero :project=$project :roles=$roles />
                </div>

                <div class="card-body">
                    <x-task-card :project=$project />
                </div>
            </div>
            <br>
        @endforeach
    </div> --}}

    {{--
    <div class="container my-4">
        @foreach ($projects as $project)
        @endforeach
    </div> --}}



</x-layout>
