import { useEffect, useRef, useState } from 'react';
import { Project } from '../data/projects';
type Image = NonNullable<Project['gallery']>[number];
export function ProjectGallery({ images, isCollege }: { images: Image[]; isCollege: boolean }) {
  const [expanded, setExpanded] = useState(false);
  const [active, setActive] = useState<number | null>(null);
  const dialog = useRef<HTMLDialogElement>(null);
  useEffect(() => {
    if (active === null) { dialog.current?.close(); return; }
    if (!dialog.current?.open) dialog.current?.showModal();
  }, [active]);
  const move = (delta: number) => setActive(index => index === null ? null : (index + delta + images.length) % images.length);
  return <>
    {[...new Set(images.map(image => image.badge === 'Mobile' ? 'Mobile' : 'Web'))].map(group => {
      const groupImages = images.filter(image => (image.badge === 'Mobile' ? 'Mobile' : 'Web') === group);
      const visible = expanded ? groupImages : groupImages.slice(0, 6);
      return <section key={group}><h2>{isCollege ? group === 'Mobile' ? 'Student Mobile App' : 'Website & Registrar Portal' : 'Gallery'}</h2><p className="gallery-hint">Select a screenshot to view it full size.</p>
        <div className={group === 'Mobile' ? 'gallery-grid mobile-gallery' : 'gallery-grid'}>{visible.map(image => <button key={image.src} className="gallery-card" aria-label={`Enlarge ${image.title}`} onClick={() => setActive(images.indexOf(image))}><img src={image.src} alt={image.title} loading="lazy" />{image.badge && <span>{image.badge}</span>}<strong>{image.title}</strong><small>{image.caption}</small></button>)}</div>
        {groupImages.length > 6 && <button className="gallery-more" aria-expanded={expanded} onClick={() => setExpanded(value => !value)}>{expanded ? 'Show fewer screenshots' : `Show all ${groupImages.length} ${group === 'Mobile' ? 'mobile' : 'web'} screenshots`}</button>}
      </section>;
    })}
    <dialog ref={dialog} className="gallery-dialog" aria-label="Project screenshot viewer" onCancel={() => setActive(null)} onClose={() => setActive(null)} onClick={event => { if (event.target === event.currentTarget) setActive(null); }} onKeyDown={event => { if (event.key === 'ArrowLeft') { event.preventDefault(); move(-1); } if (event.key === 'ArrowRight') { event.preventDefault(); move(1); } }}>
      {active !== null && <><header><span aria-live="polite">{images[active].title} <small>{active + 1} / {images.length}</small></span><button autoFocus onClick={() => setActive(null)} aria-label="Close screenshot viewer"><i className="fa-solid fa-xmark" aria-hidden="true" /></button></header><img src={images[active].src} alt={images[active].title} /><footer><button onClick={() => move(-1)}><i className="fa-solid fa-chevron-left" aria-hidden="true" /> Previous</button><p>{images[active].caption}</p><button onClick={() => move(1)}>Next <i className="fa-solid fa-chevron-right" aria-hidden="true" /></button></footer></>}
    </dialog>
  </>;
}
