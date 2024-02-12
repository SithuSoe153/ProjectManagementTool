<x-layout>


    <div class="container my-4">

        {{-- Project Details Card Start --}}
        <x-project-hero :project="$project" :roles="$roles" />
        {{-- Project Details Card End --}}


        {{-- Task Section Start --}}
        <x-task-card :project="$project" :tasks="$tasks" />
        {{-- Task Section End --}}
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
