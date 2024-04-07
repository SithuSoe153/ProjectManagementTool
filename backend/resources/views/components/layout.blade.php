<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{ asset('/app.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>


    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css" />


    {{-- BootStrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    {{-- sortable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    {{-- socket cdn --}}
    <script src="https://cdn.socket.io/4.7.4/socket.io.min.js"
        integrity="sha384-Gr6Lu2Ajx28mzwyVR8CFkULdCU7kMlZ9UthllibdOSo6qAiN+yXNHqtgdTvFXMT4" crossorigin="anonymous">
    </script>


    {{-- pipeline --}}

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-52115242-14"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-52115242-14");
    </script>
    <meta charset="utf-8" />
    <title>Pipeline Project Management Bootstrap Theme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="A project management Bootstrap theme by Medium Rare" />
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet" />
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css" media="all" />


</head>

<body id="home">
    <x-navbar />


    @if (session()->has('success'))
        <div class="alert alert-success mx-auto my-2 col-9 text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif


    {{ $slot }}

    <x-footer />


    {{-- Toast Session Check Start --}}
    @if (session('toast'))
        <script>
            const toastLiveExample = document.getElementById('liveToast');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(
                toastLiveExample);
            toastBootstrap.show();
        </script>
        {{-- Optionally, clear the message after showing it to prevent it from reappearing on refresh --}}
        @php session()->forget('toast'); @endphp
    @endif
    {{-- Toast Session Check End --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>


    <script>
        $(function() {
            $("#sortable").sortable({
                placeholder: "ui-state-highlight"
            });
            $("#sortable").disableSelection();
        });




        //


        let ip_address = 'http://127.0.0.1:3000';
        let socket = io(ip_address);
        socket.on('connection');

        //

        // Listen for task position update event
        socket.on('taskPositionUpdated', (taskIds) => {
            console.log(taskIds);
            // Get the parent container of tasks
            const taskContainer = document.getElementById('sortable');
            // Get the array of all task elements
            const taskElements = Array.from(taskContainer.querySelectorAll('.card'));
            // Sort the task elements based on their taskId order
            taskElements.sort((a, b) => {
                const taskIdA = parseInt(a.querySelector('.task-container').getAttribute('data-task-id'));
                const taskIdB = parseInt(b.querySelector('.task-container').getAttribute('data-task-id'));
                return taskIds.indexOf(taskIdA) - taskIds.indexOf(taskIdB);
            });
            // Append the sorted task elements back to the task container
            taskElements.forEach(taskElement => taskContainer.appendChild(taskElement));
        });

        // Listen for task position update event
        socket.on('checkedTaskUpdated', (taskId) => {
            console.log(taskId);

            // Find the checkbox element based on taskId
            var checkbox = $('#task-' + taskId);

            // Toggle checkbox state based on task completion status
            checkbox.prop('checked', !checkbox.prop('checked'));

            // Update corresponding task text styling
            var taskContainer = checkbox.closest('.task-container');
            var taskText = taskContainer.find('.task-text');
            if (checkbox.prop('checked')) {
                taskText.addClass('task-completed');
            } else {
                taskText.removeClass('task-completed');
            }



            // if (response.toast) {
            // Create a new toast element
            const newToast = document.createElement('div');
            newToast.className = 'toast';
            newToast.setAttribute('role', 'alert');
            newToast.setAttribute('aria-live', 'assertive');
            newToast.setAttribute('aria-atomic', 'true');

            // Create the toast header
            const toastHeader = document.createElement('div');
            toastHeader.className = 'toast-header';
            toastHeader.innerHTML = `
                                                            <i class="fas fa-bell me-2"></i>
                                                            <strong class="me-auto">Success</strong>
                                                            <small>now</small>
                                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                        `;

            // Create the toast body
            const toastBody = document.createElement('div');
            toastBody.className = 'toast-body';
            toastBody.textContent = 'Task Successfully';

            // Append header and body to the toast element
            newToast.appendChild(toastHeader);
            newToast.appendChild(toastBody);

            // Append the new toast to the toast container
            const toastContainer = document.querySelector('.toast-container');
            toastContainer.appendChild(newToast);

            // Show the new toast
            const newToastInstance = new bootstrap.Toast(newToast);
            newToastInstance.show();
            // }
        });





        //
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var taskIds = [];
                    $("#sortable .task-container").each(function() {
                        taskIds.push($(this).data("task-id"));
                    });

                    // Send AJAX request to update task positions
                    $.ajax({
                        url: "/update-task-positions",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Include CSRF token in headers
                        },
                        data: {
                            taskIds: taskIds
                        },
                        success: function(response) {
                            socket.emit('updateTaskPosition', taskIds);

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });


                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.task-checkbox').click(function(event) {
                event.preventDefault();

                var checkbox = $(this);
                var taskId = checkbox.val();

                $.ajax({
                    url: '/task/toggle-completed/' + taskId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        socket.emit('updateCheckedTask', taskId);

                        // if (response.toast) {
                        //     const toastLiveExample = document.getElementById('liveToast');
                        //     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(
                        //         toastLiveExample);
                        //     toastBootstrap.show();
                        // }



                    },
                    error: function(xhr, status, error) {
                        console.log("fail");
                        // Handle error
                    }
                });
            });
        });
    </script>



    {{-- pipeline --}}
    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- Autosize - resizes textarea inputs as user types -->
    <script type="text/javascript" src="{{ asset('assets/js/autosize.min.js') }}"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
    <!-- Prism - displays formatted code boxes -->
    <script type="text/javascript" src="{{ asset('assets/js/prism.js') }}"></script>
    <!-- Shopify Draggable - drag, drop and sort items on page -->
    <script type="text/javascript" src="{{ asset('assets/js/draggable.bundle.legacy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swap-animation.js') }}"></script>
    <!-- Dropzone - drag and drop files onto the page for uploading -->
    <script type="text/javascript" src="{{ asset('assets/js/dropzone.min.js') }}"></script>
    <!-- List.js - filter list elements -->
    <script type="text/javascript" src="{{ asset('assets/js/list.min.js') }}"></script>

    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="{{ asset('assets/js/theme.js') }}"></script>


    <!-- This appears in the demo only - demonstrates different layouts -->
    <style type="text/css">
        .layout-switcher {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) translateY(73px);
            color: #fff;
            transition: all 0.35s ease;
            background: #343a40;
            border-radius: 0.25rem 0.25rem 0 0;
            padding: 0.75rem;
            z-index: 999;
        }

        .layout-switcher:not(:hover) {
            opacity: 0.95;
        }

        .layout-switcher:not(:focus) {
            cursor: pointer;
        }

        .layout-switcher-head {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .layout-switcher-head i {
            font-size: 1.25rem;
            transition: all 0.35s ease;
        }

        .layout-switcher-body {
            transition: all 0.55s ease;
            opacity: 0;
            padding-top: 0.75rem;
            transform: translateY(24px);
            text-align: center;
        }

        .layout-switcher:focus {
            opacity: 1;
            outline: none;
            transform: translateX(-50%) translateY(0);
        }

        .layout-switcher:focus .layout-switcher-head i {
            transform: rotateZ(180deg);
            opacity: 0;
        }

        .layout-switcher:focus .layout-switcher-body {
            opacity: 1;
            transform: translateY(0);
        }

        .layout-switcher-option {
            width: 72px;
            padding: 0.25rem;
            border: 2px solid rgba(255, 255, 255, 0);
            display: inline-block;
            border-radius: 4px;
            transition: all 0.35s ease;
        }

        .layout-switcher-option.active {
            border-color: #007bff;
        }

        .layout-switcher-icon {
            width: 100%;
            border-radius: 4px;
        }

        .layout-switcher-body:hover .layout-switcher-option:not(:hover) {
            opacity: 0.5;
            transform: scale(0.9);
        }

        @media all and (max-width: 990px) {
            .layout-switcher {
                min-width: 250px;
            }
        }

        @media all and (max-width: 767px) {
            .layout-switcher {
                display: none;
            }
        }
    </style>


</body>



</html>
