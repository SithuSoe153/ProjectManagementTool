<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#task-modal">
    Assign Member
</a>



<!-- Modal form -->
{{-- <div id="task-modal" class="modal fade" tabindex="-1" aria-labelledby="task-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="task-modal-label">Assign Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('task.assignMembers', $task->id) }}" method="POST">
                    @csrf
                    <!-- Form content -->
                    <div class="form-group-users">
                        <!-- Iterate over users -->
                        @foreach ($project->project_role_assignments->unique('user_id') as $user)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="members[]" value="{{ $user->user->id }}"
                                    class="custom-control-input" id="{{ $user->user->id }}">
                                <label class="custom-control-label" for="{{ $user->user->id }}">
                                    <span class="d-flex align-items-center">
                                        <img alt="Claire Connors"
                                            src="/storage/{{ optional($user)->photo ?: 'images/cat.jpg' }}"
                                            class="avatar mr-2" />
                                        <span class="h6 mb-0" data-filter-by="text">{{ $user->user->name }}</span>
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Assign Members</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalContainer = document.getElementById('modal-container');
        var modal = document.getElementById('task-modal');

        modalContainer.appendChild(modal);
    });
</script>


<form action="{{ route('task.assignMembers', $task->id) }}" method="POST" enctype="multipart/form-data" class="modal fade"
    id="task-modal" tabindex="-1" aria-hidden="true" style="z-index: 1050;">
    @csrf

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Members</h5>
                <button type="button" class="close btn btn-round" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>


            <div class="modal-body  ">
                <div class="form-group-users">
                    @foreach ($project->project_role_assignments->unique('user_id') as $user)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="members[]" value="{{ $user->user->id }}"
                                class="custom-control-input" id="{{ $user->user->id }}">

                            <label class="custom-control-label" for="{{ $user->user->id }}">
                                <span class="d-flex align-items-center">
                                    <img alt="Claire Connors"
                                        src=" /storage/{{ optional($user)->photo ?: 'images/cat.jpg' }}"
                                        class="avatar mr-2" />

                                    <span class="h6 mb-0" data-filter-by="text">{{ $user->user->name }}</span>
                                </span>
                            </label>
                        </div>
                    @endforeach


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Assign
                    Members</button>
            </div>
        </div>
</form>
