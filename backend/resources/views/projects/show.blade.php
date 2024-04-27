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
