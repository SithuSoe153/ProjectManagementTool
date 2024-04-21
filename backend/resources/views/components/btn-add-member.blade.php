@can('add_Member', $project)

    <a href="#" class="btn btn-primary btn-sm" onclick="toggleFormMember()">Add Member</a>

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
@endcan
