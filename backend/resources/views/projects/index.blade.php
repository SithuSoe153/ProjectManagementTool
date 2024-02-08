<x-layout>

    <div class="container col-8">
        <div class="row">

            <div class="col-md-12">
                @if (auth()->user()->roles()->first()->name == 'Admin')
                    <a href="/project/create" class="btn btn-warning my-3">Add Project</a>
                @endif
            </div>
        </div>
        <div class="row">
            @foreach ($projects->load('user') as $project)
                <div class="col-md-12 mx-auto">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="projects/{{ $project->id }}">{{ $project->title }}</a>
                            </h5>
                            <p class="card-text">Creator: {{ $project->user->name }}</p>

                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter{{ $project->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{ $project->id }}" tabindex="-1"
                    aria-labelledby="exampleModalCenterTitle{{ $project->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header mx-3">
                                <h5 class="modal-title" id="exampleModalCenterTitle{{ $project->id }}">
                                    Edit Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mx-3">
                                <form id="editProjectForm{{ $project->id }}"
                                    action="/project/{{ $project->id }}/update" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <label>Project Title</label>
                                        <input type="text" name="title" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ old('title') ?: $project->title }}">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" id="start_date"
                                            value="{{ old('start_date') ?: $project->start_date }}">
                                        @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="due_date">Due Date</label>
                                        <input type="date" name="due_date" class="form-control" id="due_date"
                                            value="{{ old('due_date') ?: $project->due_date }}">
                                        @error('due_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer mx-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="submitForm('{{ $project->id }}')">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function submitForm(projectId) {
                        // Submit the form associated with the given project ID
                        document.getElementById('editProjectForm' + projectId).submit();
                    }
                </script>
            @endforeach

        </div>



        {{-- employee --}}


        <div class="row">

            @foreach ($assignedProjects as $project)
                <div class="col-md-12 mx-auto">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="projects/{{ $project->project->id }}">{{ $project->project->title }}</a>
                            </h5>
                            <p class="card-text">Creator: {{ $project->project->user->name }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



</x-layout>
