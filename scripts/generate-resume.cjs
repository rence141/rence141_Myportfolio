const fs = require("fs");
const path = require("path");

const outPath = path.resolve(__dirname, "..", "Resume_Lorenze_Prepotente_Updated.pdf");

const resume = {
  name: "LORENZE PREPOTENTE",
  contact: ["lorenzeprepotente@gmail.com", "+63 967 247 9726", "GitHub / Portfolio Available Upon Request"],
  sections: [
    {
      title: "ABOUT",
      body: [
        "Motivated and adaptable Full-Stack Developer with experience in building web applications, desktop systems, Discord bots, and collaborative development tools. Skilled in React.js, TypeScript, APIs, Supabase, Flutter, and modern software development workflows. Passionate about creating innovative systems that improve user experience and productivity.",
      ],
    },
    {
      title: "SKILLS",
      bullets: [
        "React.js & TypeScript",
        "Web Development",
        "API Integration",
        "MongoDB & Supabase",
        "Flutter Development",
        "Desktop & Mobile Applications",
        "Git & GitHub Collaboration",
        "Problem Solving & Teamwork",
      ],
    },
    {
      title: "EXPERIENCE",
      entries: [
        {
          heading: "FULL-STACK DEVELOPER",
          meta: "2025 - Present",
          body: "Developed custom applications including collaborative IDE systems, freelancer marketplaces, Discord bots, and productivity tools. Worked with React.js, APIs, Supabase, and cloud deployment platforms such as Railway and Render.",
        },
        {
          heading: "INDEPENDENT DEVELOPER / FREELANCER",
          meta: "2024 - 2025",
          body: "Collaborated with clients to understand requirements and deliver tailored software solutions.",
        },
        {
          heading: "DISCORD BOT DEVELOPER - FREELANCE",
          meta: "2024",
          body: "Created and maintained Discord bots focused on community engagement, automation, interactive commands, and server management.",
        },
      ],
    },
    {
      title: "PROJECTS",
      bullets: [
        "Jirai IDE - Custom collaborative IDE workspace with project management, shared workspaces, code review, messaging, extensions, portfolio pages, and developer tools.",
        "Freelancer Marketplace (trabaho) - Platform connecting freelancers and clients with authentication, dashboards, marketplace browsing, workspaces, invoices, payments, reviews, subscriptions, and portfolio settings.",
        "Interactive Discord Bot (Larpy) - Automation and engagement bot with interactive commands, activities, moderation features, and server management tools.",
        "META SHARK Admin Dashboard - E-commerce administration dashboard for revenue, inventory, users, orders, seller shops, appeals, category analytics, and geographic reports.",
        "META SHARK E-Commerce - Multi-role marketplace ecosystem with buyer, seller, and administrator interfaces, checkout flow, notifications, inventory tracking, and order management.",
        "CSD Learning Management System - Secure learning platform for course content, user management, role-based access, and progress tracking.",
        "Student Management System - Academic planning and student administration platform with scheduling, grade monitoring, prerequisite checks, and roadmap planning.",
        "Course Activity Management System - Academic activity tracking tool with dynamic calendar views, automated reminders, schedule management, and analytics.",
      ],
    },
    {
      title: "CERTIFICATIONS",
      bullets: [
        "Introduction to Kubernetes - The Linux Foundation",
        "Secure AI/ML-Driven Software Development - The Linux Foundation",
        "Getting Started with OpenTelemetry - The Linux Foundation",
        "Introduction to JavaScript Security - The Linux Foundation",
        "Build a Free Website with WordPress - Coursera",
      ],
    },
    {
      title: "EDUCATION",
      body: ["Bachelor of Science in Information Systems", "Bicol University - Polangui Campus"],
    },
    {
      title: "CERTIFICATION STATEMENT",
      body: ["I certify that the information provided is true and correct."],
    },
  ],
};

const PAGE_WIDTH = 612;
const PAGE_HEIGHT = 792;
const MARGIN_X = 54;
const TOP = 62;
const BOTTOM = 54;
const CONTENT_WIDTH = PAGE_WIDTH - MARGIN_X * 2;

const pages = [];
let commands = [];
let y = TOP;

function escapePdf(text) {
  return String(text).replace(/\\/g, "\\\\").replace(/\(/g, "\\(").replace(/\)/g, "\\)");
}

function line(text, x, yPos, size = 10, font = "F1", color = "0 0 0") {
  commands.push(`BT /${font} ${size} Tf ${color} rg ${x} ${yPos} Td (${escapePdf(text)}) Tj ET`);
}

function rule(yPos) {
  commands.push(`0.72 w 0.70 0.70 0.78 RG ${MARGIN_X} ${yPos} m ${PAGE_WIDTH - MARGIN_X} ${yPos} l S`);
}

function estimateWidth(text, size) {
  return String(text).length * size * 0.48;
}

function wrap(text, size, maxWidth) {
  const words = String(text).split(/\s+/);
  const lines = [];
  let current = "";
  for (const word of words) {
    const next = current ? `${current} ${word}` : word;
    if (estimateWidth(next, size) <= maxWidth || !current) {
      current = next;
    } else {
      lines.push(current);
      current = word;
    }
  }
  if (current) lines.push(current);
  return lines;
}

function newPage() {
  pages.push(commands.join("\n"));
  commands = [];
  y = TOP;
}

function ensure(space) {
  if (y + space > PAGE_HEIGHT - BOTTOM) newPage();
}

function addWrapped(text, options = {}) {
  const size = options.size || 10;
  const leading = options.leading || 14;
  const x = options.x || MARGIN_X;
  const width = options.width || CONTENT_WIDTH;
  const font = options.font || "F1";
  const color = options.color || "0 0 0";
  const indent = options.indent || 0;
  const lines = wrap(text, size, width - indent);
  ensure(lines.length * leading + 4);
  for (const item of lines) {
    line(item, x + indent, PAGE_HEIGHT - y, size, font, color);
    y += leading;
  }
}

function sectionTitle(title) {
  ensure(34);
  y += 8;
  line(title, MARGIN_X, PAGE_HEIGHT - y, 11, "F2", "0.22 0.17 0.55");
  y += 7;
  rule(PAGE_HEIGHT - y);
  y += 13;
}

function bullet(text) {
  ensure(28);
  line("-", MARGIN_X, PAGE_HEIGHT - y, 10, "F2");
  addWrapped(text, { x: MARGIN_X + 14, width: CONTENT_WIDTH - 14, size: 9.6, leading: 13 });
  y += 2;
}

function entry(item) {
  ensure(48);
  line(item.heading, MARGIN_X, PAGE_HEIGHT - y, 10.5, "F2");
  line(item.meta, PAGE_WIDTH - MARGIN_X - estimateWidth(item.meta, 9.5), PAGE_HEIGHT - y, 9.5, "F1", "0.32 0.32 0.38");
  y += 15;
  addWrapped(item.body, { size: 9.8, leading: 13 });
  y += 4;
}

function header() {
  line(resume.name, MARGIN_X, PAGE_HEIGHT - y, 22, "F2", "0.08 0.08 0.12");
  y += 20;
  addWrapped(resume.contact.join("  |  "), { size: 9.5, leading: 13, color: "0.25 0.25 0.32" });
  y += 8;
  rule(PAGE_HEIGHT - y);
  y += 16;
}

header();

for (const section of resume.sections) {
  sectionTitle(section.title);
  if (section.body) {
    for (const paragraph of section.body) {
      addWrapped(paragraph, { size: 9.8, leading: 13.5 });
      y += 5;
    }
  }
  if (section.bullets) {
    for (const item of section.bullets) bullet(item);
  }
  if (section.entries) {
    for (const item of section.entries) entry(item);
  }
}

pages.push(commands.join("\n"));

const objects = [];
function addObject(body) {
  objects.push(body);
  return objects.length;
}

const fontRegular = addObject("<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>");
const fontBold = addObject("<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>");
const pageIds = [];
const contentIds = [];

for (const page of pages) {
  const stream = `<< /Length ${Buffer.byteLength(page, "utf8")} >>\nstream\n${page}\nendstream`;
  contentIds.push(addObject(stream));
}

const pagesIdPlaceholder = "PAGES_ID";
for (let i = 0; i < pages.length; i += 1) {
  pageIds.push(
    addObject(
      `<< /Type /Page /Parent ${pagesIdPlaceholder} 0 R /MediaBox [0 0 ${PAGE_WIDTH} ${PAGE_HEIGHT}] /Resources << /Font << /F1 ${fontRegular} 0 R /F2 ${fontBold} 0 R >> >> /Contents ${contentIds[i]} 0 R >>`,
    ),
  );
}

const pagesId = addObject(`<< /Type /Pages /Kids [${pageIds.map((id) => `${id} 0 R`).join(" ")}] /Count ${pageIds.length} >>`);
for (let i = 0; i < objects.length; i += 1) {
  objects[i] = objects[i].replaceAll(`${pagesIdPlaceholder} 0 R`, `${pagesId} 0 R`);
}
const catalogId = addObject(`<< /Type /Catalog /Pages ${pagesId} 0 R >>`);

let pdf = "%PDF-1.4\n";
const offsets = [0];
for (let i = 0; i < objects.length; i += 1) {
  offsets.push(Buffer.byteLength(pdf, "utf8"));
  pdf += `${i + 1} 0 obj\n${objects[i]}\nendobj\n`;
}
const xrefOffset = Buffer.byteLength(pdf, "utf8");
pdf += `xref\n0 ${objects.length + 1}\n0000000000 65535 f \n`;
for (let i = 1; i < offsets.length; i += 1) {
  pdf += `${String(offsets[i]).padStart(10, "0")} 00000 n \n`;
}
pdf += `trailer\n<< /Size ${objects.length + 1} /Root ${catalogId} 0 R >>\nstartxref\n${xrefOffset}\n%%EOF\n`;

fs.writeFileSync(outPath, pdf);
console.log(outPath);
