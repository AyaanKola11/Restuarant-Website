<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Sultan Restaurant</title>
    <link rel="stylesheet" href="contactPage.css">
    <?php include('partials-frontend/menu.php'); ?>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .contact-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fcfbf4;
        }
        .contact-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .contact-details {
            margin-bottom: 30px;
        }
        .contact-details h3 {
            margin-bottom: 15px;
        }
        .reservation-hours {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<h1>Contact Us</h1>
    <div class="contact-container">
        <div class="contact-header">
           
            <p>We'd love to hear from you! Reach out to us using the information below.</p>
        </div>

        <div class="contact-details">
            <h3>Contact Information</h3>
            <p><strong>Phone:</strong> +27 81 356 2801</p>
            <p><strong>Email:</strong> sultanarab1585@gmail.com</p>
            <p><strong>Address:</strong> Cami St, Halfway House, Midrand, South Africa</p>
        </div>

        <div class="reservation-hours">
            <h3>Operating Hours</h3>
            <br>
            <p><strong>Monday to Friday:</strong> 10:00 AM - 22:00 PM</p>
            <p><strong>Saturday:</strong> 10:00 AM - 20:00 PM</p>
            <p><strong>Sunday:</strong> Closed</p>
        </div>

        <div class="map">
            <h3>Our Location</h3>
            <br>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3585.5832155971966!2d28.129102000000003!3d-26.014467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDAwJzUyLjEiUyAyOMKwMDcnNDQuOCJF!5e0!3m2!1sen!2sza!4v1718731665447!5m2!1sen!2sza" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>

    <?php include('partials-frontend/footer.php'); ?>

