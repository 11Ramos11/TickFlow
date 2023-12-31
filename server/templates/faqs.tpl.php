<?php function drawFAQs($departments, $sessionUser, $session){ ?>

<main class="middle-column">
    <section class = "title">
        <h2> FAQs </h2>
        <?php if ($sessionUser->isAgent()) { ?>
        <a href="faqCreator.php"><button class = "button">New FAQ</button> </a>
        <?php } ?>
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
                        <a class="dropdown-option" href="../pages/faqEditor.php?id=<?=$faq->id?>">Edit</a>
                        <button class="dropdown-option remove-faq">Delete</a>
                    </div>
                    <?php } ?>
                    <article class="edit-card FAQ-card card">
                        <h3 class="question"> <?=$faq->question?> </h2>
                        <p class="answer"> <?=$faq->answer?> </p>
                    </article>
                    <dialog class="remove-dialog">
                        <form action="../actions/removeFAQ.action.php" method="post">
                            <input type="hidden" name="faq" value="<?=$faq->id?>">
                            <input type="hidden" name="csrf" value="<?=$session->token?>">
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