# My Portfolio

A modern, responsive portfolio website built with PHP, HTML, CSS, and Bootstrap. Features a contact form, project showcase, and animated elements.

## Features

- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Contact Form**: Functional contact form that saves messages to a file
- **Animated Background**: Falling code animation for a tech-focused aesthetic
- **Project Showcase**: Display your projects with images and descriptions
- **Skills Section**: Highlight your technical skills with icons
- **Modern UI**: Clean, professional design using Bootstrap 5

## Technologies Used

- **PHP 8.2**: Backend processing and contact form handling
- **HTML5**: Semantic markup
- **CSS3**: Custom styling and animations
- **Bootstrap 5**: Responsive framework
- **Font Awesome**: Icons
- **Devicon**: Technology icons

## Quick Start with Docker

### Prerequisites
- Docker installed on your system

### Local Development

1. **Clone the repository**
   ```bash
   git clone https://github.com/rence141/rence141_Myportfolio.git
   cd rence141_Myportfolio
   ```

2. **Build the Docker image**
   ```bash
   docker build -t my-portfolio .
   ```

3. **Run the container**
   ```bash
   docker run -p 8080:80 my-portfolio
   ```

4. **Access your portfolio**
   Open your browser and go to: `http://localhost:8080`

### Production Deployment

#### Option 1: Render (Recommended)

1. **Push to GitHub**
   ```bash
   git add .
   git commit -m "Add Docker support"
   git push origin main
   ```

2. **Deploy on Render**
   - Go to [Render.com](https://render.com)
   - Create a new Web Service
   - Connect your GitHub repository
   - Set the following:
     - **Build Command**: `docker build -t portfolio .`
     - **Start Command**: `docker run -p $PORT:80 portfolio`
   - Deploy!

#### Option 2: Railway

1. **Deploy on Railway**
   - Go to [Railway.app](https://railway.app)
   - Create a new project
   - Connect your GitHub repository
   - Railway will automatically detect the Dockerfile and deploy

#### Option 3: DigitalOcean App Platform

1. **Deploy on DigitalOcean**
   - Go to [DigitalOcean App Platform](https://cloud.digitalocean.com/apps)
   - Create a new app
   - Connect your GitHub repository
   - Select Docker as the source type
   - Deploy!

## File Structure

```
rence141_Myportfolio/
├── portfolio.php          # Main portfolio page
├── projects/              # Project images and assets
├── ims/                   # Additional assets
├── messages/              # Contact form messages (auto-created)
├── Dockerfile             # Docker configuration
├── .dockerignore          # Docker ignore file
└── README.md              # This file
```

## Customization

### Personal Information
Edit `portfolio.php` to update:
- Your name and introduction
- Contact information
- Social media links
- Skills and technologies
- Project descriptions

### Styling
The CSS is embedded in the HTML file. You can modify:
- Color scheme (CSS variables at the top)
- Animations
- Layout and spacing
- Typography

### Contact Form
The contact form saves messages to `messages/contact_messages.txt`. You can:
- Modify the form fields
- Change the message format
- Add email notifications
- Integrate with a database

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test locally with Docker
5. Submit a pull request

## License

This project is open source and available under the [MIT License](LICENSE).

## Contact

- **Name**: Lorenze Fernandez Prepotente (Rence)
- **Email**: [Your Email]
- **GitHub**: [https://github.com/rence141](https://github.com/rence141)

---

Built with ❤️ using PHP and Docker 