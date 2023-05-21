<?php function drawChanges($ticket, $changes){ ?>

<aside class="middle-column">
    <section class="title">
        <h2>"<?=$ticket->subject?>" Changes</h2>
    </section>
    <section id="ticket-changes"> 
        <?php if (count($changes) == 0) { ?>
                <p class="no-changes">No changes to show.</p>
        <?php } else {?>
            <?php foreach($changes as $change){ 
                $author = User::getUserById($change->author)?>
                <div class="change-card">
                    <article class="change">
                        <h4>Change of <b><?=ucfirst($change->fieldChanged)?></b></h3>
                        <section class="change-info">
                            <p class="status-change">
                                <span class="old"><?=$change->oldValue?></span> 
                                <i class="fa-solid fa-chevron-right"></i> 
                                <span class="new"><?=$change->newValue?></span>
                            </p>
                            <section class="change-details">
                                <p class="change-time"> <?=$change->editDate?>, <?=$change->editTime?>
                                <p class="change-author">By <a href="../pages/dashboard.php?id=<?=$author->id?>"><?=$author->name?></a></p> 
                            </section>
                        </section>
                    </article>
                </div>
            <?php } ?>      
        <?php } ?>  
    </section>
</aside>

<?php } ?>

<?php function drawRecentChanges($changes){ ?>

    <aside class="right-sidebar home-sidebar">
        <section id="recent-changes">
            <h2>Recent Changes</h2>

            <?php if (count($changes) == 0) { ?>
                <p class="no-changes">No changes to show.</p>
            <?php } else {?>
                <?php foreach($changes as $change){ 
                    $ticket = $change->getTicket(); ?>
                    <div class="change-card">
                        <a href="../pages/ticket.php?ticket=<?=$ticket->id?>">
                        <article class="change">
                            <h3> <?=$ticket->subject?> </h3>
                            <section class="change-info">
                                <h4><?= ucfirst($change->fieldChanged) ?>:</h4>
                                <p><span class="old"><?=$change->oldValue?></span> <i class="fa-solid fa-chevron-down"></i> <span class="new"><?=$change->newValue?></span></p>
                                <p class="change-time"><?=$change->editDate?>, <?=$change->editTime?></p>
                            </section>
                        </article>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </section>
    </aside>
    
<?php } ?>