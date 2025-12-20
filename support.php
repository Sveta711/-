<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="style.css">
         <title>SUPPORT</title>
  <script src="https://kit.fontawesome.com/c96de77452.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" href="image/logo.png" type="image/x-icon">
    <style>
       
.support-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.support-container h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
    font-weight: 600;
    color: #34495e;
}

input[type="text"],
input[type="email"],
select,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #dcdde1;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box; 
    transition: border-color 0.3s ease;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
}

textarea {
    resize: vertical; }

.b {
    background-color: #42865eff;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
.b:hover {
    background-color: #3e7756ff;
}

.b:active {
    transform: scale(0.98);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .support-container {
        margin: 20px;
        padding: 20px;
    }
}
    </style>
    </head>
    <body style="background-color: #f8f8f4ff; font-family: 'Inter', sans-serif;
    line-height: 1.5;">
        <?php include 'include/header.php' ?>
        <main>
            <div style="margin-top:300px;position:relative;padding:20px;gap:10px;"
            >
                <p><h2 style="color: #354a40">Support Center<h2>
<h4>How Can We Help You?</h4>
At AUDIORIA, we are committed to providing you with the best possible experience. Whether you're having trouble playing an audiobook, accessing your digital library, or just have a question about our services, our team is here to help.

<h4>Frequently Asked Questions (FAQ)</h4>
<h5>How do I listen to my audiobooks?</h5> You can stream directly from our web player or download files to listen offline through your account dashboard.

<h5>I can’t access my purchased book. What should I do?</h5> First, ensure you are logged in. If the issue persists, please refresh your library or contact us with your order ID.

<h5>What file formats do you support?</h5> We provide high-quality MP3 for audiobooks and PDF/EPUB formats for E-books to ensure compatibility with all devices.

<h4>Contact Us</h4>
If you couldn't find the answer you were looking for, please reach out to us through any of the following channels:

Email Support: [support@yourdomain.com]

Response time: Usually within 24 hours.

Live Chat: Available Monday to Friday, 9:00 AM – 6:00 PM.

Technical Support: For issues regarding site functionality or downloads, please include your device type and browser in your message.

<h4>Feedback</h4>
Your suggestions help us grow. If you have a book recommendation or a feature you'd like to see on our platform, don't hesitate to let us know!

Quick Tip: Before contacting us, please ensure your browser is up to date for the best audio streaming experience.</p>
            </div>
            <div class="support-container">
    <h2>Send us a Message</h2>
    <form action="send_support.php" method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your full name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your email address" required>

        <label for="issue">How can we help?</label>
        <select id="issue" name="issue">
            <option value="technical">Technical Issue</option>
            <option value="billing">Billing/Payment</option>
            <option value="request">Book Request</option>
            <option value="other">Other</option>
        </select>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Describe your issue here..." required></textarea>

        <button type="submit" class="b">Submit Request</button>
    </form>
</div>
</main>
 <?php include 'include/footer.php' ?>
</body>
    </html>