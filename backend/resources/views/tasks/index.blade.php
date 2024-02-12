<x-layout>


    <div class="container my-4">
        @foreach ($groupedTasks as $projectId => $tasks)
            <div class="card">
                <div class="card-header">
                    <x-project-hero :project="$tasks->first()->project" :roles="$roles" />

                </div>

                <div class="card-body">
                    <x-task-card :project="$project" :tasks="$tasks" />
                </div>


            </div>
            <br>
        @endforeach
    </div>





</x-layout>
