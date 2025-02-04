<?php
session_start();

if (!isset($_SESSION['signin_success_message'])) {
    header("Location: login2.php");
    exit();
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"]) || !preg_match("/^[a-zA-Z]+$/", $_POST["firstName"])) {
        $errors['firstName'] = "First name is required and must contain only letters.";
    }
    if (!empty($_POST["middleName"]) && !preg_match("/^[a-zA-Z]*$/", $_POST["middleName"])) {
        $errors['middleName'] = "Middle name must contain only letters.";
    }
    if (empty($_POST["lastName"]) || !preg_match("/^[a-zA-Z]+$/", $_POST["lastName"])) {
        $errors['lastName'] = "Last name is required and must contain only letters.";
    }
    if (empty($_POST["phone"]) || !preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
        $errors['phone'] = "Phone number is required and must be exactly 10 digits.";
    }
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "A valid email is required.";
    }
    if (empty($_POST["password"]) || strlen($_POST["password"]) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div class="sidebar">
        <input type="file" id="dashboardProfilePictureInput" style="display: none;" accept="image/*" onchange="loadDashboardProfilePicture(event)">
        <img id="dashboardProfilePicture" src="default-profile.png" alt="" class="sidebar-profile-image" onclick="document.getElementById('dashboardProfilePictureInput').click();">
        <div class="button-container">
            <button class="edit-button" onclick="document.getElementById('dashboardProfilePictureInput').click();">Upload</button>
            <button class="save-button" onclick="saveDashboardProfile()">Save</button>
        </div>
        <h2>Admin Dashboard</h2>
        <div class="create-user">Create User Account</div>
        <div class="add-user"><a href="signup.php">Add Administrator</a></div>
        <div class="add-user" onclick="showForm('Department Head')"><a href="javascript:void(0)">Add Department Head</a></div>
        <div class="add-user" onclick="showForm('Teacher')"><a href="javascript:void(0)">Add Teacher</a></div>
        <div class="add-user" onclick="showForm('Registrar')"><a href="javascript:void(0)">Add Registrar</a></div>
        <div class="add-user"><a href="#">Give permission</a></div>
        <div class="add-user"><a href="#">View Users</a></div>
        <div class="settings">System Settings</div>
        <div class="theme-switch">
            <div class="theme-toggle" onclick="toggleTheme('light')">
                <label>White Theme</label>
                <div class="switch" id="themeSwitchLight"></div>
            </div>
            <div class="theme-toggle" onclick="toggleTheme('dark')">
                <label>Dark Theme</label>
                <div class="switch" id="themeSwitchDark"></div>
            </div>
        </div>
        <a href="logout.php" class="logout-button">Logout</a> <!-- Updated logout link -->
    </div>
    <div class="content">
        <div class="header">
            <h3>Welcome to the Administrator Dashboard</h3>
            <p>Select an option from the sidebar to get started.</p>
        </div>
        <div class="form-container" id="userFormContainer" style="display: none;">
            <div class="profile-section">
                <input type="file" id="profilePictureInput" style="display: none;" accept="image/*" onchange="loadProfilePicture(event)">
                <div class="profile-picture-holder" onclick="document.getElementById('profilePictureInput').click();">
                    <img id="adminProfilePicture" src="default-profile.png" alt="" class="form-profile-image">
                </div>
                <div class="button-container">
                    <button class="edit-zz" onclick="document.getElementById('profilePictureInput').click();">Upload Photo</button>
                    <button class="save-zz" onclick="saveProfile()">Save Profile</button>
                </div>
            </div>
            <form id="userForm" method="post" action="">
                <div class="form-row">
                    <div class="form-field">
                        <input type="text" id="description" name="description" placeholder="User description..." required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" required>
                        <?php if (isset($errors['firstName'])): ?>
                            <span class="error" id="errorFirstName"><?php echo $errors['firstName']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="middleName">Middle Name</label>
                        <input type="text" id="middleName" name="middleName" placeholder="Enter Middle Name">
                        <?php if (isset($errors['middleName'])): ?>
                            <span class="error" id="errorMiddleName"><?php echo $errors['middleName']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                        <?php if (isset($errors['lastName'])): ?>
                            <span class="error" id="errorLastName"><?php echo $errors['lastName']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="sex">Sex</label>
                        <select id="sex" name="sex" required>
                            <option value="" disabled selected>Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Department Head">Department Head</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Registrar">Registrar</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
                        <?php if (isset($errors['phone'])): ?>
                            <span class="error" id="errorPhone"><?php echo $errors['phone']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter Address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email" required>
                        <?php if (isset($errors['email'])): ?>
                            <span class="error" id="errorEmail"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter Password" required>
                        <?php if (isset($errors['password'])): ?>
                            <span class="error" id="errorPassword"><?php echo $errors['password']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="submit-button">SAVE USER</button>
            </form>
        </div>
    </div>

    <script>
        function loadDashboardProfilePicture(event) {
            const img = document.getElementById('dashboardProfilePicture');
            img.src = URL.createObjectURL(event.target.files[0]);
        }

        function loadProfilePicture(event) {
            const img = document.getElementById('adminProfilePicture');
            img.src = URL.createObjectURL(event.target.files[0]);
        }

        function toggleTheme(theme) {
            const body = document.body;
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const formContainer = document.querySelector('.form-container');

            if (theme === 'dark') {
                body.classList.add('dark-mode');
                sidebar.classList.add('dark-mode');
                content.classList.add('dark-mode');
                formContainer.classList.add('dark-mode');
                document.getElementById('themeSwitchDark').classList.add('active');
                document.getElementById('themeSwitchLight').classList.remove('active');
            } else {
                body.classList.remove('dark-mode');
                sidebar.classList.remove('dark-mode');
                content.classList.remove('dark-mode');
                formContainer.classList.remove('dark-mode');
                document.getElementById('themeSwitchLight').classList.add('active');
                document.getElementById('themeSwitchDark').classList.remove('active');
            }
        }

        function showForm(role) {
            document.getElementById('role').value = role;
            document.getElementById('userFormContainer').style.display = 'block';
        }

        function saveDashboardProfile() {
            alert('Dashboard profile saved successfully!');
        }

        function saveProfile() {
            alert('Profile saved successfully!');
        }

        function hideErrors() {
            setTimeout(() => {
                const errorElements = document.querySelectorAll('.error');
                errorElements.forEach(el => el.style.display = 'none');
            }, 4000);
        }

        if (document.querySelector('.error')) {
            hideErrors();
        }

        window.addEventListener('resize', function() {
            const width = window.innerWidth;
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            
            if (width <= 768) {
                sidebar.style.width = '200px';
                content.style.marginLeft = '200px';
            } else if (width <= 480) {
                sidebar.style.width = '100%';
                sidebar.style.position = 'relative';
                content.style.marginLeft = '0';
            } else {
                sidebar.style.width = '250px';
                content.style.marginLeft = '250px';
            }
        });

        if (window.innerWidth <= 768) {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            
            sidebar.style.width = '200px';
            content.style.marginLeft = '200px';
        }

        if (window.innerWidth <= 480) {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            
            sidebar.style.width = '100%';
            sidebar.style.position = 'relative';
            content.style.marginLeft = '0';
        }
    </script>
</body>
</html>