<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cyberpunk Loader</title>
<style>
  body {
    margin: 0;
    background: black;
    color: #0ff; /* neon blue text */
    font-family: 'Courier New', monospace;
    overflow: hidden;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  canvas {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
  }

  .terminal {
    position: relative;
    z-index: 2;
    width: 600px;
    background: #111;
    padding: 20px;
    border: 2px solid #0ff;
    box-shadow: 0 0 20px #0ff, 0 0 40px #00f;
  }

  .terminal-output {
    height: 200px;
    overflow-y: auto;
    white-space: pre-wrap;
    font-size: 1rem;
  }

  .progress-bar {
    width: 100%;
    height: 20px;
    background: #222;
    border: 1px solid #0ff;
    margin-top: 15px;
    position: relative;
  }

  .progress {
    width: 0%;
    height: 100%;
    background: #0ff;
    animation: none;
  }

  #warningBox {
    display: none;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: darkred;
    color: black;
    font-size: 1.5rem;
    padding: 25px 50px;
    border: 2px solid red;
    box-shadow: 0 0 30px red, 0 0 60px darkred;
    text-align: center;
    z-index: 3;
  }

  #portfolioBtn {
    display: none;
    margin-top: 20px;
    padding: 12px 30px;
    font-size: 1.2rem;
    border: 2px solid red;
    background: black;
    color: red;
    cursor: pointer;
  }

  #portfolioBtn:hover {
    background: red;
    color: black;
    box-shadow: 0 0 20px red;
  }
</style>
</head>
<body>

<canvas id="fallingCode"></canvas>

<div class="terminal">
  <div class="terminal-output" id="terminalOutput"></div>
  <div class="progress-bar">
    <div class="progress" id="progress"></div>
  </div>
</div>

<div id="warningBox">
  SYSTEM CRITICAL ERROR! PROCEED WITH CAUTION.
  <br>
  <button id="portfolioBtn" onclick="goPortfolio()">ENTER PORTFOLIO</button>
</div>

<script>
// Falling code
const canvas = document.getElementById("fallingCode");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const characters = "01░▒▓█";
const fontSize = 18;
const columns = Math.floor(canvas.width / fontSize);
let drops = Array(columns).fill(1);

let stopFalling = false;
let normalColor = "#0ff";
let errorColor = "red";

function draw() {
  ctx.fillStyle = "rgba(0,0,0,0.15)";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.fillStyle = stopFalling ? errorColor : normalColor;
  ctx.font = fontSize + "px monospace";

  for (let i = 0; i < drops.length; i++) {
    const text = characters.charAt(Math.floor(Math.random() * characters.length));
    ctx.fillText(text, i * fontSize, drops[i] * fontSize);

    if (!stopFalling && drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
      drops[i] = 0;
    }
    drops[i]++;
  }
}
let fallingInterval = setInterval(draw, 50);

// Terminal loading
const terminalOutput = document.getElementById("terminalOutput");
const progressBar = document.getElementById("progress");

let terminalLines = [
  "Initializing system...",
  "Loading modules...",
  "Connecting to network...",
  "Authenticating...",
  "Decrypting data...",
  "Applying overrides...",
  "Finalizing..."
];

let currentLine = 0;
let progress = 0;

function loadTerminal() {
  if (currentLine < terminalLines.length) {
    terminalOutput.textContent += terminalLines[currentLine] + "\n";
    terminalOutput.scrollTop = terminalOutput.scrollHeight;
    currentLine++;
    progress += 100 / terminalLines.length;
    progressBar.style.width = progress + "%";
    setTimeout(loadTerminal, 1200);
  } else {
    triggerErrorImpact();
  }
}
loadTerminal();

// Error impact
function triggerErrorImpact() {
  stopFalling = true;
  let flashes = 0;

  const flashInterval = setInterval(() => {
    // Flash background
    document.body.style.background = flashes % 2 === 0 ? "red" : "black";

    // Flicker terminal border
    const terminal = document.querySelector('.terminal');
    terminal.style.borderColor = flashes % 2 === 0 ? "darkred" : "#0ff";

    // Flicker progress bar
    const progressBarEl = document.querySelector('.progress');
    progressBarEl.style.background = flashes % 2 === 0 ? "darkred" : "#0ff";

    // Terminal shake effect
    terminal.style.transform = `translate(${Math.random()*4-2}px, ${Math.random()*4-2}px)`;

    // Falling code jitter
    canvas.style.transform = `translateX(${Math.random()*2-1}px)`;

    flashes++;
    if (flashes > 6) {
      clearInterval(flashInterval);
      terminal.style.transform = `translate(0,0)`;
      canvas.style.transform = `translateX(0)`;
      showWarning();
    }
  }, 150);
}

function showWarning() {
  const warningBox = document.getElementById("warningBox");
  const portfolioBtn = document.getElementById("portfolioBtn");

  warningBox.style.display = "block"; // Show the warning container
  portfolioBtn.style.display = "inline-block"; // Show the button

  portfolioBtn.addEventListener("click", goPortfolio);
}

function goPortfolio() {
  window.location.href = "portfolio.php"; // Replace with your portfolio page
}

</script>
</body>
</html>
