<?php
    include_once("util.php");
    include_once("queries/users_queries.php");
    session_start();

    if (!isset($_SESSION["user"])){
		header("Location: authentication.php");
		exit();
	}

    $sessionUser = $_SESSION["user"];

    if (!isset($_GET["user"])){
        $user = $sessionUser;
    } else {
        $userID = $_GET["user"];
        $user = getUser($userID);
    } 
?>

<!DOCTYPE html>
<html>

<head>
    <title>TickSy - Profile Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://kit.fontawesome.com/a45efa4a81.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>

<body>
    <div class="grid-container">
        <div class="left-sidebar">
            <header class="header">
                <img class="logo" src="images/logo.svg" alt="Logo">
                <h1>TickSy</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="landing.php"><i class="fa-solid fa-house"></i>Home</a></li>
                    <li><a href="tickets.php"><i class="fa-solid fa-ticket"></i>Dashboard</a></li>
                    <li><a href="chat.php"><i class="fa-regular fa-comments"></i>Chat</a></li>
                </ul>
            </nav>
            <a href="profile.php" class="profile-button"><img src="images/profile.png" alt="Profile" class="profile-img">Profile<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
        <main class="middle-column" id="profile-section">
            <section class="profile-section">
                <h2>Profile</h2>
                <div class="profile-info">
                    <img src="images/profile.png" alt="Profile Picture" class="profile-picture">
                    <div class="user-details">
                        <h3 class="user-name"><?= $user->name ?></h3>
                        <p class="user-email"><?= $user->email ?></p>
                    </div>
                </div>
                <?php if ($sessionUser->id == $user->id) { ?>
                <button class="edit-profile-button">Edit Profile</button>
                <a href="queries/logout.php"><button class="logout-button">Logout</button></a>
                <?php } ?>
            </section>
        </main>
        <aside class="right-sidebar">
			<h3>About Me</h3>
			<p>
			  I'm a highly motivated web developer with experience in front-end and back-end development. I enjoy creating responsive, user-friendly websites and applications.
			</p>
			<h3>Contact Information</h3>
			<ul class="contact-info">
			  <li><strong>Email:</strong> email@example.com</li>
			  <li><strong>Phone:</strong> +1 (123) 456-7890</li>
			  <li><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/your-name" target="_blank">your-name</a></li>
			  <li><strong>GitHub:</strong> <a href="https://github.com/yourusername" target="_blank">yourusername</a></li>
			</ul>
			<h3>Skills</h3>
			<ul class="skills">
			  <li>HTML</li>
			  <li>CSS</li>
			  <li>JavaScript</li>
			  <li>React</li>
			  <li>Git</li>
			</ul>
        </aside>
    </div>
</body>

</html>