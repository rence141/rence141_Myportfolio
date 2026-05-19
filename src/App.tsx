import { useEffect } from "react";
import { Intro } from "./components/Intro";
import { Portfolio } from "./components/Portfolio";
import { ProjectDetail } from "./components/ProjectDetail";
import { useHashRoute } from "./hooks/useHashRoute";

export default function App() {
  const { path, anchor } = useHashRoute();
  const projectMatch = path.match(/^\/project\/(.+)$/);

  useEffect(() => {
    if (path === "/portfolio") {
      if (anchor) document.getElementById(anchor)?.scrollIntoView();
    } else {
      window.scrollTo(0, 0);
    }
  }, [path, anchor]);

  if (projectMatch) return <ProjectDetail slug={projectMatch[1]} />;
  if (path === "/portfolio") return <Portfolio />;

  return <Intro />;
}
