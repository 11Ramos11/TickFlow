<?php function drawHome($departments, $changes){ ?>

    <main class="middle-column">
        <section id="FAQs">
            <h1> FAQs </h1>
            <?php foreach($departments as $department) {
                $faqs = $department->getFAQs(); ?>
                <h2> <?=$department->name ?> </h2>
                <?php foreach($faqs as $faq) { ?>
                <article class="FAQ">
                    <h3 class="question"> <?=$faq->question?> </h2>
                    <p class="answer"> <?=$faq->answer?> </p>
                </article>
            <?php }
            }
            ?>
        </section>
    </main>
    <aside class="right-sidebar">
        <section id="recent-changes">
            <h2>Recent Changes</h2>
            <?php foreach($changes as $change){ 
                $ticket = $change->getTicket(); ?>
                <a href="../pages/ticket.php?ticket=<?=$ticket->id?>">
                <article class="change">
                    <h3> <?=$ticket->subject?> </h3>
                    <section class="change-info">
                        <p><?=$change->fieldChanged?>:</p>
                        <p><?=$change->oldValue?> => <?=$change->newValue?></p>
                        <p><?=$change->editDate?> <?=$change->editTime?></p>
                    </section>
                </article>
                <a>
            <?php } ?>
        </section>
    </aside>

<?php } ?>