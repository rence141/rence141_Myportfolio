import { useEffect, useState } from "react";
import type { CSSProperties } from "react";
import { profile } from "../data/profile";
import { ParticlePortrait } from "./ParticlePortrait";
import "./intro-wow.css";

const introText = "Turning ideas into systems.";
const fonts = ["VT323", "Courier New", "Space Grotesk"];

export function Intro() {
  const [typed, setTyped] = useState("");
  const [phase, setPhase] = useState<"typing" | "wipe" | "settled">("typing");
  const [font, setFont] = useState(fonts[0]);
  const [reducedMotion, setReducedMotion] = useState(() => window.matchMedia("(prefers-reduced-motion: reduce)").matches);

  useEffect(() => {
    const media = window.matchMedia("(prefers-reduced-motion: reduce)");
    const update = () => setReducedMotion(media.matches);
    media.addEventListener("change", update);
    return () => media.removeEventListener("change", update);
  }, []);

  useEffect(() => {
    if (reducedMotion) { setTyped(introText); setPhase("settled"); return; }
    if (typed.length < introText.length) {
      const timer = window.setTimeout(() => setTyped(introText.slice(0, typed.length + 1)), 90);
      return () => window.clearTimeout(timer);
    }
    const wipeTimer = window.setTimeout(() => setPhase("wipe"), 700);
    const settledTimer = window.setTimeout(() => setPhase("settled"), 3600);
    return () => { window.clearTimeout(wipeTimer); window.clearTimeout(settledTimer); };
  }, [typed, reducedMotion]);

  useEffect(() => {
    if (phase !== "settled" || reducedMotion) return;
    const timer = window.setInterval(() => setFont(fonts[Math.floor(Math.random() * fonts.length)]), 2200);
    return () => window.clearInterval(timer);
  }, [phase, reducedMotion]);

  const settled = phase === "settled";
  const step = (i: number) => ({ "--i": i } as CSSProperties);

  return (
    <main className={`intro-screen intro-wow intro-${phase}`}>
      <a className="intro-skip" href="#/portfolio">Skip intro <i className="fa-solid fa-forward" aria-hidden="true" /></a>
      <div aria-hidden="true" className={`intro-panel ${phase}`}>
        <div className="intro-cycler" style={{ fontFamily: font }}>{introText}</div>
      </div>

      {!settled && (
        <div className="intro-type" aria-label={introText}>
          {typed}
          <span />
        </div>
      )}

      <section aria-hidden={!settled} className={`intro-card ${settled ? "active" : ""}`}>
        <div className="wow-reveal" style={step(0)}>
          <ParticlePortrait src={profile.avatar} alt={profile.shortName} active={settled} reducedMotion={reducedMotion} />
        </div>
        <h1 className="wow-reveal" style={step(1)}>{profile.shortName}</h1>
        <p className="pill wow-reveal" style={step(2)}>{profile.role}</p>
        <div className="stack-icons wow-reveal" style={step(3)} aria-label="Tech stack">
          <i className="fab fa-php" /><i className="fab fa-js" /><i className="fab fa-laravel" /><i className="fab fa-react" /><i className="fas fa-database" />
        </div>
        <p className="wow-reveal" style={step(4)}>I turn ideas into reliable web systems with PHP, Laravel, React, and MySQL.</p>
        <p className="wow-status wow-reveal" style={step(5)}>Available for new projects</p>
        <a className="primary-btn wow-reveal" style={step(6)} tabIndex={settled ? 0 : -1} href="#/portfolio">Explore Portfolio</a>
      </section>
    </main>
  );
}
