<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Create Your Account</h3>
                        <form action="/profile/{{ $user->id }}/update" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Name -->
                            <label for="name" class="form-label">Name:</label>
                            <div class="mb-3 d-flex align-items-center">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') ?: $user->name }}" readonly>
                                <a class="btn btn-warning ms-2 edit-button">Edit</a>
                                <!-- Add class edit-button -->
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Username -->
                            <label for="username" class="form-label">Username:</label>
                            <div class="mb-3 d-flex align-items-center">
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ old('username') ?: $user->username }}" readonly>
                                <!-- Use user->username -->
                                <a class="btn btn-warning ms-2 edit-button">Edit</a>
                                <!-- Add class edit-button -->
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <label for="email" class="form-label">Email:</label>
                            <div class="mb-3 d-flex align-items-center">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') ?: $user->email }}" readonly>
                                <a class="btn btn-warning ms-2 edit-button">Edit</a>
                                <!-- Add class edit-button -->
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Vanilla JavaScript script -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Get all "Edit" buttons
                                    var editButtons = document.querySelectorAll('.edit-button');

                                    // Add click event listener to each "Edit" button
                                    editButtons.forEach(function(button) {
                                        button.addEventListener('click', function() {
                                            // Find the input field in the same div
                                            var inputField = this.parentNode.querySelector('input');

                                            // Toggle the readonly attribute of the input field
                                            inputField.readOnly = !inputField.readOnly;

                                            // Set the selection range to the end of the input field
                                            inputField.setSelectionRange(inputField.value.length, inputField.value.length);

                                            // Focus on the input field
                                            inputField.focus();
                                        });
                                    });
                                });
                            </script>




                            <div class="mb-3">
                                <label class="form-label">Created at: </label>
                                <label class="form-label">{{ $user->created_at->diffForHumans() }}</label>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Updated at: </label>
                                <label class="form-label">{{ $user->updated_at->diffForHumans() }}</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
