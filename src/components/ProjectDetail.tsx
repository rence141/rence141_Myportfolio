import { useMemo } from "react";
import { projects } from "../data/projects";
import { ProjectGallery } from "./ProjectGallery";
import "./home-retro.css";

type ProjectDetailProps = {
  slug: string;
};

export function ProjectDetail({ slug }: ProjectDetailProps) {
  const project = useMemo(() => projects.find((item) => item.slug === slug), [slug]);

  if (!project) {
    return (
      <main className="project-detail">
        <nav className="project-nav">
          <a href="#/portfolio#projects" className="project-back-link">
            <i className="fa-solid fa-arrow-left" aria-hidden="true" /> Back to Portfolio
          </a>
        </nav>
        <section className="project-hero">
          <h1>Project not found</h1>
        </section>
      </main>
    );
  }

  const displayImage = project.gallery?.[0]?.src ?? project.heroImage;

  return (
    <main className="project-detail">
      <nav className="project-nav">
        <a href="#/portfolio#projects" className="project-back-link">
          <i className="fa-solid fa-arrow-left" aria-hidden="true" /> Back to Portfolio
        </a>
        <span className="project-tag-pill">{project.tags[0]}</span>
      </nav>

      <header className="project-hero">
        <p>{project.tags.join(" / ")}</p>
        <h1>{project.title}</h1>
        <span>{project.subtitle}</span>
      </header>

      <section className="project-layout">
        <article className="project-main">
          <img className="project-main-image" src={displayImage} alt={project.title} />
          <h2>Project Overview</h2>
          <p>{project.summary}</p>

          {project.metrics && (
            <div className="metric-grid">
              {project.metrics.map((metric) => (
                <div key={metric.label}>
                  <strong>{metric.value}</strong>
                  <span>{metric.label}</span>
                </div>
              ))}
            </div>
          )}

          <h2>Key Features</h2>
          <div className="feature-grid">
            {project.features.map((feature) => (
              <div className="feature-card" key={feature.title}>
                <h3>
                  <i className={`fa-solid ${feature.icon}`} /> {feature.title}
                </h3>
                <p>{feature.body}</p>
              </div>
            ))}
          </div>

          {project.gallery && <ProjectGallery images={project.gallery} isCollege={project.slug === "wcc-student-record-system"} />}

          {project.impact && (
            <>
              <h2>Results & Impact</h2>
              {project.impact.map((item) => (
                <div className="impact-card" key={item.title}>
                  <strong>{item.title}</strong>
                  <p>{item.body}</p>
                </div>
              ))}
            </>
          )}
        </article>

        <aside className="project-sidebar">
          <h3>Project Details</h3><a className="project-contact-link" href="#/portfolio#contact"><i className="fa-regular fa-comment-dots" aria-hidden="true" /> Discuss a similar project</a>
          {Object.entries(project.details).map(([key, value]) => (
            <div key={key}>
              <small>{key}</small>
              <strong>{value}</strong>
            </div>
          ))}
          <div className="badge-row">
            {project.tags.map((tag) => (
              <span key={tag}>{tag}</span>
            ))}
          </div>
        </aside>
      </section>


    </main>
  );
}
