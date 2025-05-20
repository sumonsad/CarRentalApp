@extends('layouts.app')
@include('frontend.navbar')
@section('content')

    <!-- Navbar -->
    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Contact Us</h1>
            <p class="lead">We'd love to hear from you! Reach out to us anytime.</p>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Get in Touch</h2>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p>If you prefer, you can also contact us directly:</p>
                <ul class="list-unstyled">
                    <li><strong>Address:</strong> 123 Main Street, Cityville, Country</li>
                    <li><strong>Phone:</strong> (123) 456-7890</li>
                    <li><strong>Email:</strong> contact@company.com</li>
                    <li><strong>Working Hours:</strong> Mon - Fri, 9 AM - 6 PM</li>
                </ul>

                <h3>Follow Us</h3>
                <a href="#" class="btn btn-outline-primary me-2">Facebook</a>
                <a href="#" class="btn btn-outline-info me-2">Twitter</a>
                <a href="#" class="btn btn-outline-danger">Instagram</a>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="container my-5">
        <h2 class="text-center">Our Location</h2>
        <div class="ratio ratio-16x9">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509364!2d144.9559283153169!3d-37.81720997975161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e33!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sus!4v1633022342345!5m2!1sen!2sus"
                style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Company Name. All rights reserved.</p>
    </footer>
 @endsection
