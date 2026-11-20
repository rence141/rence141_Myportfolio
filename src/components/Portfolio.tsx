import { FormEvent, useEffect, useRef, useState } from "react";
import { projects } from "../data/projects";
import { profile } from "../data/profile";
import { ParticlePortrait } from "./ParticlePortrait";
import "./business.css";
import "./workspace.css";

const solutions = [
  { number: "01", title: "Turn visitors into customers.", problem: "Your business deserves more than a link in your bio.", body: "A clear, mobile-friendly website that explains what you offer and makes the next step easy.", tags: "Business websites / Online stores", goal: "A website or online store" },
  { number: "02", title: "Get your operations in order.", problem: "Too many spreadsheets. Too much back-and-forth.", body: "Custom dashboards and tools to bring orders, records, and everyday tasks into one practical workspace.", tags: "Dashboards / Internal tools", goal: "A dashboard or internal tool" },
  { number: "03", title: "Take repetitive work off your plate.", problem: "Your time is better spent running the business.", body: "Connect your tools and automate routine steps, notifications, and community tasks.", tags: "Integrations / Automation", goal: "Automation or integrations" },
];
const selectedSlugs = ["wcc-student-record-system", "meta-shark-ecommerce", "freelancer-marketplace", "interactive-discord-bot"];
const work = selectedSlugs.map(slug => projects.find(p => p.slug === slug)).filter(p => p !== undefined);


export function Portfolio() {
  const siteRef = useRef<HTMLDivElement>(null);
  const [motionPaused, setMotionPaused] = useState(false);
  const [reducedMotion, setReducedMotion] = useState(() => window.matchMedia('(prefers-reduced-motion: reduce)').matches);
  useEffect(() => {
    const media = window.matchMedia('(prefers-reduced-motion: reduce)');
    const update = () => setReducedMotion(media.matches);
    media.addEventListener('change', update);
    return () => media.removeEventListener('change', update);
  }, []);
  const [activeProject, setActiveProject] = useState(0);
  const preview = work[activeProject];
  useEffect(() => {
    const site = siteRef.current;
    if (!site || !('IntersectionObserver' in window)) return;
    const elements = site.querySelectorAll<HTMLElement>('.b-section-head, .b-solutions article, .b-projects article, .b-process > div, .b-process li, .b-about > *, .b-contact .b-wrap > *');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('b-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });
    elements.forEach((element, index) => {
      element.classList.add('b-reveal');
      element.style.setProperty('--reveal-delay', `${(index % 3) * 80}ms`);
      observer.observe(element);
    });
    return () => {
      observer.disconnect();
      elements.forEach(element => element.classList.remove('b-reveal', 'b-visible'));
    };
  }, []);
  const [menuOpen, setMenuOpen] = useState(false);
  const [goal, setGoal] = useState("");
  const [notice, setNotice] = useState("");
  useEffect(() => {
    if (!menuOpen) return;
    function closeMenu(event: KeyboardEvent) {
      if (event.key === "Escape") { setMenuOpen(false); siteRef.current?.querySelector<HTMLButtonElement>(".b-menu")?.focus(); }
    }
    window.addEventListener("keydown", closeMenu);
    return () => window.removeEventListener("keydown", closeMenu);
  }, [menuOpen]);
  async function copyEmail() {
    try { await navigator.clipboard.writeText(profile.email); setNotice("Email address copied."); }
    catch { setNotice("Copy this address: " + profile.email); }
  }
  function sendMessage(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    const body = `${data.get("message")}\n\nProject: ${goal || "Let's figure it out"}\nFrom: ${data.get("name")}\nEmail: ${data.get("email")}`;
    window.location.href = `mailto:${profile.email}?subject=${encodeURIComponent(`Project inquiry from ${data.get("name")}`)}&body=${encodeURIComponent(body)}`;
    setNotice("Your email app will open with your inquiry. Send it there to get in touch, or email me directly below.");
  }
  return <div ref={siteRef} className={`business-site${motionPaused ? " b-motion-paused" : ""}`}>
    <a className="b-skip" href="#/portfolio#home">Skip to content</a>
    <header className="b-nav b-wrap">
      <a href="#/portfolio#home" className="b-brand" aria-label="Rence home">rence<span>®</span></a>
      <button className="b-menu" aria-expanded={menuOpen} aria-controls="business-nav" onClick={() => setMenuOpen(!menuOpen)}>{menuOpen ? "Close" : "Menu"}</button>
      <nav id="business-nav" className={menuOpen ? "is-open" : ""} aria-label="Main navigation">
        {[["solutions", "What I do"], ["projects", "Selected work"], ["about", "About me"]].map(([id, label]) => <a key={id} href={`#/portfolio#${id}`} onClick={() => setMenuOpen(false)}>{label}</a>)}
        <a className="b-nav-cta" href="#/portfolio#contact" onClick={() => setMenuOpen(false)}>Let’s talk <span><i className="fa-solid fa-folder-open" aria-hidden="true" /></span></a>
      </nav>
    </header>
    <main id="home">
      <section className="b-hero b-wrap">
        <div className="b-hero-copy"><p className="b-eyebrow">Independent developer · Philippines</p>
          <h1>Your next system.<br /><em>Built by Rence.</em></h1>
          <p className="b-lead">An online shop. A workspace for your team. That repetitive task you wish would do itself. I build the software behind those ideas.</p>
          <div className="b-actions"><a className="b-button" href="#/portfolio#contact">Tell me what you need <span><i className="fa-regular fa-comment-dots" aria-hidden="true" /></span></a><a className="b-text-link" href="#/portfolio#projects">Explore my work <span><i className="fa-solid fa-folder-open" aria-hidden="true" /></span></a></div>
          <p className="b-small">PHP / Laravel / React / TypeScript - tools I use to get it built.</p>
        </div>
        <div className="w-desk">
<div className="w-window-bar"><span>rence / open-workspace</span><button className="b-motion-toggle" type="button" aria-pressed={motionPaused} onClick={() => setMotionPaused(p => !p)}>{motionPaused ? "Resume" : "Pause motion"}</button></div>
<div className="w-tabs" role="group" aria-label="Choose a project preview">{work.map((p, i) => <button key={p.slug} aria-pressed={i === activeProject} onClick={() => setActiveProject(i)}>{['Student records', 'Online store', 'Freelancer platform', 'Discord bot'][i]}</button>)}</div>
<div className="w-preview"><a key={preview.slug} href={`#/project/${preview.slug}`}><img src={preview.heroImage} alt={`${preview.title} preview`} /><span>Open project <i className="fa-solid fa-folder-open" aria-hidden="true" /></span></a></div>
<div className="w-terminal"><span>~/rence/projects $</span><p key={preview.slug}>{preview.title}<span className="w-cursor" aria-hidden="true">_</span></p><small>{preview.category}{preview.details.Status ? ` / ${preview.details.Status}` : ""}</small></div>
<div className="w-note">Real builds.<br />Click around. <i className="fa-solid fa-hand-pointer" aria-hidden="true" /></div>
</div>
      </section>
      <div className="b-capabilities"><div className="b-wrap"><span>Built for the way you work</span><strong>Websites</strong><i aria-hidden="true">&#10035;</i><strong>Business systems</strong><i aria-hidden="true">&#10035;</i><strong>Automation</strong></div></div>
      <section id="solutions" className="b-section b-wrap"><div className="b-section-head"><p className="b-eyebrow">01 / What I can help with</p><h2>What is slowing<br /><span>your business down?</span></h2></div>
        <div className="b-solutions">{solutions.map(s => <article key={s.number}><span className="b-number">{s.number} /</span><h3>{s.title}</h3><p className="b-problem">{s.problem}</p><p>{s.body}</p><div className="b-service-bottom"><small>{s.tags}</small><a href="#/portfolio#contact" aria-label={`Discuss ${s.tags}`} onClick={() => setGoal(s.goal)}><i className="fa-regular fa-comment-dots" aria-hidden="true" /></a></div></article>)}</div>
      </section>
      <section id="projects" className="b-work"><div className="b-wrap b-section"><div className="b-section-head b-work-head"><div><p className="b-eyebrow">02 / Selected work</p><h2>The build <em>archive.</em></h2></div><p>A look at what I’ve built, and the workflows behind it. Explore each project for its scope and features.</p></div>
        <div className="b-projects">{work.map((p, i) => <article key={p.slug}><a className="b-project-image" href={`#/project/${p.slug}`} aria-label={`Explore ${p.title}`}><img src={p.heroImage} alt={`${p.title} interface`} loading="lazy" /><span><i className="fa-solid fa-folder-open" aria-hidden="true" /></span></a><div className="b-project-info"><div><p className="b-eyebrow">{p.category} · {p.details.Client}</p><h3><a href={`#/project/${p.slug}`}>{p.title.replace(" E-Commerce", "")}</a></h3><p>{p.summary}</p><a className="b-text-link" href={`#/project/${p.slug}`}>Explore project <i className="fa-solid fa-folder-open" aria-hidden="true" /></a></div><span className="b-project-index">0{i + 1}</span></div></article>)}</div>
        <p className="b-work-note">Selected work includes academic concepts and independent builds. Project pages describe their individual scope.</p>
      </div></section>
      <section className="b-section b-wrap b-process"><div><p className="b-eyebrow">03 / Working together</p><h2>From our first chat<br /><em>to your first click.</em></h2><p>You bring the business context.<br />I bring the technical thinking.</p></div><ol>{[["Talk about the real need", "We look at your current workflow, your customers, and what needs to improve."], ["Agree on a focused plan", "We define the features, scope, and timeline before development begins."], ["Build, review, refine", "You see progress and share feedback as the solution takes shape."], ["Launch with a clear handover", "We check the key workflows and walk through how to use what’s been built."]].map(([title, text], i) => <li key={title}><span>0{i + 1}</span><div><h3>{title}</h3><p>{text}</p></div></li>)}</ol></section>
      <section id="about" className="b-about b-wrap"><ParticlePortrait src={profile.avatar} alt={profile.fullName} active={true} reducedMotion={reducedMotion || motionPaused} /><div><p className="b-eyebrow">The person behind the build</p><h2>Hi, I’m Lorenze.<br /><em>You can call me Rence.</em></h2><p>I’m a full-stack developer based in {profile.location}. My work spans online stores, learning platforms, collaboration tools, and community automation.</p><p>I like turning complicated workflows into software that’s easier to use. When we work together, you speak directly with the person building your solution.</p><a className="b-text-link" href={profile.socials.github} target="_blank" rel="noreferrer">Explore my GitHub <i className="fa-brands fa-github" aria-hidden="true" /></a><a className="b-text-link" href={profile.socials.linkedin} target="_blank" rel="noreferrer">Connect on LinkedIn <i className="fa-brands fa-linkedin" aria-hidden="true" /></a></div></section>
      <section id="contact" className="b-contact"><div className="b-wrap b-section"><div><p className="b-eyebrow">04 / Let’s make it happen</p><h2>What would make<br />your workday<br /><em>easier?</em></h2><p>Tell me about your business and what you have in mind. It’s okay if you don’t have a technical brief.</p><a className="b-email" href={`mailto:${profile.email}`}>{profile.email} <i className="fa-regular fa-envelope" aria-hidden="true" /></a><button className="b-copy-email" type="button" onClick={copyEmail}><i className="fa-regular fa-copy" aria-hidden="true" /> Copy email address</button><a className="b-phone" href={`tel:${profile.phone.replace(/\s/g, "")}`}>{profile.phone}</a></div>
        <form onSubmit={sendMessage}><div className="b-form-row"><label>Your name<input name="name" autoComplete="name" placeholder="What should I call you?" required /></label><label>Email address<input name="email" autoComplete="email" type="email" placeholder="you@business.com" required /></label></div><label>What do you need?<select value={goal} onChange={e => setGoal(e.target.value)}><option value="">Let’s figure it out</option><option>A website or online store</option><option>A dashboard or internal tool</option><option>Automation or integrations</option><option>Something else</option></select></label><label>A little about your project<textarea name="message" maxLength={3000} rows={4} placeholder="What does your business do? What would you like to improve?" required /></label><button className="b-button" type="submit">Open email draft <span><i className="fa-regular fa-paper-plane" aria-hidden="true" /></span></button><small>This opens your email app with your inquiry ready to send.</small>{notice && <p role="status" className="b-contact-status">{notice}</p>}</form>
      </div></section>
    </main><footer className="b-footer b-wrap"><a className="b-brand" href="#/portfolio#home">rence<span>®</span></a><span>Thoughtful code. Practical solutions.</span><small>© {new Date().getFullYear()} Lorenze Prepotente</small></footer>
  </div>;
}



