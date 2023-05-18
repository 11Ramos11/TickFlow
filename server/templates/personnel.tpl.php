<?php function drawUser($user){ ?>
    <li class="user-card">
            <?php $session = new Session(); if ($session->isAdmin()) { ?> 
            <button class="dropdown-button"> <i class="fa-solid fa-ellipsis-vertical"></i> </button>
            <div class="user-dropdown">
                <a href="../pages/dashboard.php?id=<?=$user->id?>">Manage</a>
                <a href="../pages/deleteUser.php?id=<?=$user->id?>">Delete</a>
            </div>
            <?php } ?>
            <img src="../images/profile.png" alt="Profile" class="profile-img"></img>
            <p class="username"><?=$user->name?></p>
            <p class="email"><?=$user->email?></p>
            
    </li>
<?php } ?>

<?php function drawPersonnel($admins, $agents, $clients){ ?>
    <main class="middle-column">
        <!---<section class = "title">
            <h2>Personnel</h2>
        </section>--->
        <section class="users" id="admins">
            <h3> Administrators </h3>
            <?php if (count($admins) == 0) { ?>
                <p> There are no administrators. </p>
            <?php } ?>
            <ul>
            <?php foreach($admins as $admin){ 
                drawUser($admin);
            } ?>
            </ul>
        </section>
        <section class="users" id="agents">
            <h3> Agents </h3>
            <?php if (count($agents) == 0) { ?>
                <p> There are no agents. </p>
            <?php } ?>
            <ul>
            <?php foreach($agents as $agent){
                drawUser($agent);
             } ?>
            </ul>
        </section>
        <section class="users" id="clients">
            <h3> Clients </h3>
            <?php if (count($clients) == 0) { ?>
                <p> There are no clients. </p>
            <?php } ?>
            <ul>
            <?php foreach($clients as $client){ 
                drawUser($client);
             } ?>
            </ul>
        </section>
    </main>
    
<?php } ?>

<?php function drawDeparmentBar($departments){ ?>

    <aside class="right-sidebar">
        <h2>Departments</h2>
        
        <?php foreach($departments as $department){ ?>
            <article>
                <h3><?=$department->name?><h3>
                <section class="department-ticket-info">
                    <p>Open Tickets: <?=$department->getOpenTickets()?></p>
                    <p>Pending Tickets: <?=$department->getPendingTickets()?></p>
                </section>
            </article>
        <?php } ?>
    </aside>

<?php } ?>
