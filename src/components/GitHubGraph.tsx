import { useState } from 'react';
import { profile } from '../data/profile';
import { GitHubActivity } from './GitHubActivity';

export function GitHubGraph() {
  const [failed, setFailed] = useState(false);
  const [loaded, setLoaded] = useState(false);
  const username = profile.socials.github.split('/').filter(Boolean).pop() || 'rence141';
  return <section className="retro-github" aria-labelledby="github-title">
    <div className="retro-github-heading"><h2 id="github-title">GitHub activity</h2><a href={profile.socials.github} target="_blank" rel="noreferrer"><i className="fa-brands fa-github" aria-hidden="true" /> {username}</a></div>
    <p>My contribution history over the past year.</p>
    {!failed ? <div className="retro-github-scroll" tabIndex={0} role="region" aria-label="GitHub contribution calendar; scroll horizontally on small screens" aria-busy={!loaded}>
      {!loaded && <span className="retro-github-loading" role="status">Loading contribution graph...</span>}
      <a href={profile.socials.github} target="_blank" rel="noreferrer">
        <img src={`https://ghchart.rshah.org/6132a3/${encodeURIComponent(username)}`} alt={`${username}'s GitHub contribution calendar for the past year; open GitHub to explore contributions`} loading="lazy" decoding="async" onLoad={() => setLoaded(true)} onError={() => setFailed(true)} />
      </a>
    </div> : <p role="status">The contribution graph is unavailable. <a href={profile.socials.github} target="_blank" rel="noreferrer">View my activity on GitHub</a>.</p>}
    <small>Contribution calendar via <a href="https://ghchart.rshah.org/" target="_blank" rel="noreferrer">GitHub Chart</a>.</small>
    <GitHubActivity username={username} />
  </section>;
}
