<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cyberpunk Landing Page</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: black;
      color: #0ff;
      font-family: 'Courier New', monospace;
      overflow: hidden;
    }

    .landing-container {
      text-align: center;
      z-index: 2;
    }

    h1 {
      font-size: 4rem;
      text-shadow: 0 0 10px #0ff, 0 0 20px #f0f, 0 0 30px #0ff;
    }

    .start-btn {
      margin-top: 20px;
      padding: 15px 40px;
      font-size: 1.5rem;
      border: 2px solid #0ff;
      background: transparent;
      color: #0ff;
      cursor: pointer;
      text-shadow: 0 0 10px #0ff;
      transition: all 0.3s ease;
    }

    .start-btn:hover {
      background: #0ff;
      color: black;
      box-shadow: 0 0 20px #0ff;
    }

    /* Loading screen */
    .loading-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: black;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 10;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.5s ease;
    }

    .loading-screen.active {
      opacity: 1;
      pointer-events: all;
    }

    .loader {
      border: 5px solid #222;
      border-top: 5px solid #0ff;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      animation: spin 1s linear infinite;
      box-shadow: 0 0 20px #0ff;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .loading-text {
      margin-top: 20px;
      font-size: 1.5rem;
      text-shadow: 0 0 10px #0ff;
    }
  </style>
</head>
<body>
  <div class="landing-container">
    <h1>Welcome to My Portfolio</h1>
    <button class="start-btn" onclick="startPortfolio()">START</button>
  </div>

  <!-- Loading Screen -->
  <div class="loading-screen" id="loadingScreen">
    <div class="loader"></div>
    <div class="loading-text">Loading...</div>
  </div>

  <script>
    function startPortfolio() {
      const loadingScreen = document.getElementById('loadingScreen');
      loadingScreen.classList.add('active');

      // Simulate loading time then redirect
      setTimeout(() => {
        window.location.href = "portfolio.php"; // replace with your portfolio page
      }, 3000); // 3 seconds loading
    }
  </script>
</body>
</html>
