<?php function drawAdmin($departments, $statuses, $priorities){ ?>

    <main class="middle-column">
        <section class="title">
            <h2>TickFlow Manager</h2>
        </section>
        <section id="administration">
            <article class="category" id="departments">
                <section class="title">
                    <h3>Departments</h3>
                    <button class="button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($departments as $department) { ?>
                        <li value=<?=$department->id?>>
                            <p><?=$department->name?></p>
                            <div>
                                <button><i class="fa-regular fa-pen-to-square"></i></button>
                                <button><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </article>

            <article class="category" id="statuses">
                <section class="title">
                    <h3>Statuses</h3>
                    <button class="button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($statuses as $status) { ?>
                        <li value=<?=$status->id?>>
                            <p><?=$status->name?></p>
                            <div>
                                <button><i class="fa-regular fa-pen-to-square"></i></button>
                                <button><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </article>

            <article class="category" id="prioririties">
                <section class="title">
                    <h3>Priorities</h3>
                    <button class="button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($priorities as $priority) { ?>
                        <li value=<?=$priority->id?>>
                            <p><?=$priority->name?></p>
                            <div>
                                <button><i class="fa-regular fa-pen-to-square"></i></button>
                                <button><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </article>

        </section>
    </main>

<?php } ?>