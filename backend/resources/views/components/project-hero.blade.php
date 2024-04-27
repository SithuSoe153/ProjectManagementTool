{{-- Project Details Card Start --}}
<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title"><span style=" color: #888;">Project name</span>: {{ $project->title }}</h4>
        <h6 class="card-title"><span style=" color: #888;">{{ $project->description }}</span></h6>

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

                {{ $project->project_role_assignments->unique('user_id')->count() ?: '' }}
            </strong>

            <x-btn-add-member :project="$project" :roles="$roles" />

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
