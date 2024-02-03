<x-layout>

    <a href="/project/create" class="btn btn-warning my-3">Add Project</a>
    @foreach ($projects as $project)
        <div>
            <label>Project name: <a href="projects/{{ $project->id }}">{{ $project->title }}</a></label>
            <p>Creator: {{ $project->user->name }}</p>
            <br>
            <hr>
        </div>
    @endforeach
</x-layout>
