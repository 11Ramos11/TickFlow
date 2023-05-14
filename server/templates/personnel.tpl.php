<?php function drawUser($user){ ?>
    <li class="user">
            <button> <i class="fa-solid fa-ellipsis-vertical"></i> </button>
            <img src="../images/profile.png" alt="Profile" class="profile-img"></img>
            <p class="username"><?=$user->name?></p>
            <p class="email"><?=$user->email?></p>
    </li>
<?php } ?>

<?php function drawPersonnel($admins, $agents, $clients){ ?>
    <main class="middle-column">
        <section class = "top">
            <h2>Personnel</h2>
        </section>
        <section class="users" id="admins">
            <h3> Administrators </h3>
            <ul>
            <?php foreach($admins as $admin){ 
                drawUser($admin);
             } ?>
            </ul>
        </section>
        <section class="users" id="agents">
            <h3> Agents </h3>
            <ul>
            <?php foreach($agents as $agent){
                drawUser($agent);
             } ?>
            </ul>
        </section>
        <section class="users" id="clients">
            <h3> Clients </h3>
            <ul>
            <?php foreach($clients as $client){ 
                drawUser($client);
             } ?>
            </ul>
        </section>
    </main>
    <aside class="right-sidebar">
        <h2>Right Sidebar</h2>
        <p>This is the content of the right sidebar.</p>
    </aside>
<?php } ?>
