const express = require("express");
const bodyParser = require("body-parser");
const nodemailer = require("nodemailer");
const cors = require("cors");

const app = express();
const PORT = 5000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors());

// Route for sending emails
app.post("/contact", async (req, res) => {
  const { name, email, message } = req.body;

  try {
    // Configure email transporter (using Gmail as example)
    let transporter = nodemailer.createTransport({
      service: "gmail",
      auth: {
        user: "your_email@gmail.com", // replace with your Gmail
        pass: "your_app_password",    // replace with Gmail App Password
      },
    });

    // Send mail
    await transporter.sendMail({
      from: email,
      to: "your_email@gmail.com", // your inbox
      subject: `Portfolio Contact: ${name}`,
      text: message,
      replyTo: email,
    });

    res.status(200).json({ success: true, message: "Email sent successfully!" });
  } catch (error) {
    console.error("Error:", error);
    res.status(500).json({ success: false, message: "Failed to send email." });
  }
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
