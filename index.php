<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
<title>Hacker Loader</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
=======
<title>My GitHub Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
>>>>>>> 3eacced (test)
<style>
  :root {
    --bg-color: rgba(0,0,0,0.4);
    --text-color: #fff;
    --accent-color: #0f0;
    --border-color: #0f0;
    --container-bg: rgba(0,0,0,0.4);
    --nav-bg: rgba(0,0,0,0.6);
  }
  
  [data-theme="dark"] {
    --bg-color: rgba(0,0,0,0.7);
    --text-color: #fff;
    --accent-color: #00ffaa;
    --border-color: #00ffaa;
    --container-bg: rgba(0,0,0,0.7);
    --nav-bg: rgba(0,0,0,0.8);
  }
  
  /* Animation keyframes */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes slideInFromBottom {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  @keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
  }

  @keyframes glow {
    0% { box-shadow: 0 0 5px var(--accent-color); }
    50% { box-shadow: 0 0 20px var(--accent-color); }
    100% { box-shadow: 0 0 5px var(--accent-color); }
  }
  
  body {
    margin: 0;
<<<<<<< HEAD
    background: black;
    font-family: 'Orbitron', monospace;
    overflow: hidden;
=======
    font-family: 'Orbitron', monospace;
>>>>>>> 3eacced (test)
    height: 100vh;
    overflow: hidden;
    color: var(--text-color);
    display: flex;
    justify-content: center;
    align-items: center;
    background: black;
    position: relative;
<<<<<<< HEAD
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
=======
    transition: all 0.3s ease;
  }

  /* Video background */
  #bgVideo {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
    filter: brightness(0.5);
  }

  /* Navbar */
  nav {
    position: fixed;
    top: 0;
    width: 100%;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    background: var(--nav-bg);
    z-index: 2;
    backdrop-filter: blur(5px);
    transition: background 0.3s ease, padding 0.3s;
    flex-wrap: wrap;
    align-items: center;
  }
  
  /* Dark mode toggle */
  .theme-switch {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    margin-right: 15px;
  }
  
  .theme-switch-icon {
    font-size: 1.2rem;
    margin-right: 5px;
    color: var(--accent-color);
  }

  nav button {
    padding: 8px 16px;
    font-family: 'Orbitron', monospace;
    cursor: pointer;
    background: var(--accent-color);
    border: none;
    border-radius: 8px;
    color: #000;
    font-weight: bold;
    transition: background 0.3s ease;
    border-radius: 8px;
    color: #000;
    font-weight: bold;
  }

  nav button:hover {
    background: #00ff99;
    color: #000;
  }

  .container {
  text-align: center;
  z-index: 1;
  background: var(--container-bg);
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 0 20px var(--accent-color);
  width: 90%;
  max-width: 400px;
  transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s;
  animation: fadeIn 1s ease-out, slideInFromBottom 1s ease-out;
}

.container:hover {
  transform: translateY(-5px);
  box-shadow: 0 0 25px var(--accent-color);
}

  .pfp {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent-color);
    margin: 20px auto;
    display: block;
    transition: transform 0.5s, border 0.3s ease, box-shadow 0.3s;
    animation: pulse 2s infinite ease-in-out;
    box-shadow: 0 0 10px var(--accent-color);
  }

  .pfp.loaded {
    transform: rotateY(360deg);
    animation: float 3s infinite ease-in-out;
  }
  
  .pfp:hover {
    transform: scale(1.1) rotate(5deg);
    border-width: 4px;
    box-shadow: 0 0 20px var(--accent-color);
  }

  h1, h3, p {
    margin: 10px 0;
  }

  a {
    display: inline-block;
    color: var(--accent-color);
    text-decoration: none;
    margin: 10px;
    font-weight: bold;
    transition: color 0.3s ease;
  }

  a:hover {
    color: #00ff99;
    filter: brightness(1.2);
  }

  /* Media Queries for Responsive Design */
  @media (max-width: 768px) {
    .container {
      width: 95%;
      padding: 20px;
      margin-top: 20px;
    }
    
    .github-stats {
      flex-direction: column;
      gap: 10px;
    }
    
    .stat-box {
      width: 100%;
    }
    
    nav {
      flex-direction: column;
      padding: 10px;
    }
    
    nav > div:first-child {
      margin-bottom: 10px;
    }
    
    .pfp {
      width: 120px;
      height: 120px;
    }
  }
  
  @media (max-width: 480px) {
    body {
      font-size: 14px;
    }
    
    .container {
      padding: 15px;
    }
    
    h1 {
      font-size: 1.5rem;
    }
    
    .pfp {
      width: 100px;
      height: 100px;
    }
    
    div[style*="display: flex; justify-content: center; gap: 10px;"] {
      flex-direction: column;
      gap: 10px;
    }
    
    a[id="githubLink"], a[id="githubRepoLink"] {
      display: block;
      margin: 5px 0;
    }
>>>>>>> 3eacced (test)
  }
</style>
</head>
<body>

<<<<<<< HEAD
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
=======
<!-- Background video -->
<video autoplay muted loop id="bgVideo">
  <source src="mp4/cyberpunk-2077-car-radio-moewalls-com.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>

<!-- Navbar -->
<nav>
  <div>My Portfolio</div>
  <div style="display: flex; align-items: center;">
    <div class="theme-switch" onclick="toggleTheme()">
      <span class="theme-switch-icon">🌓</span>
      <span id="theme-text">Dark Mode</span>
    </div>
    <button onclick="playAudio()">Play Audio</button>
  </div>
  <audio id="navAudio" src="mp3/te conocí (super slowed) - bxkq [edit audio].mp3" loop></audio>
</nav>

<!-- Profile Card -->
<div class="container" id="profileCard">
  <img src="" alt="GitHub Avatar" class="pfp" id="githubAvatar">
  <h1 id="githubName"></h1>
  <div id="githubBadge" style="margin: 10px 0; display: none;">
    <span style="background: var(--accent-color); color: #000; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">Developer</span>
  </div>
  <p id="githubBio"></p>
  <div class="github-stats" style="display: flex; justify-content: center; gap: 15px; margin: 15px 0;">
     <div class="stat-box" style="background: rgba(0,0,0,0.3); padding: 10px; border-radius: 10px; border: 1px solid var(--border-color); transition: all 0.3s ease; animation: fadeIn 0.5s ease-out; animation-delay: 0.2s;" onmouseover="this.style.transform='scale(1.05)';this.style.boxShadow='0 0 10px var(--accent-color)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='none'">
       <div style="font-size: 1.5rem; font-weight: bold;" id="githubRepos">0</div>
       <div>Repositories</div>
     </div>
     <div class="stat-box" style="background: rgba(0,0,0,0.3); padding: 10px; border-radius: 10px; border: 1px solid var(--border-color); transition: all 0.3s ease; animation: fadeIn 0.5s ease-out; animation-delay: 0.4s;" onmouseover="this.style.transform='scale(1.05)';this.style.boxShadow='0 0 10px var(--accent-color)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='none'">
       <div style="font-size: 1.5rem; font-weight: bold;" id="githubFollowers">0</div>
       <div>Followers</div>
     </div>
     <div class="stat-box" style="background: rgba(0,0,0,0.3); padding: 10px; border-radius: 10px; border: 1px solid var(--border-color); transition: all 0.3s ease; animation: fadeIn 0.5s ease-out; animation-delay: 0.6s;" onmouseover="this.style.transform='scale(1.05)';this.style.boxShadow='0 0 10px var(--accent-color)'" onmouseout="this.style.transform='scale(1)';this.style.boxShadow='none'">
       <div style="font-size: 1.5rem; font-weight: bold;" id="githubFollowing">0</div>
       <div>Following</div>
     </div>
   </div>
  <div id="githubLocation" style="margin-bottom: 10px;"></div>
  <div style="display: flex; justify-content: center; gap: 10px;">
     <a href="#" id="githubLink" target="_blank" style="background: var(--accent-color); color: #000; padding: 8px 15px; border-radius: 8px; transition: all 0.3s ease; animation: fadeIn 0.5s ease-out; animation-delay: 0.8s; transform: translateY(0);" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">View Profile</a>
     <a href="#" id="githubRepoLink" target="_blank" style="background: rgba(0,0,0,0.3); color: var(--accent-color); padding: 8px 15px; border-radius: 8px; border: 1px solid var(--accent-color); transition: all 0.3s ease; animation: fadeIn 0.5s ease-out; animation-delay: 1s; transform: translateY(0);" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">View Repositories</a>
   </div>
</div>

<script>
// Check for saved theme preference or set default
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
  document.getElementById('theme-text').textContent = savedTheme === 'dark' ? 'Light Mode' : 'Dark Mode';
});

// Toggle theme function
function toggleTheme() {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
  
  document.documentElement.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  
  // Update toggle text
  document.getElementById('theme-text').textContent = newTheme === 'dark' ? 'Light Mode' : 'Dark Mode';
}

const githubUsername = "rence141"; // Your GitHub username

// Navbar audio autoplay
window.addEventListener('load', () => {
  const audio = document.getElementById('navAudio');
  audio.volume = 0.5;
  audio.play().catch(() => {
    console.log("Autoplay blocked, click Play Audio button.");
  });

  // Fetch your GitHub profile automatically
  fetch(`https://api.github.com/users/${githubUsername}`)
    .then(res => res.json())
    .then(data => {
      displayGithubProfile(data);
    })
    .catch(err => {
      console.error("Error fetching GitHub profile:", err);
    });
});

// Function to display GitHub profile
function displayGithubProfile(data) {
  // Set avatar with animation
  document.getElementById('githubAvatar').src = data.avatar_url;
  document.getElementById('githubAvatar').classList.add('loaded');
  
  // Set name and show badge
  document.getElementById('githubName').textContent = data.name || data.login;
  document.getElementById('githubBadge').style.display = 'block';
  
  // Set bio with fallback
  document.getElementById('githubBio').textContent = data.bio || 'No bio available';
  
  // Set stats with animation
  const reposEl = document.getElementById('githubRepos');
  const followersEl = document.getElementById('githubFollowers');
  const followingEl = document.getElementById('githubFollowing');
  
  // Animate the numbers counting up
  animateValue(reposEl, 0, data.public_repos, 1000);
  animateValue(followersEl, 0, data.followers, 1000);
  animateValue(followingEl, 0, data.following, 1000);
  
  // Set location if available
  if (data.location) {
    document.getElementById('githubLocation').innerHTML = `<i style="margin-right: 5px;">📍</i>${data.location}`;
  } else {
    document.getElementById('githubLocation').style.display = 'none';
  }
  
  // Set links
  document.getElementById('githubLink').href = data.html_url;
  document.getElementById('githubRepoLink').href = `${data.html_url}?tab=repositories`;
}

// Function to animate counting up
function animateValue(obj, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    obj.innerHTML = Math.floor(progress * (end - start) + start);
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

function playAudio() {
  document.getElementById('navAudio').play();
}
>>>>>>> 3eacced (test)
</script>

</body>
</html>
