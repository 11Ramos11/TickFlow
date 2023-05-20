<?php function drawRecentChanges(array $changes){ ?>

<aside class="right-sidebar home-sidebar">
    <section id="recent-changes">
        <h2>Recent Changes</h2>
        <?php foreach($changes as $change){ 
            $ticket = $change->getTicket(); ?>
            <div class="change-card">
                <a href="../pages/ticket.php?ticket=<?=$ticket->id?>">
                <article class="change">
                    <h3> <?=$ticket->subject?> </h3>
                    <section class="change-info">
                        <p><?=$change->fieldChanged?>:</p>
                        <p><span class="old"><?=$change->oldValue?></span> <i class="fa-solid fa-chevron-down"></i> <span class="new"><?=$change->newValue?></span></p>
                        <p class="change-time"><?=$change->editDate?>, <?=$change->editTime?></p>
                    </section>
                </article>
                </a>
            </div>
            <div class="left-sidebar">
                <header class="header">
                    <img class="logo" src="../images/logo.svg" alt="Logo">
                    <h1>TickFlow</h1>
                </header>
                <nav>
                    <ul>
                        <li class="<?=$home?>"><a href="home.php"><i class="fa-solid fa-house nav-button"></i>Home</a></li>
                        <li class="<?=$tickets?>"> <a href="dashboard.php"><i class="fa-solid fa-ticket nav-button"></i>Dashboard</a></li>
                        <li class="<?=$personnel?>"><a href="personnel.php"><i class="fa-solid fa-users nav-button"></i>Personnel</a></li>
                        <li class="<?=$admin?>"><a href="admin.php"><i class="fa-solid fa-sliders"></i> Administration 	</a></li>
                    </ul>
                </nav>
                <a href="../actions/logout.action.php" class = "profile-button">Logout<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
    
        <?php } ?>        
    </section>
</aside>

<?php } ?>