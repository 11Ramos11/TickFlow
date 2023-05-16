<?php function drawHome($departments){ ?>

    <main class="middle-column">
        <section id="FAQs">
            <h1> FAQs </h1>
            <?php foreach($departments as $department) {
                $faqs = $department->getFAQs(); ?>
                <h2> <?=$department->name ?> </h2>
                <?php foreach($faqs as $faq) { ?>
                <article class="FAQ">
                    <h3 class="question"> <?php echo $faq->question ?> </h2>
                    <p class="answer"> <?php echo $faq->answer ?> </p>
                </article>
            <?php }
            }
            ?>
        </section>
    </main>
    <aside class="right-sidebar">
        <h2>Right Sidebar</h2>
        <p>This is the content of the right sidebar.</p>
    </aside>

<?php } ?>