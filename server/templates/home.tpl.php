<?php function drawFAQs($departments){ ?>

    <main class="middle-column">
        <section class = "title">
            <h2> FAQs </h2>
        </section>
        
        <section id="FAQs">
            
            <?php foreach($departments as $department) {
                $faqs = $department->getFAQs(); ?>
                <h2> <?=$department->name ?> </h2>
                <?php foreach($faqs as $faq) { ?>
                <article class="FAQ card">
                    <h3 class="question"> <?=$faq->question?> </h2>
                    <p class="answer"> <?=$faq->answer?> </p>
                </article>
            <?php }
            }
            ?>
        </section>
    </main>

<?php } ?>

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
                        <p><span class="old"><?=$change->oldValue?></span> <i class="fa-solid fa-chevron-right"></i> <span class="new"><?=$change->newValue?></span></p>
                        <p class="change-time"><?=$change->editDate?>, <?=$change->editTime?></p>
                    </section>
                </article>
                </a>
            </div>
        <?php } ?>        
    </section>
</aside>

<?php } ?>