export type Project = {
  slug: string;
  title: string;
  subtitle: string;
  summary: string;
  icon: string;
  tags: string[];
  heroImage: string;
  category: string;
  details: Record<string, string>;
  features: { title: string; body: string; icon: string }[];
  metrics?: { value: string; label: string }[];
  gallery?: { src: string; title: string; caption: string; badge?: string }[];
  impact?: { title: string; body: string }[];
};

export const projects: Project[] = [
  {
    slug: "meta-shark-ecommerce",
    title: "META SHARK E-Commerce",
    subtitle: "Multi-role marketplace for buyers, sellers, and administrators",
    summary: "Full-featured online shopping platform with secure authentication, vendor workflows, checkout, and order updates.",
    icon: "devicon-html5-plain",
    tags: ["Laravel", "PHP", "MySQL", "Bootstrap", "E-Commerce"],
    heroImage: "/ims/landingpage.jpeg",
    category: "Marketplace Platform",
    details: { Client: "Academic / Marketplace concept", Duration: "4 months", Role: "Full-Stack Developer", Status: "Completed" },
    features: [
      { title: "Multi-Vendor Architecture", body: "Separate workflows for customers, sellers, and administrators.", icon: "fa-store" },
      { title: "Inventory Tracking", body: "Seller tools for active listings, stock, and order status updates.", icon: "fa-boxes-stacked" },
      { title: "Responsive Shopping Flow", body: "Product pages, checkout, notifications, and mobile-friendly browsing.", icon: "fa-mobile-screen" },
      { title: "Secure Payments", body: "Checkout flow designed around safe transactions and clear order states.", icon: "fa-credit-card" },
    ],
    gallery: [
      { src: "/ims/landingpage.jpeg", title: "Landing Page", caption: "Dynamic product promos and public entry point.", badge: "Public" },
      { src: "/ims/Phone.jpeg", title: "Product Display", caption: "Specs, reviews, and add-to-cart interactions.", badge: "Buyer" },
      { src: "/ims/ecom_login.jpeg", title: "Secure Login", caption: "Unified authentication gateway.", badge: "Auth" },
      { src: "/ims/Notification.jpeg", title: "Notifications", caption: "Order updates and system alerts.", badge: "System" },
      { src: "/ims/Seller-dasboard.jpeg", title: "Seller Dashboard", caption: "Sales, revenue, and active listing overview.", badge: "Seller" },
      { src: "/ims/SellerOrderStatus.jpeg", title: "Order Management", caption: "Seller-side fulfillment and return tools.", badge: "Seller" },
      { src: "/ims/Checkout.jpeg", title: "Checkout Flow", caption: "Multi-step buyer checkout experience.", badge: "Buyer" },
    ],
  },
  {
    slug: "csd-lms",
    title: "CSD Learning Management System",
    subtitle: "Secure learning platform for the Computer Studies Department",
    summary: "Learning management system for course content, progress tracking, users, and role-based access.",
    icon: "devicon-moodle-plain",
    tags: ["PHP", "MySQL", "Security", "Bootstrap"],
    heroImage: "/ims/screenshot-215335.png",
    category: "Learning Management",
    details: { Client: "Computer Studies Department", Duration: "3 months", Role: "Lead Developer", Status: "Completed" },
    features: [
      { title: "Secure Authentication", body: "Role-based access control for students and faculty.", icon: "fa-lock" },
      { title: "User Management", body: "Permission levels and organized account administration.", icon: "fa-users" },
      { title: "Course Management", body: "Interfaces for managing courses and educational content.", icon: "fa-book" },
      { title: "Progress Tracking", body: "Reporting tools for student progress and participation.", icon: "fa-chart-line" },
    ],
    impact: [
      { title: "Improved Engagement", body: "Students get a clearer place to follow coursework and requirements." },
      { title: "Reduced Admin Work", body: "Faculty workflows are streamlined through centralized course management." },
    ],
  },
  {
    slug: "meta-shark",
    title: "META SHARK Admin Dashboard",
    subtitle: "E-commerce administration dashboard with analytics and controls",
    summary: "Real-time dashboard for revenue, inventory, users, orders, seller shops, appeals, and category analytics.",
    icon: "devicon-react-original",
    tags: ["Dashboard", "Analytics", "UI/UX", "Laravel"],
    heroImage: "/ims/dashboard-overview.jpeg",
    category: "Admin Dashboard",
    details: { Client: "E-Commerce Admin", Duration: "3 months", Role: "Full-Stack Developer", Status: "Completed" },
    features: [
      { title: "Analytics Dashboard", body: "Revenue tracking, order analytics, and performance metrics.", icon: "fa-chart-line" },
      { title: "User Management", body: "Roles, permissions, account status, and activity monitoring.", icon: "fa-users" },
      { title: "Inventory Management", body: "Product catalog, stock tracking, pricing, and categories.", icon: "fa-boxes-stacked" },
      { title: "Appeals System", body: "Resolution workflows for seller and user appeals.", icon: "fa-flag" },
    ],
    gallery: [
      { src: "/ims/dashboard-overview.jpeg", title: "Dashboard Overview", caption: "Main KPI and analytics display." },
      { src: "/ims/user-management.jpeg", title: "User Management", caption: "Complete user administration interface." },
      { src: "/ims/shop-management.jpeg", title: "Shop Management", caption: "Seller performance monitoring." },
      { src: "/ims/orders-management.jpeg", title: "Orders Management", caption: "Order processing and tracking." },
      { src: "/ims/product-management.jpeg", title: "Product Management", caption: "Inventory and catalog controls." },
      { src: "/ims/analytics-center.jpeg", title: "Analytics Center", caption: "Comprehensive data analytics." },
      { src: "/ims/revenue-analysis.jpeg", title: "Revenue Analysis", caption: "Financial performance metrics." },
      { src: "/ims/geo-chart.jpeg", title: "Geographic Analysis", caption: "Location-based sales data." },
    ],
  },
  {
    slug: "student-management",
    title: "Student Management System",
    subtitle: "Academic planning and student administration platform",
    summary: "Automated scheduling, grade monitoring, prerequisite checks, and academic roadmap planning.",
    icon: "devicon-php-plain",
    tags: ["PHP", "MySQL", "Automation", "AJAX"],
    heroImage: "/ims/studentmanagementsys.png",
    category: "Academic System",
    details: { Client: "Computer Studies Department", Duration: "3 months", Role: "Lead Developer & System Architect", Status: "Completed" },
    metrics: [
      { value: "85%", label: "Reduction in scheduling conflicts" },
      { value: "95%", label: "Student satisfaction rate" },
      { value: "70%", label: "Improved academic performance" },
    ],
    features: [
      { title: "Conflict Detection", body: "Prevents schedule conflicts before they happen.", icon: "fa-robot" },
      { title: "Grade Monitoring", body: "Tracks academic performance with live updates.", icon: "fa-chart-line" },
      { title: "Prerequisite Checks", body: "Verifies course sequencing automatically.", icon: "fa-check-circle" },
      { title: "Academic Roadmaps", body: "Plans and tracks personalized learning journeys.", icon: "fa-road" },
    ],
  },
  {
    slug: "course-management",
    title: "Course Activity Management System",
    subtitle: "Academic activity scheduling and deadline management",
    summary: "Real-time activity tracking, dynamic calendar views, automated reminders, and activity analytics.",
    icon: "devicon-html5-plain",
    tags: ["JavaScript", "PHP", "MySQL", "LocalStore"],
    heroImage: "/ims/screenshot-214449.png",
    category: "Productivity Tool",
    details: { Client: "Computer Studies Department", Duration: "4 months", Role: "Full-Stack Developer", Status: "Completed" },
    metrics: [
      { value: "60%", label: "Increase in student engagement" },
      { value: "45%", label: "Reduction in schedule conflicts" },
      { value: "80%", label: "Faculty satisfaction rate" },
    ],
    features: [
      { title: "Activity Tracking", body: "Monitors academic activities as they happen.", icon: "fa-clock" },
      { title: "Dynamic Calendar", body: "Interactive calendar for scheduling and planning.", icon: "fa-calendar-days" },
      { title: "Automated Reminders", body: "Smart alerts for deadlines and important events.", icon: "fa-bell" },
      { title: "Analytics Dashboard", body: "Reports for activity, performance, and engagement.", icon: "fa-chart-bar" },
    ],
  },
  {
    slug: "jirai-ide",
    title: "Jirai IDE",
    subtitle: "Collaborative IDE workspace with project management and developer tools",
    summary: "A custom developer workspace built for collaborative coding, project organization, and productivity-focused development workflows.",
    icon: "devicon-react-original",
    tags: ["React", "TypeScript", "Collaboration", "Developer Tools"],
    heroImage: "/ims/Jirai_landingPage.png",
    category: "Developer Tool",
    details: { Client: "Independent Project", Duration: "2025", Role: "Full-Stack Developer", Status: "In Development" },
    features: [
      { title: "Collaborative Workspace", body: "Structured workspace for developers to manage code, projects, and tasks in one place.", icon: "fa-users-gear" },
      { title: "Project Management", body: "Tools for organizing development work, tracking progress, and keeping project context visible.", icon: "fa-diagram-project" },
      { title: "Developer Experience", body: "Interface patterns designed around speed, clarity, and repeatable development workflows.", icon: "fa-code" },
      { title: "Cloud-Ready Workflow", body: "Built with modern deployment and integration workflows in mind.", icon: "fa-cloud-arrow-up" },
    ],
    gallery: [
      { src: "/ims/Jirai_landingPage.png", title: "Landing Page", caption: "Public-facing entry screen for the Jirai IDE workspace.", badge: "Public" },
      { src: "/ims/Jirai_IDE_Editor(Personal).jpg", title: "Personal Editor", caption: "Personal coding workspace for individual development.", badge: "Editor" },
      { src: "/ims/Jirai_IDE_SharedWorkspace.png", title: "Jirai IDE Editor", caption: "Collaborative editor workspace for shared development sessions.", badge: "Editor" },
      { src: "/ims/Jirai_Code_review.jpg", title: "Code Review", caption: "Review interface for inspecting and improving code changes.", badge: "Review" },
      { src: "/ims/Jirai_IDE_General_workspaces.jpeg", title: "General Workspaces", caption: "Workspace overview for managing project environments.", badge: "Workspace" },
      { src: "/ims/Jirai_IDE_messages.jpeg", title: "Messages", caption: "Messaging interface for coordination inside the tool.", badge: "Chat" },
      { src: "/ims/Jirai_IDE_My network_tracker.jpeg", title: "Network Tracker", caption: "Network and connection tracking view for developer activity.", badge: "Network" },
      { src: "/ims/Jirai_IDE_portfolio_Page.jpeg", title: "Portfolio Page", caption: "Developer portfolio/profile area inside the Jirai environment.", badge: "Profile" },
      { src: "/ims/Jirai_IDE_extenshionPage.jpeg", title: "Extensions", caption: "Extension discovery and management screen.", badge: "Tools" },
      { src: "/ims/Jirai_setting.jpg", title: "Settings", caption: "Account and workspace configuration area.", badge: "Settings" },
    ],
    impact: [
      { title: "Productivity Focus", body: "Designed to reduce context switching for developers working across tools and projects." },
      { title: "Collaboration Ready", body: "Supports the foundation for shared development workflows and team-oriented project spaces." },
    ],
  },
  {
    slug: "freelancer-marketplace",
    title: "Freelancer Marketplace (trabaho)",
    subtitle: "Marketplace platform connecting freelancers and clients",
    summary: "A freelancer marketplace concept with authentication, dashboards, client-freelancer workflows, and role-based user experiences.",
    icon: "devicon-react-original",
    tags: ["React", "Supabase", "Authentication", "Dashboards"],
    heroImage: "/ims/LandingPage_trabaho.png",
    category: "Marketplace Platform",
    details: { Client: "Independent Project", Duration: "2025", Role: "Full-Stack Developer", Status: "Prototype" },
    features: [
      { title: "User Authentication", body: "Role-aware sign-in flow for freelancers and clients.", icon: "fa-user-shield" },
      { title: "Client Dashboard", body: "Workspace for posting work, reviewing freelancer activity, and managing project status.", icon: "fa-briefcase" },
      { title: "Freelancer Dashboard", body: "Tools for profile visibility, task tracking, and opportunity discovery.", icon: "fa-id-card" },
      { title: "Marketplace Workflow", body: "Connection flow designed around clear requests, statuses, and communication.", icon: "fa-handshake" },
    ],
    gallery: [
      { src: "/ims/LandingPage_trabaho.png", title: "Landing Page", caption: "Public-facing introduction to the marketplace and core offer.", badge: "Public" },
      { src: "/ims/Login_trabaho.png", title: "Login", caption: "Authentication screen for returning users.", badge: "Auth" },
      { src: "/ims/Signup_trabaho.png", title: "Signup", caption: "Registration flow for new freelancers and clients.", badge: "Auth" },
      { src: "/ims/Dashboard_trabaho.png", title: "Dashboard", caption: "Main workspace for tracking marketplace activity.", badge: "Dashboard" },
      { src: "/ims/Marketplace_trabaho.png", title: "Marketplace", caption: "Browse and discover available services or work opportunities.", badge: "Browse" },
      { src: "/ims/Commission_Page_trabaho.png", title: "Commission Page", caption: "Commission workflow for requests, details, and project coordination.", badge: "Work" },
      { src: "/ims/workspacesPage_trabaho.png", title: "Workspaces", caption: "Workspace area for organizing project collaboration.", badge: "Work" },
      { src: "/ims/Invoices_page_trabaho.png", title: "Invoices", caption: "Invoice tracking and payment-related records.", badge: "Finance" },
      { src: "/ims/payment_page_trabaho.png", title: "Payment Page", caption: "Payment interface for marketplace transactions.", badge: "Finance" },
      { src: "/ims/Review_page_trabaho.png", title: "Reviews", caption: "Review flow for feedback and trust-building.", badge: "Trust" },
      { src: "/ims/portfolio_setting_trabaho.png", title: "Portfolio Settings", caption: "Freelancer portfolio configuration screen.", badge: "Settings" },
      { src: "/ims/Settingpage_default_trabaho.png", title: "Default Settings", caption: "Account and platform settings screen.", badge: "Settings" },
      { src: "/ims/subscription_page_trabaho.png", title: "Subscription Page", caption: "Subscription and plan management view.", badge: "Plans" },
    ],
    impact: [
      { title: "Better Matching", body: "Aims to make freelance discovery and project coordination easier for local users." },
      { title: "Structured Workflows", body: "Provides a clearer experience for both clients and freelancers compared with scattered chat-based coordination." },
    ],
  },
  {
    slug: "interactive-discord-bot",
    title: "Interactive Discord Bot",
    subtitle: "Automation and engagement bot for Discord communities",
    summary: "A Discord bot focused on server management, interactive commands, community engagement, moderation support, and automated activities.",
    icon: "devicon-javascript-plain",
    tags: ["JavaScript", "Discord API", "Automation", "Bot Development"],
    heroImage: "/ims/larpy.png",
    category: "Automation Bot",
    details: { Client: "Freelance", Duration: "2024", Role: "Discord Bot Developer", Status: "Completed" },
    features: [
      { title: "Interactive Commands", body: "Command flows for activities, server utilities, and community interactions.", icon: "fa-terminal" },
      { title: "Moderation Support", body: "Tools to help manage community behavior and server operations.", icon: "fa-shield-halved" },
      { title: "Automation", body: "Automated responses and workflow helpers for active Discord servers.", icon: "fa-robot" },
      { title: "Engagement Features", body: "Activities and interaction patterns designed to keep community members involved.", icon: "fa-comments" },
    ],
    impact: [
      { title: "Community Support", body: "Helped servers improve engagement and reduce repetitive manual management." },
      { title: "Maintainable Commands", body: "Designed command behavior so new features can be added without breaking existing flows." },
    ],
  },
];

export const featuredProjects = projects.map(({ slug, title, summary, icon, tags, heroImage, category }) => ({
  slug,
  title: title.replace(" Admin Dashboard", "").replace(" E-Commerce", ""),
  summary,
  icon,
  heroImage,
  category,
  tags: tags.slice(0, 3),
}));
