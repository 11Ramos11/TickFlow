<?php function drawAdmin($departments, $statuses, $priorities){ ?>

    <main class="middle-column">
        <section class="title">
            <h2>TickFlow Manager</h2>
        </section>
        <section id="administration">
            <article class="category" id="departments">
                <section class="title">
                    <h3>Departments</h3>
                    <button class="add-button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($departments as $department) { ?>
                        <li value=<?=$department->id?>>
                            <p><?=$department->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </li>
                    <?php } ?>
                </ul>
                <dialog class="add-dialog">
                    <form>
                        <h2><h2>
                        <label for="name">New Department Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>

            <article class="category" id="statuses">
                <section class="title">
                    <h3>Statuses</h3>
                    <button class="add-button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($statuses as $status) { ?>
                        <li value=<?=$status->id?>>
                            <p><?=$status->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </li>
                    <?php } ?>
                </ul>
                <dialog class="add-dialog">
                    <form>
                        <h2><h2>
                        <label for="name">New Status Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>

            <article class="category" id="prioririties">
                <section class="title">
                    <h3>Priorities</h3>
                    <button class="add-button">Add</button>
                </section>
                <ul class="content">
                    <?php foreach($priorities as $priority) { ?>
                        <li value=<?=$priority->id?>>
                            <p><?=$priority->name?></p>
                            <button>edit name</button>
                            <button>remove</button>
                        </li>
                    <?php } ?>
                </ul>
                <dialog class="add-dialog">
                    <form>
                        <h2><h2>
                        <label for="name">New Priority Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>
        </section>
        
    </main>

<?php } ?>