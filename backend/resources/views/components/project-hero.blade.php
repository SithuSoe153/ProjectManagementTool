{{-- Project Details Card Start --}}
<div class="card mb-4">
    <div class="card-body">
        <h1 class="card-title">Project name: {{ $project->title }}</h1>
        <h6>Start Date: {{ $project->start_date }}</h6>
        <h6>Due Date: {{ $project->due_date }}</h6>
        <p>Project Creator: {{ $project->user->name }}
            ({{ $role = optional($project->user->roles->first())->name ?: '' }})</p>
        {{-- Show Members --}}
        <div class="mb-3">
            <strong>Members:
                {{ $project->project_role_assignments->unique('user_id')->count() ?: 'No members assigned yet' }}</strong>
            <a href="#" onclick="toggleFormMember()">Add Member</a>
        </div>
    </div>
    {{-- Hidden Add Member form initially --}}
    <div id="memberForm" style="display: none;">
        <div class="container col-6">

            <div class="card-body">
                <form action="/project/{{ $project->id }}/member" method="POST">
                    @csrf
                    <h5 class="card-title">Add Member</h5>
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="roles">Roles:</label>
                        <select name="roles[]" id="roles" class="form-select" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save Members</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Project Details Card End --}}
