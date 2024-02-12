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

</head>

<body id="home">
    <x-navbar />

    @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
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
                            // Handle success if needed
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
                        console.log("success");
                        console.log(response.task.is_completed);

                        // Toggle checkbox state based on task completion status
                        checkbox.prop('checked', response.task.is_completed);

                        // Update corresponding task text styling
                        var taskContainer = checkbox.closest('.task-container');
                        var taskText = taskContainer.find('.task-text');
                        if (response.task.is_completed) {
                            taskText.addClass('task-completed');
                        } else {
                            taskText.removeClass('task-completed');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("fail");
                        // Handle error
                    }
                });
            });
        });
    </script>


</body>

</html>
