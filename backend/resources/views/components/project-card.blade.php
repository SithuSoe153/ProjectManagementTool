@foreach ($projects->load('user') as $project)
    <div class="col-lg-6">
        <div class="card card-project">

            {{-- <div class="progress">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div> --}}

            <div class="card-body">
                <div class="dropdown card-options">
                    <button class="btn-options" type="button" id="project-dropdown-button-1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        @can('update_Project', $project)
                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter{{ $project->id }}">
                                Edit
                            </button>
                        @endcan



                        @can('delete_Project', $project)
                            <form action="/project/{{ $project->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">
                                    Delete
                                </button>
                            </form>
                        @endcan


                        </a>
                    </div>
                </div>
                <div class="card-title">
                    <a href="#">
                        <h5 data-filter-by="text"> <a href="projects/{{ $project->id }}">{{ $project->title }}</a></h5>
                    </a>
                </div>

                <p class="card-text">Created by: {{ $project->user->name }}</p>

                <ul class="avatars">
                    @if (count($project->project_role_assignments) > 0)
                        @foreach ($project->project_role_assignments as $assignment)
                            {{-- {{ $project->project_role_assignments->unique('user_id')->count() ?: 'No members assigned yet' }} --}}
                            {{-- @foreach ($project->project_role_assignments as $assignment)
                        {{ optional($assignment)->user->name ?? 'No members assigned yet' }}
                    @endforeach --}}


                            <li>

                                {{-- {{ optional($assignment)->user->name ?? 'No members assigned yet' }} --}}
                                <a href="#" data-toggle="tooltip" title="Kenny">
                                    <img alt="Kenny Tran" class="avatar" {{-- src="/storage/{{ optional($assignment)->user->photo ?? 'images/default.jpg' }}" --}}
                                        src="{{ optional($assignment)->user->photo ? '/storage/' . optional($assignment)->user->photo : 'https://source.unsplash.com/featured/?man?' . $assignment->user->id }}"
                                        data-filter-by="alt" />
                                </a>



                            </li>
                        @endforeach
                    @else
                        No members assigned yet
                    @endif
                </ul>



                <div class="card-meta d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="material-icons mr-1">playlist_add_check</i>
                        <span class="text-small">6/10</span>
                    </div>
                    <span class="text-small" data-filter-by="text">Due 4 days</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter{{ $project->id }}" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle{{ $project->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle{{ $project->id }}">
                        Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <form id="editProjectForm{{ $project->id }}" action="/project/{{ $project->id }}/update"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label>Project Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('title') ?: $project->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Project Description</label>
                            <input type="text" name="description" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ old('description') ?: $project->description }}">
                            @error('description')
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm('{{ $project->id }}')">Save
                        changes</button>
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


{{-- pipeline --}}
