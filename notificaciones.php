<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php

function toast($notificacion, $type) {
    $mensaje = '
    <div class="toast-container position-fixed top-0 start-0 p-3">
        <div class="toast align-items-center text-bg-'. $type . ' border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
             <div class="toast_header">
              <i class="fa-solid fa-triangle-exclamation"></i>
             </div>
                <div class="toast-body">
                    ' . htmlspecialchars($notificacion, ENT_QUOTES, 'UTF-8') . '
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var toastElList = [].slice.call(document.querySelectorAll(".toast"));
            toastElList.forEach(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });
    </script>';
    
    return $mensaje;
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!--
<div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
  <div class="toast-container position-absolute p-3" id="toastPlacement">
    <div class="toast">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small>11 mins ago</small>
      </div>
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
    </div>
  </div>
</div>
-->

<!-- 
<div class="toast-container position-fixed top-0 start-0 p-3">
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast_header">
              <i class="fa-solid fa-triangle-exclamation"></i>
              <strong class="me-auto">Error</strong>
            </div>
                <div class="toast-body">
                    ' . htmlspecialchars($notificacion, ENT_QUOTES, 'UTF-8') . '
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

-->