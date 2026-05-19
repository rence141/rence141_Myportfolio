import { useEffect, useState } from "react";
import { profile } from "../data/profile";

const introText = "Turning ideas into systems.";
const fonts = ["Space Grotesk", "Playfair Display", "VT323", "Permanent Marker", "Arial Black", "Courier New"];

export function Intro() {
  const [typed, setTyped] = useState("");
  const [phase, setPhase] = useState<"typing" | "wipe" | "settled">("typing");
  const [font, setFont] = useState(fonts[0]);

  useEffect(() => {
    if (typed.length < introText.length) {
      const timer = window.setTimeout(() => setTyped(introText.slice(0, typed.length + 1)), 90);
      return () => window.clearTimeout(timer);
    }

    const wipeTimer = window.setTimeout(() => setPhase("wipe"), 700);
    const settledTimer = window.setTimeout(() => setPhase("settled"), 3600);

    return () => {
      window.clearTimeout(wipeTimer);
      window.clearTimeout(settledTimer);
    };
  }, [typed]);

  useEffect(() => {
    if (phase !== "settled") return;

    const timer = window.setInterval(() => {
      setFont(fonts[Math.floor(Math.random() * fonts.length)]);
    }, 180);

    return () => window.clearInterval(timer);
  }, [phase]);

  return (
    <main className="intro-screen">
      <div className={`intro-panel ${phase}`}>
        <div className="intro-cycler" style={{ fontFamily: font }}>
          {introText}
        </div>
      </div>

      {phase !== "settled" && (
        <div className="intro-type">
          {typed}
          <span />
        </div>
      )}

      <section className={`intro-card ${phase === "settled" ? "active" : ""}`}>
        <img src={profile.avatar} alt={profile.shortName} />
        <h1>{profile.shortName}</h1>
        <p className="pill">{profile.role}</p>

        <div className="stack-icons" aria-label="Tech stack">
          <i className="fab fa-php" />
          <i className="fab fa-js" />
          <i className="fab fa-laravel" />
          <i className="fab fa-react" />
          <i className="fas fa-database" />
        </div>

        <p>I turn ideas into reliable web systems with PHP, Laravel, React, and MySQL.</p>
        <a className="primary-btn" href="#/portfolio">
          Explore Portfolio
        </a>
      </section>
    </main>
  );
}
