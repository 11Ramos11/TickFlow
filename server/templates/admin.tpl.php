<?php function drawAdmin($departments, $statuses, $priorities){ ?>

    <main class="middle-column">
        <section class="title">
            <h2>TickFlow Manager</h2>
        </section>
        <section id="administration">
            <article class="category" id="departments">
                <section class="title">
                    <h3>Departments</h3>
                    <button>Add</button>
                </section>
                <section class="content">
                    <?php foreach($departments as $department) { ?>
                        <article>
                            <p><?=$department->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </article>
                    <?php } ?>
                </section>
            </article>

            <article class="category" id="statuses">
                <section class="title">
                    <h3>Statuses</h3>
                    <button>Add</button>
                </section>
                <section class="content">
                    <?php foreach($statuses as $status) { ?>
                        <article>
                            <p><?=$status->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </article>
                    <?php } ?>
                </section>
            </article>

            <article class="category" id="prioririties">
                <section class="title">
                    <h3>Priorities</h3>
                    <button>Add</button>
                </section>
                <section class="content">
                    <?php foreach($priorities as $priority) { ?>
                        <article>
                            <p><?=$priority->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </article>
                    <?php } ?>
                </section>
            </article>

        </section>
    </main>

<?php } ?>