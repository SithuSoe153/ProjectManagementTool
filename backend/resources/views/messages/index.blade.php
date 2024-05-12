<x-layout>

    <div class="container">

        <div class="layout layout-nav-side">

            <div class="main-container">


                <div class="content-container">
                    <div class="chat-module" data-filter-list="chat-module-body">
                        <div class="chat-module-top">

                            <div class="chat-module-body">
                                @foreach ($messages as $message)
                                    <div class="media chat-item">
                                        <img alt="{{ $message->user->name }}"
                                            src="{{ $message->user->photo ? '/storage/' . $message->user->photo : 'https://source.unsplash.com/random?' . $message->user->id }}"
                                            class="avatar" />
                                        <div class="media-body">
                                            <div class="chat-item-title">
                                                <span class="chat-item-author"
                                                    data-filter-by="text">{{ $message->user->name }}</span>
                                                <span
                                                    data-filter-by="text">{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="chat-item-body" data-filter-by="text">
                                                <p>{{ $message->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="chat-module-bottom">
                            {{-- <form class="chat-form">
                                <textarea class="form-control" placeholder="Type message" rows="1"></textarea>
                                <div class="chat-form-buttons">
                                    <button type="button" class="btn btn-link">
                                        <i class="material-icons">tag_faces</i>
                                    </button>
                                    <div class="custom-file custom-file-naked">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">
                                            <i class="material-icons">attach_file</i>
                                        </label>
                                    </div>
                                </div>
                            </form> --}}

                            <form class="chat-form" id="chat-form">
                                <textarea class="form-control" placeholder="Type message" rows="1" id="message-content"></textarea>
                                <input type="hidden" id="project-id" value="{{ $project->id }}">
                                <!-- You need to ensure $projectId is passed to your view -->
                                <div class="chat-form-buttons">
                                    <button type="button" class="btn btn-link">
                                        <i class="material-icons">tag_faces</i>
                                    </button>
                                    <div class="custom-file custom-file-naked">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">
                                            <i class="material-icons">attach_file</i>
                                        </label>
                                    </div>
                                </div>
                            </form>
                            <script>
                                document.getElementById('message-content').addEventListener('keypress', function(event) {
                                    if (event.keyCode === 13) { // keyCode 13 is Enter
                                        event.preventDefault(); // Prevent the default action (new line)
                                        const content = this.value;
                                        const projectId = document.getElementById('project-id').value;
                                        $.ajax({
                                            url: '{{ route('messages.store') }}',
                                            type: 'POST',
                                            data: {
                                                content: content,
                                                project_id: projectId,
                                                _token: '{{ csrf_token() }}'
                                            },
                                            success: function(response) {
                                                console.log(response.message); // Success logic
                                            },
                                            error: function(response) {
                                                console.error(response); // Error handling
                                            }
                                        });
                                        this.value = ''; // Clear the textarea
                                    }
                                });
                            </script>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</x-layout>
