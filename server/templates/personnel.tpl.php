<?php function drawUser($user){ ?>

    <li class="edit-container user-container">
            
        <?php $session = new Session(); if ($session->isAdmin()) { ?> 
        <button class="dropdown-button"> <i class="fa-solid fa-ellipsis-vertical"></i> </button>
        <div class="user-dropdown edit-dropdown personnel-dropdown">
            <a class="dropdown-option" href="../pages/dashboard.php?id=<?=$user->id?>">Manage</a>
            <a class="dropdown-option" href="../actions/removeUser.action.php?id=<?=$user->id?>&csrf=<?=$session->token?>">Delete</a>
        </div>
        <?php } ?>
        <div class="edit-card user-card">
            <img src=<?=$user->getPhoto()?> alt="Profile" class="profile-img"></img>
            <p class="username"><?=$user->name?></p>
            <p class="email"><?=$user->email?></p>
        </div>
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

<?php function drawDeparmentBar($departments, $statuses){ ?>

    <aside class="right-sidebar department-sidebar">
        <h2>Departments</h2>
        
        <?php foreach($departments as $department){ ?>
            <article>
                <h3><?=$department->name?><h3>
                <section class="department-ticket-info">
                    <?php foreach($statuses as $status){ ?>
                    <p><?=$status->name?> Tickets: <span><?=$department->getTicketsByStatus($status->id)?></span></p>
                    <?php } ?>
                </section>
            </article>
        <?php } ?>
    </aside>

<?php } ?>
