<x-layout>




    {{-- <div class="dropdown">
            <button class="btn btn-round" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="material-icons">settings</i>

            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#project-edit-modal">Edit
                    Project</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#">Archive</a>
            </div>
        </div> --}}

    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <br>
                <div class="tab-content">

                    <style>
                        .kbtn {
                            display: flex;
                            /* Flex display to align children inline */
                            align-items: center;
                            /* Align children vertically in the center */
                            justify-content: center;
                            /* Center children horizontally */
                        }

                        /* .btn .material-icons {
                            margin-right: 8px;
                        } */
                    </style>

                    <div class="row mb-1">
                        <div class="col-6">
                            <a href="/projects/{{ $project->id }}/kanbanBoard" class="kbtn btn-info btn-lg btn-block">
                                <i class="material-icons">dashboard</i>&nbsp; Kanban Board</button>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/projects/{{ $project->id }}/meeting" class="kbtn btn-info btn-lg btn-block">
                                <i class="material-icons">video_call</i>&nbsp; Video Call</a>
                        </div>
                    </div>

                    {{-- Project Details Card Start --}}
                    <x-project-hero :project="$project" :roles="$roles" />
                    {{-- Project Details Card End --}}


                    {{-- <div class="content-list-body">
                        <form class="checklist">
                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-1"
                                            checked />
                                        <label class="custom-control-label" for="checklist-item-1"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Create boards in Matboard" data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-2"
                                            checked />
                                        <label class="custom-control-label" for="checklist-item-2"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Invite team to boards" data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-3"
                                            checked />
                                        <label class="custom-control-label" for="checklist-item-3"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Identify three distinct aesthetic styles for boards"
                                                data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-4" />
                                        <label class="custom-control-label" for="checklist-item-4"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Add aesthetic style descriptions as notes"
                                                data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>

                            <div class="custom-control custom-checkbox col">
                                <input type="checkbox" class="custom-control-input" id="checklist-item-5" />
                                <label class="custom-control-label" for="checklist-item-5"></label>
                                <div>
                                    <input type="text" placeholder="Checklist item"
                                        value="Assemble boards using inspiration from Dribbble, Land Book, Nicely Done etc."
                                        data-filter-by="value" />
                                    <div class="checklist-strikethrough"></div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-6" />
                                        <label class="custom-control-label" for="checklist-item-6"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Gather feedback from project team" data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <span class="checklist-reorder">
                                        <i class="material-icons">reorder</i>
                                    </span>
                                    <div class="custom-control custom-checkbox col">
                                        <input type="checkbox" class="custom-control-input" id="checklist-item-7" />
                                        <label class="custom-control-label" for="checklist-item-7"></label>
                                        <div>
                                            <input type="text" placeholder="Checklist item"
                                                value="Invite clients to board before next concept meeting"
                                                data-filter-by="value" />
                                            <div class="checklist-strikethrough"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of form group-->
                            </div>
                        </form>
                        <div class="drop-to-delete">
                            <div class="drag-to-delete-title">
                                <i class="material-icons">delete</i>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Task Section Start --}}
                    <x-task-card :project="$project" :tasks="$tasks" />
                    {{-- Task Section End --}}


                    <button class="btn btn-primary btn-round btn-floating btn-lg" type="button" data-toggle="collapse"
                        data-target="#floating-chat" aria-expanded="false">
                        <i class="material-icons">chat_bubble</i>
                        <i class="material-icons">close</i>
                    </button>
                    <div class="collapse sidebar-floating" id="floating-chat">
                        <div class="sidebar-content">
                            <div class="chat-module" data-filter-list="chat-module-body">
                                <div class="chat-module-top">
                                    <form>
                                        <div class="input-group input-group-round">
                                            <a href="/projects/{{ $project->id }}/message" class="mx-2">See All
                                                Message</a>
                                        </div>
                                    </form>
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
        </div>
    </div>

    {{-- Toast Notification --}}
    <x-toast-noti />

</x-layout>

<script>
    // Toogle Script Start

    function toggleFormTask() {
        var form = document.getElementById("taskForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    function toggleFormMember() {
        event.preventDefault();
        var form = document.getElementById("memberForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    function toggleFormAssign(taskId) {
        event.preventDefault();
        var form = document.getElementById("assignForm-" + taskId);
        form.style.display = form.style.display === "none" ? "block" : "none";
    }

    // Toogle Script End


    // // CheckBox Script query, toast Start
    // document.querySelectorAll('.task-checkbox').forEach(function(checkbox) {
    //     checkbox.addEventListener('change', function() {
    //         var taskId = this.getAttribute(
    //             'value'); // Assuming the checkbox has a value attribute with the task ID
    //         var taskText = this.parentElement.querySelector('.task-text');
    //         if (this.checked) {
    //             taskText.classList.add('task-completed');
    //             // Correct URL construction for route model binding

    //             document.addEventListener('DOMContentLoaded', function() {
    //                 // Check if there's a Laravel session flash message for the toast
    //                 @if (session('toast'))
    //                     console.log('oka');
    //                     const toastLiveExample = document.getElementById('liveToast');
    //                     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(
    //                         toastLiveExample);
    //                     toastBootstrap.show();

    //                     // Optionally, clear the message after showing it to prevent it from reappearing on refresh
    //                     @php session()->forget('toast'); @endphp
    //                 @endif
    //             });

    //             window.location.href = '/task/toggle-completed/' + taskId;


    //         } else {
    //             taskText.classList.remove('task-completed');

    //             // const toastLiveExample = document.getElementById('liveToast')
    //             // const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    //             // toastBootstrap.show()
    //             // Optionally handle the uncheck action differently
    //             window.location.href = '/task/toggle-completed/' + taskId;
    //         }
    //     });
    // });
    // CheckBox Script query, toast Start

    var rolesSelect = new MultiSelectTag('roles');
</script>
