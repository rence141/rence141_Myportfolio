import { FormEvent, useEffect, useState } from "react";
import { featuredProjects } from "../data/projects";
import { profile } from "../data/profile";
import { TypeText } from "./TypeText";

const metrics = [
  { value: "8+", label: "apps and tools built" },
  { value: "4", label: "platform types" },
  { value: "100%", label: "responsive builds" },
];

const skills = ["React.js", "TypeScript", "API Integration", "MongoDB", "Supabase", "Flutter", "Desktop & Mobile Apps", "Git & GitHub", "Problem Solving", "Teamwork"];

const services = [
  {
    icon: "fa-layer-group",
    title: "Full-stack systems",
    body: "Web applications, collaborative tools, freelancer platforms, and productivity systems with maintainable architecture.",
  },
  {
    icon: "fa-plug",
    title: "API & cloud workflows",
    body: "API integrations, Supabase-backed features, cloud deployment, and data flows for modern application experiences.",
  },
  {
    icon: "fa-robot",
    title: "Automation & bots",
    body: "Discord bots, interactive commands, moderation helpers, and automation features for active online communities.",
  },
];

const experience = [
  {
    period: "2025 - Present",
    role: "Full-Stack Developer",
    body: "Developed custom applications including collaborative IDE systems, freelancer marketplaces, Discord bots, and productivity tools. Worked with React.js, APIs, Supabase, Railway, and Render.",
  },
  {
    period: "2024 - 2025",
    role: "Independent Developer / Freelancer",
    body: "Collaborated with clients to understand requirements and deliver tailored software solutions.",
  },
  {
    period: "2024",
    role: "Discord Bot Developer - Freelance",
    body: "Created and maintained Discord bots focused on community engagement, automation, interactive commands, and server management.",
  },
];

const additionalProjects = [
  {
    title: "Jirai IDE",
    body: "Custom collaborative IDE workspace with project management and developer tools.",
  },
  {
    title: "Freelancer Marketplace (trabaho)",
    body: "Platform connecting freelancers and clients with authentication and dashboards.",
  },
  {
    title: "Interactive Discord Bot",
    body: "Automation and engagement bot with activities, moderation features, and interactive commands.",
  },
];

const certifications = [
  "Introduction to Kubernetes - The Linux Foundation",
  "Secure AI/ML-Driven Software Development - The Linux Foundation",
  "Getting Started with OpenTelemetry - The Linux Foundation",
  "Introduction to JavaScript Security - The Linux Foundation",
  "Build a Free Website with WordPress - Coursera",
];

const processSteps = ["Discover requirements", "Design the workflow", "Build and test", "Refine for users"];

export function Portfolio() {
  const [theme, setTheme] = useState(() => localStorage.getItem("theme") || "light");
  const [menuOpen, setMenuOpen] = useState(false);
  const [toast, setToast] = useState("");

  useEffect(() => {
    document.documentElement.dataset.theme = theme;
    localStorage.setItem("theme", theme);
  }, [theme]);

  const sendMessage = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const form = new FormData(event.currentTarget);
    const name = String(form.get("name") || "");
    const email = String(form.get("email") || "");
    const message = String(form.get("message") || "");
    const subject = encodeURIComponent(`Portfolio Contact: ${name}`);
    const body = encodeURIComponent(`${message}\n\nFrom: ${name} <${email}>`);

    window.location.href = `mailto:${profile.email}?subject=${subject}&body=${body}`;
    setToast("Opening your email app with the message ready to send.");
    event.currentTarget.reset();
  };

  return (
    <main className="site-shell">
      <nav className="navbar">
        <a className="brand" href="#/">
          Rence.
        </a>
        <button className="menu-button" onClick={() => setMenuOpen((open) => !open)} aria-label="Toggle navigation">
          <i className="fa-solid fa-bars" />
        </button>
        <div className={`nav-links ${menuOpen ? "open" : ""}`}>
          {["home", "about", "projects", "contact"].map((item) => (
            <a key={item} href={`#/portfolio#${item}`} onClick={() => setMenuOpen(false)}>
              {item}
            </a>
          ))}
          <button className="theme-toggle" onClick={() => setTheme(theme === "dark" ? "light" : "dark")} aria-label="Toggle theme">
            <i className={`fa-solid ${theme === "dark" ? "fa-sun" : "fa-moon"}`} />
          </button>
        </div>
      </nav>

      <section id="home" className="hero-section">
        <div className="hero-copy">
          <p className="eyebrow">Full-stack developer based in {profile.location}</p>
          <h1>Building web apps, tools, and automation for real workflows.</h1>
          <h2>
            Focused on <TypeText words={["React + TypeScript", "Supabase applications", "API integrations", "Discord automation"]} />
          </h2>
          <p className="lead">
            I am {profile.fullName}, a motivated and adaptable developer building web applications, desktop systems, Discord bots, and collaborative development tools.
          </p>
          <div className="hero-actions">
            <a className="primary-btn" href="#/portfolio#projects">
              View Projects <i className="fa-solid fa-arrow-right" />
            </a>
            <a className="secondary-btn" href="#/portfolio#contact">
              Contact Me
            </a>
          </div>
          <div className="metric-strip" aria-label="Portfolio highlights">
            {metrics.map((metric) => (
              <div key={metric.label}>
                <strong>{metric.value}</strong>
                <span>{metric.label}</span>
              </div>
            ))}
          </div>
          <div className="social-links">
            <a href={profile.socials.github} aria-label="GitHub">
              <i className="devicon-github-original" />
            </a>
            <a href={profile.socials.linkedin} aria-label="LinkedIn">
              <i className="devicon-linkedin-plain" />
            </a>
            <a href={profile.socials.facebook} aria-label="Facebook">
              <i className="devicon-facebook-plain" />
            </a>
          </div>
          <div className="contact-strip" aria-label="Direct contact">
            <span>
              <i className="fa-solid fa-envelope" /> {profile.email}
            </span>
            <span>
              <i className="fa-solid fa-phone" /> {profile.phone}
            </span>
          </div>
        </div>
        <div className="hero-portrait">
          <div />
          <img src={profile.avatar} alt={profile.fullName} />
          <aside className="availability-card">
            <span />
            Available for freelance projects
          </aside>
        </div>
      </section>

      <section id="about" className="section">
        <p className="section-kicker">Profile</p>
        <h2 className="section-title">Developer With A Systems Mindset</h2>
        <div className="about-grid">
          <article className="panel">
            <h3>About</h3>
            <p>
              Motivated and adaptable Full-Stack Developer with experience in building web applications, desktop systems, Discord bots, and collaborative development tools.
            </p>
            <p>
              Skilled in React.js, TypeScript, APIs, Supabase, Flutter, and modern software development workflows. Passionate about creating innovative systems that improve user experience and productivity.
            </p>
            <div className="badge-row">
              {skills.map((tech) => (
                <span key={tech}>{tech}</span>
              ))}
            </div>
            <div className="visit-card">
              <i className="fa-solid fa-code-branch" />
              <div>
                <strong>Current focus</strong>
                <small>React + TypeScript, APIs, Supabase, Flutter, and cloud-ready applications</small>
              </div>
            </div>
          </article>

          <article className="timeline">
            <h3>Experience</h3>
            {experience.map((item) => (
              <div key={item.role}>
                <small>{item.period}</small>
                <h4>{item.role}</h4>
                <p>{item.body}</p>
              </div>
            ))}
          </article>
        </div>
      </section>

      <section className="section services-section">
        <p className="section-kicker">Capabilities</p>
        <h2 className="section-title">How I Can Help</h2>
        <div className="services-grid">
          {services.map((service) => (
            <article className="service-card" key={service.title}>
              <i className={`fa-solid ${service.icon}`} />
              <h3>{service.title}</h3>
              <p>{service.body}</p>
            </article>
          ))}
        </div>
      </section>

      <section id="projects" className="section project-band">
        <p className="section-kicker">Selected Work</p>
        <h2 className="section-title">Featured Projects</h2>
        <p className="section-copy">A compact look at systems I have developed across e-commerce, learning, analytics, and academic management.</p>
        <div className="project-grid">
          {featuredProjects.map((project) => (
            <article className="project-card" key={project.slug}>
              <a className="project-image-link" href={`#/project/${project.slug}`} aria-label={`View ${project.title}`}>
                <img src={project.heroImage} alt={project.title} loading="lazy" />
              </a>
              <div className="project-card-body">
                <small>{project.category}</small>
                <h3>
                  <i className={project.icon} /> {project.title}
                </h3>
                <p>{project.summary}</p>
                <div className="badge-row">
                  {project.tags.map((tag) => (
                    <span key={tag}>{tag}</span>
                  ))}
                </div>
                <a href={`#/project/${project.slug}`}>View Case Study</a>
              </div>
            </article>
          ))}
        </div>
      </section>

      <section className="section resume-section">
        <p className="section-kicker">Resume Highlights</p>
        <h2 className="section-title">More Projects & Credentials</h2>
        <div className="resume-grid">
          <article className="panel">
            <h3>Additional Projects</h3>
            <div className="resume-list">
              {additionalProjects.map((project) => (
                <div key={project.title}>
                  <strong>{project.title}</strong>
                  <p>{project.body}</p>
                </div>
              ))}
            </div>
          </article>
          <article className="panel">
            <h3>Certifications</h3>
            <ul className="cert-list">
              {certifications.map((certification) => (
                <li key={certification}>{certification}</li>
              ))}
            </ul>
          </article>
          <article className="panel education-panel">
            <h3>Education</h3>
            <strong>Bachelor of Science in Information Systems</strong>
            <p>Bicol University - Polangui Campus</p>
            <small>I certify that the information provided is true and correct.</small>
          </article>
        </div>
      </section>

      <section className="section process-section">
        <p className="section-kicker">Workflow</p>
        <h2 className="section-title">A Clear Build Process</h2>
        <div className="process-row">
          {processSteps.map((step, index) => (
            <div key={step}>
              <span>{String(index + 1).padStart(2, "0")}</span>
              <strong>{step}</strong>
            </div>
          ))}
        </div>
      </section>

      <section id="contact" className="section contact-section">
        <article className="panel contact-panel">
          <p className="section-kicker">Contact</p>
          <h2>Let's Build Something Useful</h2>
          <p>Have a system, dashboard, Discord bot, or productivity tool in mind? Send a short message and I will get back to you.</p>
          <form onSubmit={sendMessage}>
            <label>
              Your Name
              <input name="name" placeholder="Full name" required />
            </label>
            <label>
              Email Address
              <input name="email" type="email" placeholder="you@example.com" required />
            </label>
            <label className="full">
              Message
              <textarea name="message" rows={5} placeholder="Tell me about your project..." required />
            </label>
            <button className="primary-btn full" type="submit">
              Send Message <i className="fa-solid fa-paper-plane" />
            </button>
          </form>
        </article>
      </section>

      <footer>© {new Date().getFullYear()} Lorenze Prepotente. GitHub / Portfolio available upon request.</footer>
      {toast && <div className="toast">{toast}</div>}
    </main>
  );
}
