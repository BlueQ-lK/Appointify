<head>
    <link rel="stylesheet" href="css/navbar.style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- FontAwesome -->
</head>

<body>

    <div class="nav-bar">
        <div class="nav-left-menu">
            <input type="checkbox" id="check" />
            <label for="check" class="menu-label">
                <i class="fa-solid fa-bars" id="menu-btn"></i>
                <i class="fa-solid fa-x" id="menu-cancel"></i>
            </label>
            <div class="nav-logo-x">
                <p>Appointify</p>
            </div>
            <ul class="nav-menu-pages">
                <li><a href="index.php">home</a></li>
                <li><a href="search.php">doctors</a></li>
                <li><a href="about.php">about</a></li>
                <li><a href="contact.php">contact</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="profile.php">profile</a></li>
                    <li><a href="logout.php">logout (<?php echo $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="contact.php">contact</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="nav-right-menu">
                <button class="sign-in-btn sign-btn-hover" onclick="location.href='profile.php'" style="padding: 0.6rem 0.6rem;"> Profile</button>
                <button class="sign-in-btn get-btn" onclick="location.href='logout.php'" style="padding: 0.6rem 0.6rem;">Logout (<?php echo $_SESSION['username']; ?>)</button>
            </div>
        <?php else: ?>
            <div class="nav-right-menu">
                <button class="sign-in-btn sign-btn-hover" onclick="location.href='login.php'">Login</button>
                <button class="sign-in-btn get-btn" onclick="location.href='register.php'">Register</button>
            </div>
        <?php endif; ?>
    </div>
</body>