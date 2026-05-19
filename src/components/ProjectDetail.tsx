import { useMemo, useState } from "react";
import { projects } from "../data/projects";

type ProjectDetailProps = {
  slug: string;
};

export function ProjectDetail({ slug }: ProjectDetailProps) {
  const project = useMemo(() => projects.find((item) => item.slug === slug), [slug]);
  const [modalImage, setModalImage] = useState<string | null>(null);

  if (!project) {
    return (
      <main className="project-detail">
        <nav className="project-nav">
          <a href="#/portfolio">Back to Portfolio</a>
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
        <a href="#/portfolio">
          <i className="fa-solid fa-arrow-left" /> Back to Portfolio
        </a>
        <span>{project.tags[0]}</span>
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

          {project.gallery && (
            <>
              <h2>Gallery</h2>
              <div className="gallery-grid">
                {project.gallery.map((item) => (
                  <button key={item.src + item.title} className="gallery-card" onClick={() => setModalImage(item.src)}>
                    <img src={item.src} alt={item.title} loading="lazy" />
                    {item.badge && <span>{item.badge}</span>}
                    <strong>{item.title}</strong>
                    <small>{item.caption}</small>
                  </button>
                ))}
              </div>
            </>
          )}

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
          <h3>Project Details</h3>
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

      {modalImage && (
        <button className="image-modal" onClick={() => setModalImage(null)} aria-label="Close image preview">
          <img src={modalImage} alt="Expanded project screenshot" />
        </button>
      )}
    </main>
  );
}
