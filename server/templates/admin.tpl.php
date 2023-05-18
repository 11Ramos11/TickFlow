<?php function drawAdmin($departments){ ?>

    <main class="middle-column">
        <section class = "title">
            <h2>TickFlow Manager</h2>
        </section>
        
        <section class="administration">
            <article class="category" id="departments">
                <section class="title">
                    <h3>Departments</h3>
                    <button>Add</button>
                </section>
                <section class="content">
                    <?php foreach($departments as $department) { ?>
                        <article>
                            <p><?=$department->name?></p>
                            <button>edit-name</button>
                            <button>remove</button>
                        </article>
                    <?php } ?>
                </section>
            </artcile>

            <article class="category" id="statuses">
                <section class="title">
                    <h3>Statuses</h3>
                    <button>Add</button>
                </section>
                <section class="content">
                    
                </section>
            </article>

            <article class="category" id="prioririties">
                <section class="title">
                    <h3>Priorities</h3>
                    <button>Add</button>
                </section>
                <section class="content">

                </section>
            </article>

        </section>
    </main>

<?php } ?>