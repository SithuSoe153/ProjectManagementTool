<x-layout>

    <div class="container my-4">
        {{-- Project Details Card Start --}}
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title"><span style=" color: #888;">Project name</span>: {{ $project->title }}</h4>

                <div>
                    <small>Start Date: {{ $project->start_date }}</small>
                </div>
                <div>
                    <small>Due Date: {{ $project->due_date }}</small>
                </div>

                {{-- Show Members --}}
                <div class="mb-3">
                    <strong>Members:

                        {{ $project->project_role_assignments->unique('user_id')->count() ?: '' }}
                    </strong>

                    <ul class="avatars mt-2">
                        @if (count($project->project_role_assignments) > 0)
                            @foreach ($project->project_role_assignments as $assignment)
                                <li>

                                    {{-- {{ optional($assignment)->user->name ?? 'No members assigned yet' }} --}}
                                    <a href="#" data-toggle="tooltip" title="Kenny">
                                        <img alt="Kenny Tran" class="avatar" {{-- src="/storage/{{ optional($assignment)->user->photo ?? 'images/default.jpg' }}" --}}
                                            src="{{ optional($assignment)->user->photo ? '/storage/' . optional($assignment)->user->photo : 'https://source.unsplash.com/random?' . $assignment->user->id }}"
                                            data-filter-by="alt" />
                                    </a>



                                </li>
                            @endforeach
                        @else
                            No members assigned yet
                        @endif
                    </ul>

                </div>
            </div>
        </div>
        {{-- Project Details Card End --}}




        <div>
            {{-- Meeting Button --}}
            <div>
                <div class="row content-list-head">
                    <div class="col-auto">
                        <h3>Meetings</h3>


                        {{-- <div class="mb-3"> --}}
                        <button class="btn btn-round" data-toggle="modal" data-target="#meeting-add-modal">
                            <i class="material-icons">add</i>
                        </button>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>

            {{-- Meetings List --}}
            <div class="mt-3">
                @foreach ($project->meetingSessions as $session)
                    <div class="card mb-2">

                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="material-icons">event</i>
                            </div>
                            <div class="ml-3 col-6">
                                <h5 class="card-title mb-0">{{ $session->title }}</h5>
                                <p class="card-text mb-0">
                                    <strong>Organized by:</strong> {{ $session->user->name ?? 'Unknown' }}
                                    <br>
                                    <strong>Start Date:</strong> {{ $session->start_date }}
                                    <br>
                                    <strong>End Date:</strong> {{ $session->end_date }}
                                </p>
                            </div>
                            <div class="ml-auto">
                                {{-- <a href="{{ ENV('NGROK') }}" class="btn btn-primary">Join</a> --}}
                                <a href="/projects/{{ $project->id }}/videoCallSession"
                                    class="btn btn-primary">Join</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>



        {{-- New Hidden Add Task form initially --}}

        <div id="modal-container"></div>


        <form action="/project/{{ $project->id }}/meeting" method="POST" enctype="multipart/form-data"
            class="modal fade" id="meeting-add-modal" tabindex="-1" aria-hidden="true">
            @csrf

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Meeting</h5>
                        <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    <!--end of modal head-->
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="project-add-details-tab" data-toggle="tab"
                                href="#project-add-details" role="tab" aria-controls="project-add-details"
                                aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="project-add-members-tab" data-toggle="tab"
                                href="#project-add-members" role="tab" aria-controls="project-add-members"
                                aria-selected="false">Members</a>
                        </li>
                    </ul>
                    <div class="modal-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                <h6>General Details</h6>
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Name</label>
                                    <input class="form-control col" type="text" placeholder="Task name"
                                        name="title" value="{{ old('title') }}" />

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>


                                <hr>


                                <h6>Timeline</h6>
                                <div class="form-group row align-items-center">
                                    <label class="col-3">Start Date</label>

                                    <input name="start_date" class="form-control col" type="text"
                                        placeholder="Select a date" data-flatpickr value="{{ old('start_date') }}"
                                        data-default-date="2021-04-21" data-alt-input="true" id="start_date" />


                                    <script>
                                        // Initialize Flatpickr
                                        flatpickr("#start_date", {
                                            altInput: true,
                                            altFormat: "F j, Y",
                                            dateFormat: "Y/m/d",
                                            defaultDate: "{{ old('start_date') ? old('start_date') : '2021-04-21' }}"
                                        });
                                    </script>

                                    @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror


                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-3">End Date</label>
                                    <input name="end_date" class="form-control col" type="text"
                                        placeholder="Select a date" data-flatpickr value="{{ old('end_date') }}"
                                        data-default-date="2021-09-15" data-alt-input="true" id="end_date" />


                                    <script>
                                        // Initialize Flatpickr
                                        flatpickr("#end_date", {
                                            altInput: true,
                                            altFormat: "F j, Y",
                                            dateFormat: "Y/m/d",
                                            defaultDate: "{{ old('due_date') ? old('due_date') : 'today' }}"
                                        });
                                    </script>

                                    @error('due_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                            </div>



                            {{-- Mambers Start --}}
                            <div class="tab-pane fade" id="project-add-members" role="tabpanel">
                                <div class="users-manage" data-filter-list="form-group-users">

                                    <div class="form-group-users">



                                        @foreach ($project->project_role_assignments->unique('user_id') as $user)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="selected_users[]"
                                                    value="{{ $user->user->id }}" class="custom-control-input"
                                                    id="{{ $user->user->id }}">

                                                <label class="custom-control-label" for="{{ $user->user->id }}">
                                                    <span class="d-flex align-items-center">
                                                        <img alt="Claire Connors"
                                                            src=" /storage/{{ optional($user)->photo ?: 'images/cat.jpg' }}"
                                                            class="avatar mr-2" />

                                                        <span class="h6 mb-0"
                                                            data-filter-by="text">{{ $user->user->name }}</span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of modal body-->
                    <div class="modal-footer">
                        <button role="button" class="btn btn-primary" type="submit">
                            Create Task
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>




</x-layout>
