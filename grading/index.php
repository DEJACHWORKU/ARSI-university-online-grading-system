<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARSI University Online Student Grading System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/index.css"> 

</head>
<body>
    <header>
        <img src="image/logo.png" alt="ARSI University Logo" class="logo">
        <h1>ARSI UNIVERSITY ONLINE STUDENT GRADE MANAGEMENT SYSTEM</h1>
    </header>
    
    <nav id="navbar">
        <a href="#home">Home <i class="fas fa-home"></i></a>
        <a href="https://arsiun.edu.et/">About us <i class="fas fa-info-circle"></i></a>
        <a href="services/index.php">User Help <i class="fas fa-chalkboard-teacher"></i></a>
        <a href="scheduling/index.php">Notification <i class="fas fa-bell"></i></a>
        <div class="dropdown">
            <a href="#login" id="login-dropdown">Login <i class="fas fa-user-lock"></i> <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content" id="login-menu">
                <a href="Admin/admin.php">Administrator <i class="fas fa-user-cog"></i></a>
                <a href="Head/head.php">Dept Head   <i class="fas fa-user"></i></a>
                <a href="Teacher/teacher.php">Teacher <i class="fas fa-chalkboard-teacher"></i></a>
                <a href="Student/student.php">Student <i class="fas fa-user-graduate"></i></a>
                <a href="Registeral/registerar.php">Registrar <i class="fas fa-user-tag"></i></a>
              
            </div>
        </div>
        <a href="#help" class="help-icon"><i class="fas fa-hand-point-left"></i></a> <!-- Finger clickable icon -->
    </nav>

    <div class="home-message">
        <div class="text-section">
            <h2>Welcome to ARSI University! <br> STUDENT GRADING MANAGEMENT SYSTEM</h2>
            <pre>
At ARSI University, we are dedicated to providing a comprehensive online grading system that enhances the educational experience for students, teachers, and administrators alike. Our platform is designed to facilitate seamless communication and efficient management of academic records.

With the ARSI University Online Student Grading System, students can easily track their academic progress, view grades, and access important resources. The system allows for real-time updates and notifications regarding assignments, exams, and other academic activities, ensuring students remain informed and engaged.

Teachers can efficiently manage grades, assignments, and feedback, ensuring that every student receives the support they need to succeed. The grading system is user-friendly and intuitive, allowing educators to focus on teaching rather than administrative tasks.

Administrators maintain oversight of the entire academic process, ensuring transparency and accountability. The system provides robust analytics and reporting features, enabling quick access to academic performance data for informed decision-making.

Join us in revolutionizing education with our user-friendly system that prioritizes accessibility and engagement. We are committed to fostering an inclusive learning environment where every student can thrive academically and personally.
            </pre>
            <a href="readmore.php" class="read-more">Read More</a>
        </div>
        <div class="image-slider">
            <div class="slides">
                <div class="slide">
                    <img src="image/1.jpg" alt="Image 1">
                    <div class="overlay">ARSI university Grade Management</div>
                </div>
                <div class="slide">
                    <img src="image/2.jpg" alt="Image 2">
                    <div class="overlay">User friendly student grade management system</div>
                </div>
                <div class="slide">
                    <img src="image/3.jpg" alt="Image 3">
                    <div class="overlay">Easily access student information.</div>
                </div>
                <div class="slide">
                    <img src="image/4.jpg" alt="Image 4">
                    <div class="overlay">Data security and privacy on student grades</div>
                </div>
                <div class="slide">
                    <img src="image/5.jpg" alt="Image 5">
                    <div class="overlay">Easily generate grade reports in digital system</div>
                </div>
            </div>
            <button class="nav-button left" onclick="moveSlide(-1)">&#10094;</button>
            <button class="nav-button right" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </div>

    <footer>
        <div class="contact-info">
            <p>Contact Us</p>
            <div>
                <i class="fas fa-envelope"></i> Email: info@arsiuniversity.edu
            </div>
            <div>
                <i class="fas fa-phone"></i> Phone: (123) 456-7890
            </div>
            <div>
                <i class="fas fa-map-marker-alt"></i> Postal Box: 12345
            </div>
        </div>
        <div class="social-icons">
            <p>Follow Us:</p>
            <div>
                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="telegram"><i class="fab fa-telegram-plane"></i></a>
                <a href="#" class="website"><i class="fas fa-globe"></i></a> 
            </div>
        </div>
        <div class="footer-copyright">
            <p>&copy; 2025 ARSI University. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // Login Dropdown Functionality
        const loginDropdown = document.getElementById('login-dropdown');
        const loginMenu = document.getElementById('login-menu');

        loginDropdown.addEventListener('click', (event) => {
            event.preventDefault();
            loginMenu.classList.toggle('show');
        });

        window.addEventListener('click', (event) => {
            if (!loginDropdown.contains(event.target) && !loginMenu.contains(event.target)) {
                loginMenu.classList.remove('show');
            }
        });

        // Image Slider Functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            currentSlideIndex = (index + totalSlides) % totalSlides;
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.style.transform = `translateX(-${currentSlideIndex * 100}%)`;
        }

        function moveSlide(direction) {
            showSlide(currentSlideIndex + direction);
        }

        setInterval(() => {
            showSlide(currentSlideIndex + 1);
        }, 15000); 

        showSlide(currentSlideIndex); 

        // Adjust section layout based on screen size
        function adjustTextSection() {
            const textSection = document.querySelector('.text-section');
            const imageSlider = document.querySelector('.image-slider');
            const homeMessage = document.querySelector('.home-message');

            if (window.innerWidth < 600) {
                textSection.style.width = '90%'; 
                imageSlider.style.width = '90%'; 
                homeMessage.style.flexDirection = 'column'; 
                textSection.style.marginBottom = '20px'; 
            } else {
                textSection.style.width = '50%'; 
                imageSlider.style.width = '50%'; 
                homeMessage.style.flexDirection = 'row'; 
                textSection.style.marginBottom = '0'; 
            }

            const textHeight = textSection.scrollHeight;
            imageSlider.style.height = textHeight + 'px'; 
        }

        window.addEventListener('resize', adjustTextSection);
        window.addEventListener('load', adjustTextSection);
    </script>
</body>
</html>