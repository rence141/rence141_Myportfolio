import { FormEvent, useEffect, useState } from "react";
import { profile } from "../data/profile";
import { projects } from "../data/projects";
import { ParticlePortrait } from "./ParticlePortrait";
import { GifParticles } from "./GifParticles";
import "./home-retro.css";

const introText = "Turning ideas into systems.";
const fonts = ["Space Grotesk", "Playfair Display", "VT323", "Permanent Marker", "Arial Black", "Courier New"];
const services = [
  ["Business websites & online stores", "A clear, mobile-friendly site that explains what you offer and makes the next step easy."],
  ["Dashboards & internal tools", "Orders, records and everyday tasks in one practical workspace instead of a pile of spreadsheets."],
  ["Automation & integrations", "Connect your tools and let routine steps, notifications and community tasks run themselves."],
];

function Splash({ onDone }: { onDone: () => void }) {
  const [typed, setTyped] = useState("");
  const [phase, setPhase] = useState<"typing" | "wipe" | "settled">("typing");
  const [font, setFont] = useState(fonts[0]);
  const [leaving, setLeaving] = useState(false);

  useEffect(() => {
    if (typed.length < introText.length) {
      const timer = window.setTimeout(() => setTyped(introText.slice(0, typed.length + 1)), 90);
      return () => window.clearTimeout(timer);
    }
    const wipe = window.setTimeout(() => setPhase("wipe"), 700);
    const settled = window.setTimeout(() => setPhase("settled"), 2400);
    const leave = window.setTimeout(() => setLeaving(true), 4600);
    const done = window.setTimeout(onDone, 5200);
    return () => [wipe, settled, leave, done].forEach(window.clearTimeout);
  }, [typed, onDone]);

  useEffect(() => {
    if (phase !== "settled") return;
    const timer = window.setInterval(() => setFont(fonts[Math.floor(Math.random() * fonts.length)]), 350);
    return () => window.clearInterval(timer);
  }, [phase]);

  return (
    <div className={`retro-splash${leaving ? " leaving" : ""}`}>
      <main className="intro-screen">
        <button className="intro-skip" type="button" onClick={onDone}>Skip intro <i className="fa-solid fa-forward" aria-hidden="true" /></button>
        <div className={`intro-panel ${phase}`}>
          <div className="intro-cycler" style={{ fontFamily: font }}>{introText}</div>
        </div>
        {phase !== "settled" && <div className="intro-type" aria-label={introText}>{typed}<span /></div>}
      </main>
    </div>
  );
}

export function Home({ splash }: { splash: boolean }) {
  const [showSplash, setShowSplash] = useState(() => splash && !sessionStorage.getItem("introSeen"));
  const [notice, setNotice] = useState("");

  function finishSplash() {
    sessionStorage.setItem("introSeen", "1");
    setShowSplash(false);
  }

  function sendMessage(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    const body = `${data.get("message")}\n\nFrom: ${data.get("name")}\nEmail: ${data.get("email")}`;
    window.location.href = `mailto:${profile.email}?subject=${encodeURIComponent(`Project inquiry from ${data.get("name")}`)}&body=${encodeURIComponent(body)}`;
    setNotice("Your email app should open with the message ready to send.");
  }

  return (
    <>
      {showSplash && <Splash onDone={finishSplash} />}
      <div className="retro" id="home">
        <header className="retro-masthead">
          <div className="retro-dateline"><span>{profile.location}</span><span>{new Date().toLocaleDateString("en-US", { weekday: "long", year: "numeric", month: "long", day: "numeric" })}</span><span>Independent &middot; Full-Stack</span></div>
          <h1>The {profile.shortName} Portfolio</h1>
          <p className="retro-motto">&ldquo;{introText}&rdquo;</p>
          <nav className="retro-nav" aria-label="Main navigation">
            <a href="#/portfolio#projects" onClick={() => document.getElementById("projects")?.scrollIntoView({ behavior: "smooth" })}>Projects</a> <b>|</b>{" "}
            <a href="#/portfolio#services" onClick={() => document.getElementById("services")?.scrollIntoView({ behavior: "smooth" })}>What I do</a> <b>|</b>{" "}
            <a href="#/portfolio#about" onClick={() => document.getElementById("about")?.scrollIntoView({ behavior: "smooth" })}>About</a> <b>|</b>{" "}
            <a href="#/portfolio#contact" onClick={() => document.getElementById("contact")?.scrollIntoView({ behavior: "smooth" })}>Contact</a>
          </nav>
        </header>

        <section className="retro-lead">
          <div className="retro-col">
            <h2>The Developer</h2>
            <p><strong>{profile.fullName}</strong> is a {profile.role.toLowerCase()} who turns ideas into reliable web systems with PHP, Laravel, React, and MySQL.</p>
            <p className="retro-stack" aria-label="Tech stack"><i className="fab fa-php" /> <i className="fab fa-js" /> <i className="fab fa-laravel" /> <i className="fab fa-react" /> <i className="fas fa-database" /></p>
            <p className="retro-status">Available for new projects</p>
          </div>
          <div className="retro-col retro-center">
            <ParticlePortrait src={profile.avatar} alt={profile.shortName} active={true} reducedMotion={false} />
            <small>Fig. 1 &mdash; {profile.shortName}, {profile.location}</small>
          </div>
          <div className="retro-col" id="services">
            <h2>What I Do</h2>
            <ul>{services.map(([title, text]) => <li key={title}><strong>{title}.</strong> {text}</li>)}</ul>
          </div>
        </section>

        <hr />
        <section id="projects">
          <h2>Projects</h2>
          <p>Selected work, including academic concepts and independent builds. Click a title for the full write-up and screenshots.</p>
          <div className="retro-projects">
            {projects.map((p, i) => (
              <article key={p.slug}>
                <a href={`#/project/${p.slug}`}><img src={p.heroImage} alt={`${p.title} preview`} loading="lazy" /></a>
                <small className="retro-kicker">No. {String(i + 1).padStart(2, "0")} &middot; {p.category}</small>
                <h3><a href={`#/project/${p.slug}`}>{p.title}</a></h3>
                <p>{p.summary}</p>
                <small>{p.tags.join(" / ")}</small>
              </article>
            ))}
          </div>
        </section>


        <hr />
        <section id="about" className="retro-about"><div className="retro-about-copy">
          <h2>About</h2>
          <p>Hi, I&rsquo;m Lorenze &mdash; you can call me Rence. I&rsquo;m a full-stack developer based in {profile.location}. My work spans online stores, learning platforms, collaboration tools, and community automation.</p>
          <p>I like turning complicated workflows into software that&rsquo;s easier to use. When we work together, you talk directly to the person building your solution.</p>
          <p>
            [ <a href={profile.socials.github} target="_blank" rel="noreferrer">GitHub</a> ] [ <a href={profile.socials.linkedin} target="_blank" rel="noreferrer">LinkedIn</a> ] [ <a href="/Resume_Lorenze_Prepotente_Updated.pdf" target="_blank" rel="noreferrer">Resume (PDF)</a> ]
          </p>
        </div><GifParticles src="/ims/gif-1.gif" />
        </section>

        <hr />
        <section id="contact">
          <h2>Contact</h2>
          <p>Tell me about your business and what you have in mind. No technical brief needed.</p>
          <p className="retro-contact-channels">
            Email: <a href={`mailto:${profile.email}`}>{profile.email}</a>
            <br />
            Phone: <a href={`tel:${profile.phone.replace(/\s/g, "")}`}>{profile.phone}</a>
          </p>
          <form className="retro-form" onSubmit={sendMessage}>
            <label>Your name<br /><input name="name" autoComplete="name" required /></label>
            <label>Email address<br /><input name="email" type="email" autoComplete="email" required /></label>
            <label>Your message<br /><textarea name="message" rows={5} maxLength={3000} required /></label>
            <button type="submit">Send message</button>
          </form>
          {notice && <p role="status" className="retro-status-notice">{notice}</p>}
        </section>

        <hr />
        <footer>
          <small>&copy; {new Date().getFullYear()} Lorenze Prepotente &mdash; Thoughtful code. Practical solutions. <a href="#/portfolio#home">Back to top</a></small>
        </footer>
      </div>
    </>
  );
}
