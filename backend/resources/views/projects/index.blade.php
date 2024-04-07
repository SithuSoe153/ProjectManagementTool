<x-layout>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-11 col-xl-10">

                <br>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="projects" role="tabpanel"
                        data-filter-list="content-list-body">
                        <div class="content-list">
                            <div class="row content-list-head">
                                <div class="col-auto">
                                    <h3>Projects</h3>


                                    @can('create_Project', App\Models\Project::class)
                                        <button class="btn btn-round" data-toggle="modal" data-target="#project-add-modal">
                                            <i class="material-icons">add</i>
                                        </button>
                                        {{-- <a href="/project/create" class="btn btn-warning my-3">Add Project</a> --}}
                                    @endcan

                                </div>

                            </div>
                            <div class="content-list-body row">

                                <x-project-card :projects="$projects" />

                                @foreach ($assignedProjects as $project)
                                    <div class="col-lg-6">
                                        {{-- @foreach ($projects->load('user') as $project) --}}
                                        <div class="card card-project">

                                            {{-- <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> --}}

                                            <div class="card-body">
                                                <div class="dropdown card-options">
                                                    <button class="btn-options" type="button"
                                                        id="project-dropdown-button-1" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        @can('update_Project', $project)
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter{{ $project->id }}">
                                                                Edit
                                                            </button>
                                                        @endcan



                                                        @can('delete_Project', $project)
                                                            <form action="/project/{{ $project->id }}/delete"
                                                                method="POST">
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
                                                        <h5 data-filter-by="text"> <a <a
                                                                href="projects/{{ $project->project->id }}">{{ $project->project->title }}</a>
                                                    </a>
                                                </div>

                                                <p class="card-text">Created by: {{ $project->project->user->name }}</p>

                                                <div class="card-meta d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons mr-1">playlist_add_check</i>
                                                        <span class="text-small">6/10</span>
                                                    </div>
                                                    <span class="text-small" data-filter-by="text">Due 4 days</span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @endforeach --}}
                                    </div>


                                    {{-- pipeline end --}}
                                @endforeach

                            </div>

                            <!--end of content list head-->

                            <!--end of content list body-->
                        </div>
                        <!--end of content list-->
                    </div>
                    <!--end of tab-->
                    <div class="tab-pane fade" id="members" role="tabpanel" data-filter-list="content-list-body">
                        <div class="content-list">
                            <div class="row content-list-head">
                                <div class="col-auto">
                                    <h3>Members</h3>
                                    <button class="btn btn-round" data-toggle="modal" data-target="#user-invite-modal">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
                                <form class="col-md-auto">
                                    <div class="input-group input-group-round">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                        </div>
                                        <input type="search" class="form-control filter-list-input"
                                            placeholder="Filter members" aria-label="Filter Members">
                                    </div>
                                </form>
                            </div>
                            <!--end of content list head-->

                        </div>
                        <!--end of content list-->
                    </div>
                </div>

                <form class="modal fade" id="team-manage-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Manage Team</h5>
                                <button type="button" class="close btn btn-round" data-dismiss="modal"
                                    aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <!--end of modal head-->
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="team-manage-details-tab" data-toggle="tab"
                                        href="#team-manage-details" role="tab" aria-controls="team-manage-details"
                                        aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="team-manage-members-tab" data-toggle="tab"
                                        href="#team-manage-members" role="tab" aria-controls="team-manage-members"
                                        aria-selected="false">Members</a>
                                </li>
                            </ul>
                            <div class="modal-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="team-manage-details" role="tabpanel">
                                        <h6>Team Details</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Name</label>
                                            <input class="form-control col" type="text" placeholder="Team name"
                                                name="team-name" value="Medium Rare" />
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Description</label>
                                            <textarea class="form-control col" rows="3" placeholder="Team description" name="team-description">A small web studio crafting lovely template products.</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end of modal body-->
                            <div class="modal-footer">
                                <button role="button" class="btn btn-primary" type="submit">
                                    Done
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="modal fade" id="project-add-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Project</h5>
                                <button type="button" class="close btn btn-round" data-dismiss="modal"
                                    aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <!--end of modal head-->
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="project-add-details-tab" data-toggle="tab"
                                        href="#project-add-details" role="tab"
                                        aria-controls="project-add-details" aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="project-add-members-tab" data-toggle="tab"
                                        href="#project-add-members" role="tab"
                                        aria-controls="project-add-members" aria-selected="false">Members</a>
                                </li>
                            </ul>
                            <div class="modal-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="project-add-details" role="tabpanel">
                                        <h6>General Details</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Name</label>
                                            <input class="form-control col" type="text" placeholder="Project name"
                                                name="project-name" />
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Description</label>
                                            <textarea class="form-control col" rows="3" placeholder="Project description" name="project-description"></textarea>
                                        </div>
                                        <hr>
                                        <h6>Timeline</h6>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Start Date</label>
                                            <input class="form-control col" type="text" name="project-start"
                                                placeholder="Select a date" data-flatpickr
                                                data-default-date="2021-04-21" data-alt-input="true" />
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Due Date</label>
                                            <input class="form-control col" type="text" name="project-due"
                                                placeholder="Select a date" data-flatpickr
                                                data-default-date="2021-09-15" data-alt-input="true" />
                                        </div>
                                        <div class="alert alert-warning text-small" role="alert">
                                            <span>You can change due dates at any time.</span>
                                        </div>
                                        <hr>
                                        <h6>Visibility</h6>
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="visibility-everyone" name="visibility"
                                                        class="custom-control-input" checked>
                                                    <label class="custom-control-label"
                                                        for="visibility-everyone">Everyone</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="visibility-members" name="visibility"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="visibility-members">Members</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="visibility-me" name="visibility"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="visibility-me">Just
                                                        me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end of modal body-->
                            <div class="modal-footer">
                                <button role="button" class="btn btn-primary" type="submit">
                                    Create Project
                                </button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>

        </div>
    </div>

    <div class="container col-8">
        {{-- <div class="row">
            <div class="col-md-12">
                @can('create_Project', App\Models\Project::class)
                    <a href="/project/create" class="btn btn-warning my-3">Add Project</a>
                @endcan
            </div>
        </div> --}}


        {{-- employee --}}


        {{-- <div class="row mt-3"> --}}

        <div class="content-list-body row">



            {{-- </div> --}}
        </div>

    </div>



</x-layout>
