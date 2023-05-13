<?php function drawProfile($sessionUser, $user) { ?>
     
    <main class="middle-column" id="profile-section">
            <section class="profile-section">
                <h2>Profile</h2>
                <div class="profile-info">
                    <img src="../images/profile.png" alt="Profile Picture" class="profile-picture">
                    <div class="user-details">
                        <h3 class="user-name"><?= $user->name ?></h3>
                        <p class="user-email"><?= $user->email ?></p>
                    </div>
                </div>
                <?php if ($sessionUser->id == $user->id) { ?>
                <button class="edit-profile-button">Edit Profile</button>
                <a href="../actions/logout.action.php"><button class="logout-button">Logout</button></a>
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
			  <li><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/miguel-pedrosa-393821267/" target="_blank">your-name</a></li>
			  <li><strong>GitHub:</strong> <a href="https://github.com/migueljcpedrosa" target="_blank">yourusername</a></li>
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

<?php } ?>