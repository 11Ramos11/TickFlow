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
                        <p><?=$change->fieldChanged?>:</p>
                        <p><?=$change->oldValue?> => <?=$change->newValue?></p>
                        <p><?=$change->editDate?>, <?=$change->newValue?></p>
                    </section>
                </article>
                </a>
            </div>
        <?php } ?>        
    </section>
</aside>

<?php } ?>