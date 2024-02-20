<x-layout>

    <div class="container col-8">
        <div class="row">
            <div class="col-md-12">
                @can('create_Project', App\Models\Project::class)
                    <a href="/project/create" class="btn btn-warning my-3">Add Project</a>
                @endcan
            </div>
        </div>

        <x-project-card :projects="$projects" />

        {{-- employee --}}


        <div class="row mt-3">

            @foreach ($assignedProjects as $project)
                <div class="col-md-12 mx-auto">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="projects/{{ $project->project->id }}">{{ $project->project->title }}</a>
                            </h5>
                            <p class="card-text">Created by: {{ $project->project->user->name }}</p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>



</x-layout>
