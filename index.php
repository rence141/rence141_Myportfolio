<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cyberpunk Loader</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
<style>
  body {
    margin: 0;
    background: radial-gradient(ellipse at center, #0a0a0a 0%, #000000 100%);
    color: #4dd0e1; /* softer cyan text */
    font-family: 'Orbitron', 'Courier New', monospace;
    overflow: hidden;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
  }

  /* Enhanced background effects */
  body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
      radial-gradient(circle at 20% 80%, rgba(77, 208, 225, 0.05) 0%, transparent 50%),
      radial-gradient(circle at 80% 20%, rgba(156, 39, 176, 0.05) 0%, transparent 50%),
      radial-gradient(circle at 40% 40%, rgba(76, 175, 80, 0.03) 0%, transparent 50%);
    z-index: -1;
    animation: backgroundPulse 6s ease-in-out infinite alternate;
  }

  @keyframes backgroundPulse {
    0% { opacity: 0.2; }
    100% { opacity: 0.4; }
  }

  canvas {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
  }

  /* Additional particle canvas */
  #particles {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    pointer-events: none;
  }

  /* Glitch effect overlay */
  .glitch-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
      repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(77, 208, 225, 0.02) 2px,
        rgba(77, 208, 225, 0.02) 4px
      );
    z-index: 2;
    pointer-events: none;
    animation: glitchScan 0.1s linear infinite;
  }

  @keyframes glitchScan {
    0% { transform: translateY(0); }
    100% { transform: translateY(4px); }
  }

  .terminal {
    position: relative;
    z-index: 3;
    width: 600px;
    background: linear-gradient(145deg, #0a0a0a, #1a1a1a);
    padding: 30px;
    border: 2px solid #4dd0e1;
    box-shadow: 
      0 0 15px rgba(77, 208, 225, 0.3), 
      0 0 30px rgba(77, 208, 225, 0.1),
      inset 0 0 20px rgba(77, 208, 225, 0.05);
    border-radius: 10px;
    backdrop-filter: blur(10px);
  }

  .terminal::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #4dd0e1, #9c27b0, #4caf50, #ff9800, #4dd0e1);
    border-radius: 12px;
    z-index: -1;
    animation: borderGlow 4s linear infinite;
    opacity: 0.6;
  }

  @keyframes borderGlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .terminal-output {
    height: 200px;
    overflow-y: auto;
    white-space: pre-wrap;
    font-size: 1rem;
    text-shadow: 0 0 3px #4dd0e1;
    font-family: 'Orbitron', monospace;
    font-weight: 300;
  }

  .terminal-output::-webkit-scrollbar {
    width: 8px;
  }

  .terminal-output::-webkit-scrollbar-track {
    background: rgba(77, 208, 225, 0.1);
    border-radius: 4px;
  }

  .terminal-output::-webkit-scrollbar-thumb {
    background: #4dd0e1;
    border-radius: 4px;
    box-shadow: 0 0 3px #4dd0e1;
  }

  .progress-bar {
    width: 100%;
    height: 25px;
    background: linear-gradient(90deg, #111, #222, #111);
    border: 2px solid #4dd0e1;
    margin-top: 20px;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 
      inset 0 0 10px rgba(0, 0, 0, 0.5),
      0 0 8px rgba(77, 208, 225, 0.2);
  }

  .progress-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    animation: progressShine 2s infinite;
  }

  @keyframes progressShine {
    0% { left: -100%; }
    100% { left: 100%; }
  }

  .progress {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #4dd0e1, #2196f3, #4dd0e1);
    background-size: 200% 100%;
    animation: progressFlow 3s ease-in-out infinite;
    border-radius: 10px;
    position: relative;
  }

  @keyframes progressFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  #warningBox {
    display: none;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: linear-gradient(145deg, #8B0000, #DC143C);
    color: white;
    font-size: 1.5rem;
    padding: 30px 60px;
    border: 3px solid #ff0000;
    border-radius: 15px;
    box-shadow: 
      0 0 30px #ff0000, 
      0 0 60px #8B0000,
      inset 0 0 20px rgba(255, 0, 0, 0.3);
    text-align: center;
    z-index: 10;
    font-family: 'Orbitron', monospace;
    font-weight: bold;
    text-shadow: 0 0 10px #ffffff;
    backdrop-filter: blur(10px);
  }

  #warningBox::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    background: linear-gradient(45deg, #ff0000, #ff4500, #ff0000, #ff4500, #ff0000);
    border-radius: 18px;
    z-index: -1;
    animation: warningGlow 1s linear infinite;
  }

  @keyframes warningGlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  #portfolioBtn {
    display: none;
    margin-top: 25px;
    padding: 15px 40px;
    font-size: 1.3rem;
    border: 3px solid #ff0000;
    background: linear-gradient(145deg, #000000, #1a1a1a);
    color: #ff0000;
    cursor: pointer;
    border-radius: 25px;
    font-family: 'Orbitron', monospace;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  #portfolioBtn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 0, 0, 0.3), transparent);
    transition: left 0.5s;
  }

  #portfolioBtn:hover::before {
    left: 100%;
  }

  #portfolioBtn:hover {
    background: linear-gradient(145deg, #ff0000, #ff4500);
    color: white;
    box-shadow: 
      0 0 20px #ff0000,
      0 0 40px #ff0000,
      inset 0 0 20px rgba(255, 255, 255, 0.2);
    transform: scale(1.1) translateY(-2px);
    border-color: #ff4500;
  }

  /* Modern loading animations */
  .terminal {
    animation: slideInUp 1s ease-out;
  }

  @keyframes slideInUp {
    from {
      transform: translateY(50px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .progress {
    animation: progressGlow 2s ease-in-out infinite alternate;
  }

  @keyframes progressGlow {
    from {
      box-shadow: 0 0 5px #0ff;
    }
    to {
      box-shadow: 0 0 20px #0ff, 0 0 30px #00f;
    }
  }
</style>
</head>
<body>

<canvas id="fallingCode"></canvas>
<canvas id="particles"></canvas>
<div class="glitch-overlay"></div>

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
// Enhanced falling code with more characters and effects
const canvas = document.getElementById("fallingCode");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const characters = "01░▒▓█▌▐▄▀■▲◆●✦✧✪✫✬✭✮✯✰✱✲✳✴✵✶✷✸✹✺✻✼✽✾✿";
const fontSize = 16;
const columns = Math.floor(canvas.width / fontSize);
let drops = Array(columns).fill(1);

let stopFalling = false;
let normalColor = "#4dd0e1";
let errorColor = "#e57373";
let glitchMode = false;

function draw() {
  ctx.fillStyle = "rgba(0,0,0,0.15)";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  
  if (glitchMode) {
    // Add glitch effect
    ctx.fillStyle = "rgba(229,115,115,0.08)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
  }
  
  ctx.fillStyle = stopFalling ? errorColor : normalColor;
  ctx.font = fontSize + "px 'Orbitron', monospace";
  ctx.shadowColor = stopFalling ? errorColor : normalColor;
  ctx.shadowBlur = 5;

  for (let i = 0; i < drops.length; i++) {
    const text = characters.charAt(Math.floor(Math.random() * characters.length));
    const x = i * fontSize;
    const y = drops[i] * fontSize;
    
    // Add some randomness to make it more dynamic
    const offsetX = glitchMode ? (Math.random() - 0.5) * 4 : 0;
    const offsetY = glitchMode ? (Math.random() - 0.5) * 4 : 0;
    
    ctx.fillText(text, x + offsetX, y + offsetY);

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
  "> Initializing neural interface...",
  "> Loading quantum modules...",
  "> Establishing secure connection...",
  "> Authenticating user credentials...",
  "> Decrypting classified data...",
  "> Applying system overrides...",
  "> Finalizing initialization...",
  "> WARNING: Unauthorized access detected!",
  "> CRITICAL ERROR: System compromised!"
];

let currentLine = 0;
let progress = 0;

function loadTerminal() {
  if (currentLine < terminalLines.length) {
    // Add typing effect
    const line = terminalLines[currentLine];
    let charIndex = 0;
    
    function typeChar() {
      if (charIndex < line.length) {
        terminalOutput.textContent += line[charIndex];
        terminalOutput.scrollTop = terminalOutput.scrollHeight;
        charIndex++;
        setTimeout(typeChar, 50);
      } else {
        terminalOutput.textContent += "\n";
        terminalOutput.scrollTop = terminalOutput.scrollHeight;
        currentLine++;
        progress += 100 / terminalLines.length;
        progressBar.style.width = progress + "%";
        
        // Add glitch effect for warning lines
        if (line.includes("WARNING") || line.includes("ERROR")) {
          glitchMode = true;
          setTimeout(() => { glitchMode = false; }, 1000);
        }
        
        setTimeout(loadTerminal, 800);
      }
    }
    
    typeChar();
  } else {
    triggerErrorImpact();
  }
}
loadTerminal();

// Enhanced error impact with more dramatic effects
function triggerErrorImpact() {
  stopFalling = true;
  glitchMode = true;
  let flashes = 0;

  // Add screen shake effect
  document.body.style.animation = "screenShake 0.1s infinite";
  
  const flashInterval = setInterval(() => {
    // Flash background with more colors
    const colors = ["#e57373", "#000000", "#ff8a65", "#000000", "#d32f2f"];
    document.body.style.background = colors[flashes % colors.length];

    // Flicker terminal border
    const terminal = document.querySelector('.terminal');
    terminal.style.borderColor = flashes % 2 === 0 ? "#e57373" : "#4dd0e1";
    terminal.style.boxShadow = flashes % 2 === 0 ? 
      "0 0 20px #e57373, 0 0 40px #e57373" : 
      "0 0 15px #4dd0e1, 0 0 30px #4dd0e1";

    // Flicker progress bar
    const progressBarEl = document.querySelector('.progress');
    progressBarEl.style.background = flashes % 2 === 0 ? 
      "linear-gradient(90deg, #e57373, #ff8a65, #e57373)" : 
      "linear-gradient(90deg, #4dd0e1, #2196f3, #4dd0e1)";

    // Enhanced terminal shake effect
    const shakeX = (Math.random() - 0.5) * 8;
    const shakeY = (Math.random() - 0.5) * 8;
    terminal.style.transform = `translate(${shakeX}px, ${shakeY}px) rotate(${(Math.random() - 0.5) * 2}deg)`;

    // Enhanced falling code jitter
    canvas.style.transform = `translateX(${Math.random()*4-2}px) translateY(${Math.random()*2-1}px)`;

    flashes++;
    if (flashes > 8) {
      clearInterval(flashInterval);
      document.body.style.animation = "";
      terminal.style.transform = `translate(0,0) rotate(0deg)`;
      canvas.style.transform = `translateX(0) translateY(0)`;
      glitchMode = false;
      showWarning();
    }
  }, 100);
}

// Add screen shake animation
const style = document.createElement('style');
style.textContent = `
  @keyframes screenShake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-2px); }
    75% { transform: translateX(2px); }
  }
`;
document.head.appendChild(style);

function showWarning() {
  const warningBox = document.getElementById("warningBox");
  const portfolioBtn = document.getElementById("portfolioBtn");

  warningBox.style.display = "block"; // Show the warning container
  portfolioBtn.style.display = "inline-block"; // Show the button

  portfolioBtn.addEventListener("click", goPortfolio);
}

function goPortfolio() {
  // Add exit animation
  document.body.style.animation = "fadeOut 1s ease-out forwards";
  setTimeout(() => {
    window.location.href = "portfolio.php";
  }, 1000);
}

// Add fade out animation
const fadeStyle = document.createElement('style');
fadeStyle.textContent = `
  @keyframes fadeOut {
    0% { opacity: 1; }
    100% { opacity: 0; }
  }
`;
document.head.appendChild(fadeStyle);

// Particle System
const particlesCanvas = document.getElementById("particles");
const particlesCtx = particlesCanvas.getContext("2d");
particlesCanvas.width = window.innerWidth;
particlesCanvas.height = window.innerHeight;

let particles = [];
let mouseX = 0;
let mouseY = 0;

class Particle {
  constructor() {
    this.x = Math.random() * particlesCanvas.width;
    this.y = Math.random() * particlesCanvas.height;
    this.vx = (Math.random() - 0.5) * 0.5;
    this.vy = (Math.random() - 0.5) * 0.5;
    this.size = Math.random() * 3 + 1;
    this.opacity = Math.random() * 0.5 + 0.2;
    this.color = Math.random() > 0.5 ? '#4dd0e1' : '#9c27b0';
  }

  update() {
    this.x += this.vx;
    this.y += this.vy;

    // Mouse interaction
    const dx = mouseX - this.x;
    const dy = mouseY - this.y;
    const distance = Math.sqrt(dx * dx + dy * dy);
    
    if (distance < 100) {
      const force = (100 - distance) / 100;
      this.vx += (dx / distance) * force * 0.01;
      this.vy += (dy / distance) * force * 0.01;
    }

    // Boundary check
    if (this.x < 0 || this.x > particlesCanvas.width) this.vx *= -1;
    if (this.y < 0 || this.y > particlesCanvas.height) this.vy *= -1;

    // Limit velocity
    const maxSpeed = 2;
    const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
    if (speed > maxSpeed) {
      this.vx = (this.vx / speed) * maxSpeed;
      this.vy = (this.vy / speed) * maxSpeed;
    }
  }

  draw() {
    particlesCtx.beginPath();
    particlesCtx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    particlesCtx.fillStyle = this.color + Math.floor(this.opacity * 255).toString(16).padStart(2, '0');
    particlesCtx.fill();
    
    // Add glow effect
    particlesCtx.shadowColor = this.color;
    particlesCtx.shadowBlur = 10;
  }
}

// Initialize particles
for (let i = 0; i < 80; i++) {
  particles.push(new Particle());
}

function animateParticles() {
  particlesCtx.clearRect(0, 0, particlesCanvas.width, particlesCanvas.height);
  
  particles.forEach(particle => {
    particle.update();
    particle.draw();
  });

  // Draw connections between nearby particles
  for (let i = 0; i < particles.length; i++) {
    for (let j = i + 1; j < particles.length; j++) {
      const dx = particles[i].x - particles[j].x;
      const dy = particles[i].y - particles[j].y;
      const distance = Math.sqrt(dx * dx + dy * dy);

      if (distance < 120) {
        particlesCtx.beginPath();
        particlesCtx.moveTo(particles[i].x, particles[i].y);
        particlesCtx.lineTo(particles[j].x, particles[j].y);
        particlesCtx.strokeStyle = `rgba(77, 208, 225, ${0.05 * (1 - distance / 120)})`;
        particlesCtx.lineWidth = 1;
        particlesCtx.stroke();
      }
    }
  }

  requestAnimationFrame(animateParticles);
}

animateParticles();

// Mouse tracking
document.addEventListener('mousemove', (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
});

// Resize handler
window.addEventListener('resize', () => {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  particlesCanvas.width = window.innerWidth;
  particlesCanvas.height = window.innerHeight;
  drops = Array(Math.floor(canvas.width / fontSize)).fill(1);
});

</script>
</body>
</html>
