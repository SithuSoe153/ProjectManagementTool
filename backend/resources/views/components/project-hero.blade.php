{{-- Project Details Card Start --}}
<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">Project name: {{ $project->title }}</h3>

        <div>
            <small>Start Date: {{ $project->start_date }}</small>
        </div>
        <div>
            <small>Due Date: {{ $project->due_date }}</small>
        </div>

        <p>Created by: {{ $project->user->name }}
            ({{ $role = optional($project->user->roles->first())->name ?: '' }})</p>
        {{-- Show Members --}}
        <div class="mb-3">
            <strong>Members:

                {{ $project->project_role_assignments->unique('user_id')->count() ?: 'No members assigned yet' }}
            </strong>

            <x-btn-add-member :project="$project" :roles="$roles" />

        </div>
    </div>
</div>
{{-- Project Details Card End --}}
