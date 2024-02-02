@foreach ($projects as $project)
    <div>
        <label>Project name: <a href="projects/{{ $project->id }}">{{ $project->title }}</a></label>
        <p>Creator: {{ $project->user->name }}</p>
        <br>
        <hr>
    </div>
@endforeach
