{{-- Toast Notification --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-bell me-2"></i>
            <strong class="me-auto">Success</strong>
            <small>now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Task Updated Successfully
        </div>
    </div>
</div>

{{-- Toast Session Check --}}
@if (session('toast'))
    <script>
        const toastLiveExample = document.getElementById('liveToast');
        const toastBootstrap = new bootstrap.Toast(toastLiveExample);
        toastBootstrap.show();
    </script>
@endif
