<a onclick="toggleFormAssign({{ $task->id }})" href="" class="mx-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
        viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
        <path
            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
    </svg>

</a>

<!-- Hidden Member Assign form initially -->
<div class="container
col-8" id="assignForm-{{ $task->id }}" style="display: none;">
    <div class="card-body">
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var membersSelect = new MultiSelectTag('members_{{ $task->id }}');
            });
        </script>
        {{-- <div class="card"> --}}
        <form action="{{ route('task.assignMembers', $task->id) }}" method="POST" class="card-body"
            id="assignMemberForm">
            @csrf
            <div class="form-group">
                <h6 class="card-title">Assign Member</h6>
            </div>
            {{ $project->project_role_assignments->unique('user_id')->count() ? '' : 'No members assigned yet' }}

            <div class="form-group">
                <select name="members[]" id="members_{{ $task->id }}" multiple required aria-required="true">
                    {{-- Populate options from roles table --}}
                    @foreach ($project->project_role_assignments->unique('user_id') as $assignment)
                        <option value="{{ $assignment->user->id }}">
                            {{ $assignment->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success my-3">Assign
                Members</button>
        </form>
        {{-- </div> --}}
    </div>

</div>
