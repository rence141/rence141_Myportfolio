import { useEffect, useRef, useState } from 'react';
import { Project } from '../data/projects';

type Image = NonNullable<Project['gallery']>[number];

export function ProjectGallery({ images, isCollege }: { images: Image[]; isCollege: boolean }) {
  const [expandedGroups, setExpandedGroups] = useState<Record<string, boolean>>({});
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
    setActive((index) => (index === null ? null : (index + delta + images.length) % images.length));
  };

  const toggleGroup = (group: string) => {
    setExpandedGroups((prev) => ({ ...prev, [group]: !prev[group] }));
  };

  const groups = [...new Set(images.map((image) => (image.badge === 'Mobile' ? 'Mobile' : 'Web')))];

  return (
    <>
      {groups.map((group) => {
        const groupImages = images.filter((image) => (image.badge === 'Mobile' ? 'Mobile' : 'Web') === group);
        const isExpanded = !!expandedGroups[group];
        const visible = isExpanded ? groupImages : groupImages.slice(0, 6);
        const groupTitle = isCollege
          ? group === 'Mobile'
            ? 'Student Mobile App Interface'
            : 'Web & Administrative Portal'
          : `${group} Screenshots`;

        return (
          <section key={group} className="project-gallery-section">
            <div className="section-header-row">
              <h2>{groupTitle}</h2>
              <span className="gallery-count">{groupImages.length} screens</span>
            </div>
            <p className="gallery-hint">Click any preview below to open full-resolution inspector.</p>

            <div className={group === 'Mobile' ? 'gallery-grid mobile-gallery' : 'gallery-grid'}>
              {visible.map((image) => (
                <button
                  key={image.src}
                  type="button"
                  className="gallery-card"
                  aria-label={`Enlarge ${image.title}`}
                  onClick={() => setActive(images.indexOf(image))}
                >
                  <div className="gallery-img-wrap">
                    <img src={image.src} alt={image.title} loading="lazy" />
                    {image.badge && <span className="gallery-badge">{image.badge}</span>}
                  </div>
                  <div className="gallery-card-info">
                    <strong>{image.title}</strong>
                    <small>{image.caption}</small>
                  </div>
                </button>
              ))}
            </div>

            {groupImages.length > 6 && (
              <div className="gallery-action-row">
                <button
                  type="button"
                  className="gallery-more-btn"
                  aria-expanded={isExpanded}
                  onClick={() => toggleGroup(group)}
                >
                  {isExpanded
                    ? 'Show fewer screenshots'
                    : `Show all ${groupImages.length} ${group.toLowerCase()} screenshots (${groupImages.length - 6} more)`}
                </button>
              </div>
            )}
          </section>
        );
      })}

      <dialog
        ref={dialog}
        className="gallery-dialog"
        aria-label="Project screenshot viewer"
        onCancel={() => setActive(null)}
        onClose={() => setActive(null)}
        onClick={(event) => {
          if (event.target === event.currentTarget) setActive(null);
        }}
        onKeyDown={(event) => {
          if (event.key === 'ArrowLeft') {
            event.preventDefault();
            move(-1);
          }
          if (event.key === 'ArrowRight') {
            event.preventDefault();
            move(1);
          }
        }}
      >
        {active !== null && (
          <>
            <header>
              <span aria-live="polite">
                <strong>{images[active].title}</strong>{' '}
                <small>({active + 1} of {images.length})</small>
              </span>
              <button type="button" autoFocus onClick={() => setActive(null)} aria-label="Close screenshot viewer">
                <i className="fa-solid fa-xmark" aria-hidden="true" /> Close
              </button>
            </header>
            <div className="gallery-dialog-img-container">
              <img src={images[active].src} alt={images[active].title} />
            </div>
            <footer>
              <button type="button" onClick={() => move(-1)}>
                <i className="fa-solid fa-chevron-left" aria-hidden="true" /> Previous
              </button>
              <p>{images[active].caption}</p>
              <button type="button" onClick={() => move(1)}>
                Next <i className="fa-solid fa-chevron-right" aria-hidden="true" />
              </button>
            </footer>
          </>
        )}
      </dialog>
    </>
  );
}
