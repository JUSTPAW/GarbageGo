  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Modal Bottom Right</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      /* Custom CSS for the side modal */
      .side-modal {
        position: fixed;
        bottom: 0;
        right: 0;
        z-index: 1040;
        padding: 1rem;
        width: 300px;
        height: 100vh;
        background-color: #f8f9fa;
        border-left: 1px solid #dee2e6;
        overflow-y: auto;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
      }

      .side-modal.open {
        transform: translateX(0);
      }
    </style>
  </head>
  <body>
    <div id="sideModal" class="side-modal">
      <h4>Side Modal Content</h4>
      <p>This is the content of the side modal.</p>
    </div>

    <!-- Button to toggle the side modal -->
    <button id="toggleSideModal" class="btn btn-primary">Toggle Side Modal</button>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
      // JavaScript to handle the side modal toggle
      $(document).ready(function() {
        $('#toggleSideModal').click(function() {
          $('#sideModal').toggleClass('open');
        });
      });
    </script>
  </body>
  </html>
