import { useEffect } from "react";
import { Home } from "./components/Home";

import { ProjectDetail } from "./components/ProjectDetail";
import { useHashRoute } from "./hooks/useHashRoute";

export default function App() {
  const { path, anchor } = useHashRoute();
  const projectMatch = path.match(/^\/project\/(.+)$/);

  useEffect(() => {
    document.title = projectMatch ? "Project | Rence" : path === "/portfolio" ? "Portfolio | Rence" : "Rence | Websites, Business Tools & Automation";
    if (path === "/") return;
    const target = anchor ? document.getElementById(anchor) : document.querySelector("h1");
    if (target instanceof HTMLElement) {
      target.tabIndex = -1;
      target.focus({ preventScroll: true });
    }
  }, [path, anchor]);

  useEffect(() => {
    if (path === "/portfolio" || path === "/") {
      if (anchor) {
        const timer = setTimeout(() => {
          document.getElementById(anchor)?.scrollIntoView({ behavior: "smooth" });
        }, 60);
        return () => clearTimeout(timer);
      } else {
        window.scrollTo(0, 0);
      }
    } else {
      window.scrollTo(0, 0);
    }
  }, [path, anchor]);

  if (projectMatch) return <ProjectDetail key={projectMatch[1]} slug={projectMatch[1]} />;
  return <Home splash={path === "/"} />;
}
