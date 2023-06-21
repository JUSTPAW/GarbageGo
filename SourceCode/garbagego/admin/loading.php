<!DOCTYPE html>
<html>
<head>
  <style>
    /* CSS for the loading screen */
    .loading-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f2f2f2;
    }

    .loading-spinner {
      border: 8px solid #026601; /* Updated color */
      border-top: 8px solid #f3f3f3;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 2s linear infinite;
    }

    .loading-text {
      margin-top: 20px;
      font-size: 24px;
      font-weight: bold;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* CSS for the admin page */
    .admin-page {
      display: none;
      /* Add styles for your admin page here */
    }
  </style>
</head>
<body>
  <div class="loading-container">
    <div class="loading-spinner"></div>
    <div class="loading-text">GarbageGo</div> <!-- Added loading text -->
  </div>

  <div class="admin-page">
    <!-- Add your admin page content here -->
    <h1>Welcome to the Admin Page!</h1>
    <!-- Rest of your admin page content -->
  </div>

  <script>
    // Simulating a delay for demonstration purposes
    setTimeout(showAdminPage, 2000);

    function showAdminPage() {
      document.querySelector('.loading-container').style.display = 'none';
      document.querySelector('.admin-page').style.display = 'block';
    }
  </script>
</body>
</html>
