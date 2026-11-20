import { useEffect, useState } from 'react';

export function GitHubActivity({ username }: { username: string }) {
  const [counts, setCounts] = useState<number[] | null>(null);
  const [failed, setFailed] = useState(false);
  useEffect(() => {
    const controller = new AbortController();
    setCounts(null);
    setFailed(false);
    const since = new Date();
    since.setUTCFullYear(since.getUTCFullYear() - 1);
    const date = since.toISOString().slice(0, 10);
    const queries = [
      ['commits', `author:${username} author-date:>=${date}`],
      ['issues', `is:pr reviewed-by:${username} created:>=${date}`],
      ['issues', `is:issue author:${username} created:>=${date}`],
      ['issues', `is:pr author:${username} created:>=${date}`],
    ];
    Promise.all(queries.map(async ([endpoint, query]) => {
      const response = await fetch(`https://api.github.com/search/${endpoint}?q=${encodeURIComponent(query)}&per_page=1`, { signal: controller.signal });
      if (!response.ok) throw new Error('GitHub activity unavailable');
      const result = await response.json();
      if (result.incomplete_results || !Number.isFinite(result.total_count)) throw new Error('Incomplete activity');
      return result.total_count as number;
    })).then(setCounts).catch(() => { if (!controller.signal.aborted) setFailed(true); });
    return () => controller.abort();
  }, [username]);

  const total = counts?.reduce((sum, value) => sum + value, 0) || 0;
  const share = (index: number) => total && counts ? counts[index] / total : 0;
  const points = [[220 - share(0) * 112, 175], [220, 175 - share(1) * 112], [220 + share(2) * 112, 175], [220, 175 + share(3) * 112]];
  const labels = ['Commits', 'Code review', 'Issues', 'Pull requests'];
  const summary = labels.map((label, index) => `${label}: ${Math.round(share(index) * 100)}%`).join(', ');
  return <figure className="github-activity">
    <figcaption>Activity overview</figcaption>
    {counts && total > 0 ? <svg viewBox="0 0 440 350" role="img" aria-label={summary}>
      <g className="github-activity-axes"><path d="M108 175H332M220 63V287" /></g>
      <polygon className="github-activity-area" points={points.map(point => point.join(',')).join(' ')} />
      {points.map(([x, y], index) => share(index) > 0 && <circle key={index} cx={x} cy={y} r="3.5" className="github-activity-dot" />)}
      <g className="github-activity-labels" textAnchor="middle">
        <text x="220" y="50">Code review</text>
        <text x="346" y="180" textAnchor="start">Issues</text>
        <text x="220" y="310">Pull requests</text>
        <text x="92" y="173" textAnchor="end">{Math.round(share(0) * 100)}%</text>
        <text x="92" y="193" textAnchor="end">Commits</text>
      </g>
    </svg> : <p role="status">{failed ? 'Activity overview is temporarily unavailable.' : counts ? 'No public activity found for this period.' : 'Loading activity overview…'}</p>}
    <small>Public GitHub search totals over the past year. Code review counts reviewed pull requests created in this period.</small>
  </figure>;
}
