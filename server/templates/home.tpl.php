<?php function drawFAQs($departments, $sessionUser){ ?>

    <main class="middle-column">
        <section class = "title">
            <h2> FAQs </h2>
            <a href="ticketCreator.php"><button class = "button">New FAQ</button> </a>
        </section>
        <section id="FAQs">
            <?php foreach($departments as $department) {
                $faqs = $department->getFAQs(); ?>
                <?php if (count($faqs) == 0) continue; ?>
                <section class="department-faqs">
                    <h2> <?=$department->name ?> </h2>
                    <?php foreach($faqs as $faq) { ?>
                    <div class="edit-container faq-container container">
                        <?php if ($sessionUser->isAgent()) { ?>
                        <button type=button class="dropdown-button"> 
                            <i class="fa-solid fa-ellipsis-vertical"></i> 
                        </button>
                        <div class="faq-dropdown edit-dropdown">
                            <a class="dropdown-option" href="../pages/editFAQ.php?faq=<?=$faq->id?>">Edit</a>
                            <button class="dropdown-option remove-faq">Delete</a>
                        </div>
                        <?php } ?>
                        <article class="edit-card FAQ-card card">
                            <h3 class="question"> <?=$faq->question?> </h2>
                            <p class="answer"> <?=$faq->answer?> </p>
                        </article>
                        <dialog class="remove-dialog">
                            <form action="../actions/action_removeFAQ.php" method="post">
                                <input type="hidden" name="faq" value="<?=$faq->id?>">
                                <p>Are you sure you want to delete this FAQ?</p>
                                <div class="button-group">
                                    <button type="button" class="cancel-button">No</button>
                                    <button type="submit">Yes</button>
                                </div>
                            </form>
                        </dialog>
                    </div>
                    <?php } ?>
                </section>
            <?php } ?>
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