# My Portfolio

A React + TypeScript portfolio converted from the original PHP version. It keeps the animated intro, main portfolio sections, project detail pages, theme toggle, responsive layouts, and existing screenshots.

## Tech Stack

- React
- TypeScript
- Vite
- CSS
- Docker + Nginx for production

## Local Development

```bash
npm install
npm run dev
```

Open the URL shown by Vite, usually `http://localhost:5173`.

## Production Build

```bash
npm run build
npm run preview
```

## Docker

```bash
docker build -t my-portfolio .
docker run -p 8080:80 my-portfolio
```

Open `http://localhost:8080`.

## Project Structure

```text
src/
  App.tsx              React app, routes, pages, and components
  data/projects.ts     Portfolio/project data
  styles.css           Global styling
public/ims/            Portfolio image assets copied from ims/
Dockerfile             Multi-stage React build served by Nginx
nginx.conf             SPA fallback config
```

## Notes

The previous PHP contact form used server-side sessions and mail. In this React build, the form opens the visitor's email app with the message pre-filled. For hosted form delivery, connect the form to an email API or form service later.
