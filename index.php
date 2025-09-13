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
    padding: 30px 50px;
    color: #f00;
    text-align: center;
    z-index: 10;
    border-radius: 15px;
    box-shadow: 0 0 30px #f00, 0 0 60px #900;
  }

  #errorCard button {
    margin-top: 20px;
    padding: 10px 25px;
    font-family: 'Orbitron', monospace;
    font-weight: bold;
    cursor: pointer;
    background: #600;
    border: 2px solid #f00;
    color: #f00;
    border-radius: 10px;
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
  <div>ERROR: There was an issue with the system!</div>
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
  if(stopFalling) return; // stop all effects on error
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
  // turn background red and hide terminal border
  document.body.style.background = "#900";
  document.querySelector(".terminal").style.display = "none";
  document.getElementById("errorCard").style.display = "block";
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
