<?php function drawChanges($ticket, $changes){ ?>

<aside class="middle-column">
    <section id="changes">
        <h2>"<?=$ticket->subject?>" Changes</h2>
        <?php foreach($changes as $change){ 
            $author = User::getUserById($change->author)?>
            <div class="change-card">
                <a href="../pages/ticket.php?ticket=<?=$ticket->id?>">
                <article class="change">
                    <h3> <?=$change->editDate?>, <?=$change->editTime?> </h3>
                    <section class="change-info">
                        <p><?= ucfirst($change->fieldChanged) ?>:</p>
                        <p><span class="old"><?=$change->oldValue?></span> <i class="fa-solid fa-chevron-down"></i> <span class="new"><?=$change->newValue?></span></p>
                        <p class="change-author"><?=$author->name?></p> 
                    </section>
                </article>
                </a>
            </div>
        <?php } ?>        
    </section>
</aside>

<?php } ?>

<?php function drawRecentChanges($changes){ ?>

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
                            <p><?= ucfirst($change->fieldChanged) ?>:</p>
                            <p><span class="old"><?=$change->oldValue?></span> <i class="fa-solid fa-chevron-down"></i> <span class="new"><?=$change->newValue?></span></p>
                            <p class="change-time"><?=$change->editDate?>, <?=$change->editTime?></p>
                        </section>
                    </article>
                    </a>
                </div>
            <?php } ?>        
        </section>
    </aside>
    
<?php } ?>