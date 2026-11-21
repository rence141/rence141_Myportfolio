export type Certificate = {
  title: string;
  issuer: string;
  date?: string;
  credential?: string;
  verifyUrl?: string;
  image: string;
  pdf?: string;
};

export const certificates: Certificate[] = [
  {
    title: "Introduction to Kubernetes (LFS158)",
    issuer: "The Linux Foundation",
    date: "February 11, 2026",
    credential: "LF-25bk62dk0z",
    image: "/certs/kubernetes.png",
    pdf: "/certs/lorenze-nio-9081eb64-2047-431d-a703-6554d64ae45f-certificate.pdf",
  },
  {
    title: "Secure AI/ML-Driven Software Development (LFEL1012)",
    issuer: "The Linux Foundation · OpenSSF",
    date: "February 11, 2026",
    credential: "LF-w32vy960pq",
    image: "/certs/secure-ai-ml.png",
    pdf: "/certs/lorenze-nio-ff8c876d-376c-473b-a288-a5a4f4314257-certificate.pdf",
  },
  {
    title: "Getting Started with OpenTelemetry (LFS148)",
    issuer: "The Linux Foundation",
    date: "February 11, 2026",
    credential: "LF-0ibpcisx9w",
    image: "/certs/opentelemetry.png",
    pdf: "/certs/lorenze-nio-23378732-cc44-43d4-8cb0-240691f0a801-certificate.pdf",
  },
  {
    title: "Introduction to JavaScript Security (LFS184)",
    issuer: "The Linux Foundation",
    date: "February 18, 2026",
    credential: "LF-huuzoaw0wo",
    image: "/certs/javascript-security.png",
    pdf: "/certs/lorenze-nio-prepotente-3c9da43e-38d7-4781-90d3-c3e716e326c4-certificate.pdf",
  },
  {
    title: "Introduction to WebAssembly (LFD133)",
    issuer: "The Linux Foundation",
    date: "May 23, 2026",
    credential: "LF-c3rtuvuilw",
    image: "/certs/webassembly.png",
    pdf: "/certs/lorenze-nio-prepotente-00a4d646-e3dc-418c-807e-947de6e24334-certificate.pdf",
  },
  {
    title: "Build a Free Website with WordPress",
    issuer: "Coursera",
    date: "February 19, 2026",
    credential: "90BMQ8L6BY6P",
    verifyUrl: "https://coursera.org/verify/90BMQ8L6BY6P",
    image: "/certs/wordpress-coursera.png",
    pdf: "/certs/Coursera%2090BMQ8L6BY6P.pdf",
  },
];
