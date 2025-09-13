<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hacker Loader</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
<style>
  body {
    margin: 0;
    background: black;
    font-family: 'Orbitron', monospace;
    overflow: hidden;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    color: #0f0;
    transition: background 0.5s ease;
  }

  canvas {
    position: absolute;
    top: 0;
    left: 0;
  }

  .terminal {
    position: relative;
    z-index: 2;
    width: 600px;
    background: #111;
    padding: 20px;
    border: 2px solid #0f0;
    box-shadow: 0 0 20px #0f0, 0 0 40px #0f0;
    transition: opacity 0.5s ease;
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
    border: 1px solid #0f0;
    margin-top: 15px;
    border-radius: 12px;
    overflow: hidden;
  }

  .progress {
    width: 0%;
    height: 100%;
    background: #0f0;
  }

  #errorCard {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #900;
    border: 3px solid #f00;
    padding: 40px 60px;
    color: #f00;
    text-align: center;
    z-index: 10;
    border-radius: 20px;
    box-shadow: 0 0 40px #f00, 0 0 80px #900;
    animation: pulseRed 1s infinite alternate;
  }

  #errorCard h1 {
    font-size: 2rem;
    margin-bottom: 20px;
    text-shadow: 0 0 10px #f00, 0 0 20px #900;
  }

  #errorCard button {
    margin-top: 20px;
    padding: 15px 30px;
    font-family: 'Orbitron', monospace;
    font-weight: bold;
    cursor: pointer;
    background: #600;
    border: 2px solid #f00;
    color: #f00;
    border-radius: 12px;
    font-size: 1.2rem;
    text-transform: uppercase;
  }

  @keyframes pulseRed {
    0% { box-shadow: 0 0 20px #f00, 0 0 40px #900; transform: translate(-50%, -50%) scale(1); }
    50% { box-shadow: 0 0 40px #f00, 0 0 80px #900; transform: translate(-50%, -50%) scale(1.05); }
    100% { box-shadow: 0 0 20px #f00, 0 0 40px #900; transform: translate(-50%, -50%) scale(1); }
  }
</style>
</head>
<body>

<canvas id="fallingCode"></canvas>

<div class="terminal">
  <div class="terminal-output" id="terminalOutput"></div>
  <div class="progress-bar"><div class="progress" id="progress"></div></div>
</div>

<div id="errorCard">
  <h1>SYSTEM FAILURE!</h1>
  <p>An unexpected critical error occurred.</p>
  <button onclick="goPortfolio()">Proceed to Portfolio</button>
</div>

<script>
// Falling Code
const canvas = document.getElementById("fallingCode");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const characters = "01▒▓█▌▐▄▀■▲◆●✦✧";
const fontSize = 16;
let columns = Math.floor(canvas.width / fontSize);
let drops = Array(columns).fill(1);

let stopFalling = false;

function draw() {
  if(stopFalling) return;
  ctx.fillStyle = "rgba(0,0,0,0.15)";
  ctx.fillRect(0,0,canvas.width,canvas.height);
  ctx.fillStyle = "#0f0";
  ctx.font = fontSize + "px Orbitron";

  for(let i=0;i<drops.length;i++){
    const text = characters.charAt(Math.floor(Math.random()*characters.length));
    ctx.fillText(text, i*fontSize, drops[i]*fontSize);
    drops[i]++;
    if(drops[i]*fontSize > canvas.height && Math.random()>0.975) drops[i] = 0;
  }
}
let fallingInterval = setInterval(draw,50);

// Terminal loading
const terminalOutput = document.getElementById("terminalOutput");
const progressBar = document.getElementById("progress");

const lines = [
  "> Initializing modules...",
  "> Loading subsystems...",
  "> Authenticating...",
  "> Checking network...",
  "> WARNING: Unauthorized access detected!",
  "> CRITICAL ERROR: System failure!"
];

let currentLine = 0;
let progress = 0;

function loadTerminal(){
  if(currentLine < lines.length){
    const line = lines[currentLine];
    let i=0;
    function typeChar(){
      if(i<line.length){
        terminalOutput.textContent += line[i];
        terminalOutput.scrollTop = terminalOutput.scrollHeight;
        i++;
        setTimeout(typeChar,50);
      }else{
        terminalOutput.textContent += "\n";
        currentLine++;
        progress += 100/lines.length;
        progressBar.style.width = progress + "%";

        if(line.includes("WARNING") || line.includes("ERROR")){
          triggerError();
        }else{
          setTimeout(loadTerminal,500);
        }
      }
    }
    typeChar();
  }
}
loadTerminal();

// Error trigger
function triggerError(){
  stopFalling = true;
  clearInterval(fallingInterval);

  // Hide terminal
  const terminal = document.querySelector(".terminal");
  terminal.style.display = "none";

  const errorCard = document.getElementById("errorCard");
  errorCard.style.display = "block";

  // Full-body red flash and shake
  let flashes = 0;
  const flashInterval = setInterval(()=>{
    document.body.style.background = flashes % 2 === 0 ? "#f00" : "#900";
    document.body.style.transform = `translate(${Math.random()*10-5}px, ${Math.random()*10-5}px)`;
    flashes++;
    if(flashes > 6) {
      clearInterval(flashInterval);
      document.body.style.transform = "translate(0,0)";
      document.body.style.background = "#900"; // keep body red
    }
  }, 150);
}

// Button action
function goPortfolio(){
  window.location.href="portfolio.php";
}

// Resize handling
window.addEventListener('resize',()=>{
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  columns = Math.floor(canvas.width / fontSize);
  drops = Array(columns).fill(1);
});
</script>

</body>
</html>
