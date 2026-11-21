import { useEffect, useRef, useState } from "react";
import { certificates } from "../data/certificates";
import "./home-retro.css";

export function Certificates() {
  const [active, setActive] = useState<number | null>(null);
  const dialog = useRef<HTMLDialogElement>(null);

  useEffect(() => {
    if (active === null) {
      dialog.current?.close();
      return;
    }
    if (!dialog.current?.open) dialog.current?.showModal();
  }, [active]);

  const move = (delta: number) => {
    setActive((index) => (index === null ? null : (index + delta + certificates.length) % certificates.length));
  };

  const activeCert = active !== null ? certificates[active] : null;

  return (
    <div className="retro" id="certificates">
      <nav className="retro-top-bar" aria-label="Certificate Navigation">
        <span>[ <a href="#/portfolio#home">&larr; Back to Home</a> ]</span>
        <span className="retro-top-meta">Credentials &middot; {certificates.length} certifications</span>
      </nav>

      <header className="retro-masthead cert-masthead">
        <div className="retro-dateline">
          <span>Lorenze Prepotente</span>
          <span>Verified Credentials</span>
          <span>Professional Development</span>
        </div>
        <h1>Certificates</h1>
        <p className="retro-motto">Verified coursework and credentials earned through The Linux Foundation and Coursera. Select any certificate to view full-size.</p>
      </header>

      <section aria-label="Certificate Gallery" className="cert-section">
        <div className="cert-list">
          {certificates.map((cert, index) => (
            <article key={cert.title} className="cert-item">
              <button
                type="button"
                className="cert-preview-btn"
                onClick={() => setActive(index)}
                aria-label={`Inspect ${cert.title} certificate full-size`}
              >
                <img
                  src={cert.image}
                  alt={`${cert.title} — issued by ${cert.issuer}`}
                  loading={index < 2 ? "eager" : "lazy"}
                />
                <span className="cert-preview-badge" aria-hidden="true">Enlarge</span>
              </button>
              <small className="retro-kicker">
                No. {String(index + 1).padStart(2, "0")} &middot; {cert.issuer}
              </small>
              <h3>{cert.title}</h3>
              {(cert.date || cert.credential) && (
                <small className="cert-meta">
                  {cert.date && <span>Completed {cert.date}</span>}
                  {cert.date && cert.credential && <span aria-hidden="true"> &middot; </span>}
                  {cert.credential && <span>ID: {cert.credential}</span>}
                </small>
              )}
              <p className="cert-actions">
                [ <button type="button" className="cert-action-btn" onClick={() => setActive(index)}>Enlarge</button> ]
                {cert.pdf && (
                  <>
                    {" "}
                    [ <a href={cert.pdf} target="_blank" rel="noopener noreferrer">Open PDF &#8599;</a> ]
                  </>
                )}
                {cert.verifyUrl && (
                  <>
                    {" "}
                    [ <a href={cert.verifyUrl} target="_blank" rel="noopener noreferrer">Verify &#8599;</a> ]
                  </>
                )}
              </p>
            </article>
          ))}
        </div>
      </section>

      <dialog
        ref={dialog}
        className="gallery-dialog cert-dialog"
        aria-label="Certificate full-resolution viewer"
        onCancel={() => setActive(null)}
        onClose={() => setActive(null)}
        onClick={(event) => {
          if (event.target === event.currentTarget) setActive(null);
        }}
        onKeyDown={(event) => {
          if (event.key === "ArrowLeft") {
            event.preventDefault();
            move(-1);
          }
          if (event.key === "ArrowRight") {
            event.preventDefault();
            move(1);
          }
        }}
      >
        {activeCert && active !== null && (
          <>
            <header>
              <span aria-live="polite" className="cert-dialog-heading">
                <strong>{activeCert.title}</strong>
                <small>({active + 1} of {certificates.length})</small>
              </span>
              <button
                type="button"
                autoFocus
                onClick={() => setActive(null)}
                aria-label="Close certificate viewer"
              >
                Close
              </button>
            </header>
            <div className="gallery-dialog-img-container cert-dialog-img-wrap">
              <img
                src={activeCert.image}
                alt={`${activeCert.title} — issued by ${activeCert.issuer}`}
              />
            </div>
            <footer>
              <button type="button" onClick={() => move(-1)}>
                &larr; Previous
              </button>
              <p>
                {activeCert.issuer}
                {activeCert.date ? ` · ${activeCert.date}` : ""}
                {activeCert.credential ? ` · ID: ${activeCert.credential}` : ""}
                {activeCert.pdf && (
                  <>
                    {" · "}
                    <a href={activeCert.pdf} target="_blank" rel="noopener noreferrer">
                      Open PDF &#8599;
                    </a>
                  </>
                )}
              </p>
              <button type="button" onClick={() => move(1)}>
                Next &rarr;
              </button>
            </footer>
          </>
        )}
      </dialog>

      <hr />

      <footer>
        <small>&copy; {new Date().getFullYear()} Lorenze Prepotente &mdash; Thoughtful code. Practical solutions. <a href="#/portfolio#home">Back to Home</a></small>
      </footer>
    </div>
  );
}
