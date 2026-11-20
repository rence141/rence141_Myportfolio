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
      <div className="retro" id="project-detail">
        <header className="retro-masthead">
          <p className="retro-dateline"><span>Error 404</span><span>Archive</span></p>
          <h1>Project Not Found</h1>
          <p className="retro-motto">The requested project could not be found in the archive.</p>
          <nav className="retro-nav">
            [ <a href="#/portfolio#projects">&larr; Back to Projects Archive</a> ]
          </nav>
        </header>
      </div>
    );
  }

  const displayImage = project.gallery?.[0]?.src ?? project.heroImage;

  return (
    <div className="retro" id="project-detail">
      {/* 2009 Top Bar */}
      <nav className="retro-top-bar" aria-label="Project Navigation">
        <span>[ <a href="#/portfolio#projects">&larr; Back to Projects Archive</a> ]</span>
        <span className="retro-top-meta">Archive Ref: {project.slug} · {project.category}</span>
      </nav>

      <hr />

      {/* 2009 Editorial Masthead Header */}
      <header className="retro-masthead">
        <div className="retro-dateline">
          <span>Category: {project.category}</span>
          {project.details.Duration && <span>Timeline: {project.details.Duration}</span>}
          {project.details.Status && <span>Status: {project.details.Status}</span>}
        </div>
        <h1>{project.title}</h1>
        <p className="retro-motto">&ldquo;{project.subtitle}&rdquo;</p>
        <p className="retro-tags-line">
          <strong>Technologies:</strong> {project.tags.join(" · ")}
        </p>
      </header>

      <hr />

      {/* Two-Column Lead Section */}
      <section className="retro-lead">
        {/* Left Column: Hero Image & Overview */}
        <div className="retro-col" style={{ gridColumn: "span 2" }}>
          <h2>I. Project Overview</h2>
          <div className="retro-figure-box">
            <img src={displayImage} alt={`${project.title} primary screenshot`} className="retro-lead-img" />
            <small>Fig. 1 &mdash; Primary interface capture for {project.title}.</small>
          </div>
          <p className="retro-summary-text">{project.summary}</p>

          {project.metrics && project.metrics.length > 0 && (
            <div className="retro-metrics-box">
              <h3>Key Outcomes & Operational Metrics</h3>
              <ul>
                {project.metrics.map((metric) => (
                  <li key={metric.label}>
                    <strong>{metric.value}</strong> &mdash; {metric.label}
                  </li>
                ))}
              </ul>
            </div>
          )}
        </div>

        {/* Right Column: Specifications Table & Inquiry */}
        <div className="retro-col">
          <h2>Specifications</h2>
          <table className="retro-specs-table">
            <tbody>
              {Object.entries(project.details).map(([key, value]) => (
                <tr key={key}>
                  <th>{key}:</th>
                  <td>{value}</td>
                </tr>
              ))}
              <tr>
                <th>Category:</th>
                <td>{project.category}</td>
              </tr>
              <tr>
                <th>Tags:</th>
                <td>{project.tags.join(", ")}</td>
              </tr>
            </tbody>
          </table>

          <div className="retro-inquiry-box">
            <h3>Project Inquiries</h3>
            <p>Interested in a similar system or technical consulting?</p>
            <p>
              [ <a href="#/portfolio#contact">Send a project inquiry &rarr;</a> ]
            </p>
          </div>
        </div>
      </section>

      <hr />

      {/* Section II: Core Capabilities */}
      {project.features && project.features.length > 0 && (
        <section id="capabilities">
          <h2>II. Key Capabilities & Technical Features</h2>
          <ol className="retro-features-list">
            {project.features.map((feature) => (
              <li key={feature.title}>
                <strong>{feature.title}:</strong> {feature.body}
              </li>
            ))}
          </ol>
        </section>
      )}

      {/* Section III: System Gallery */}
      {project.gallery && project.gallery.length > 0 && (
        <>
          <hr />
          <section id="gallery">
            <ProjectGallery images={project.gallery} isCollege={project.slug === "wcc-student-record-system"} />
          </section>
        </>
      )}

      {/* Section IV: Results & Impact */}
      {project.impact && project.impact.length > 0 && (
        <>
          <hr />
          <section id="impact">
            <h2>IV. Production Impact & Results</h2>
            <ul>
              {project.impact.map((item) => (
                <li key={item.title}>
                  <strong>{item.title}:</strong> {item.body}
                </li>
              ))}
            </ul>
          </section>
        </>
      )}

      <hr />

      {/* 2009 Footer Navigation */}
      <footer className="retro-project-footer">
        <p>
          [ <a href="#/portfolio#projects">&larr; Return to Projects Archive</a> ] &nbsp;&middot;&nbsp;
          [ <a href="#project-detail">Back to Top &uarr;</a> ] &nbsp;&middot;&nbsp;
          [ <a href="#/portfolio#contact">Contact Developer</a> ]
        </p>
        <small>&copy; {new Date().getFullYear()} Lorenze Prepotente &mdash; Thoughtful code. Practical solutions.</small>
      </footer>
    </div>
  );
}
