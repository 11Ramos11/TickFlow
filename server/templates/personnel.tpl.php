<?php function drawPersonnel($admins, $agents, $clients){ ?>

    <main class="middle-column">
        <section class = "top">
            <h2>Personnel</h2>
        </section>
        <section class="users" id="admins">
            <p> Administrators </p>
            <ul>
            <?php foreach($admins as $admin){ ?>
            <li class="user">
                <img src="../images/profile.png" alt="Profile" class="profile-img"></img>
                <p class="username"><?=$admin->name?></p>
                <p class="email"><?=$admin->email?></p>
            </li>
            <?php } ?>
            </ul>
        </section>
        <section class="users" id="agents">
            <p> Agents </p>
            <ul>
            <?php foreach($agents as $agent){ ?>
            <li class="user">
                <img src="../images/profile.png" alt="Profile" class="profile-img"></img>
                <p class="username"><?=$agent->name?></p>
                <p class="email"><?=$agent->email?></p>
            </li>
            <?php } ?>
            </ul>
        </section>
        <section class="users" id="clients">
            <p> Clients </p>
            <ul>
            <?php foreach($clients as $client){ ?>
            <li class="user">
                    <img src="../images/profile.png" alt="Profile" class="profile-img"></img>
                    <p class="username"><?=$client->name?></p>
                    <p class="email"><?=$client->email?></p>
            </li>
            <?php } ?>
            </ul>
        </section>
    </main>
    <aside class="right-sidebar">
        <h2>Right Sidebar</h2>
        <p>This is the content of the right sidebar.</p>
    </aside>

<?php } ?>