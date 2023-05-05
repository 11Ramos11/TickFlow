<?php
    include_once("util.php");
    session_start();

    if (!isset($_SESSION["user"])){
		header("Location: authentication.php");
		exit();
	}
    
    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://kit.fontawesome.com/a45efa4a81.js" crossorigin="anonymous"></script>
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
					<li><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>
					<li><a href="tickets.php"><i class="fa-solid fa-ticket"></i>Dashboard</a></li>
					<li  class="active"><a href="chat.php"><i class="fa-regular fa-comments"></i>Chat</a></li>
				</ul>
				
			</nav>
            <a href="profile.php" class = "profile-button"><img src="images/profile.png" alt="Profile" class="profile-img"></img>Profile<i class="fa-solid fa-arrow-right-from-bracket"></i>
			</a>
		</div>
        <main>
            <section id="chat">
                <div class = "messages">
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>
                    <article class="msg msg-right">
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                    </article>
                    <article class="msg msg-left">
                        <figure class="avatar">
                            <img src="images/profile.png" alt="Avatar">
                        </figure>
                        <div class="bubble">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula in mauris vel tempus.
                        </div>
                    </article>

                </div>
                <form action="/submit-message" method="post" class="reply">
                    <input type="text">
                    <button>Reply</button>
                </form>  
            </section>   
             
        </main>
        <aside class="right-sidebar">
			<h2>Right Sidebar</h2>
			<p>This is the content of the right sidebar.</p>
		</aside>
    </div>
</body>
</html>
