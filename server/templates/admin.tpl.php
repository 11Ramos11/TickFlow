<?php function drawItems($items, $editAction, $removeAction, $itemType){ 
    
    foreach($items as $item) { ?>
        <li value=<?=$item->id?> class="admin-item">
            <p><?=$item->name?></p>
            <div class="item-div">
              <button class="edit-button"><i class="fa-regular fa-pen-to-square"></i></button>
              <button class="remove-button"><i class="fa-solid fa-xmark"></button>
            </div>
            <dialog class="remove-dialog">
                <form action=<?=$removeAction?>>
                    <h2>Do you want to remove the <?=$itemType?> <?=$item->name?>?<h2>
                    <button type="button" class="cancel-button">no</button>
                    <button type="submit">yes</button>
                </form>
            </dialog>
            <dialog class="edit-dialog">
                <form action=<?=$editAction?>>
                    <label for="name">Change <?=$item->name?> name to:</label>
                    <input type="text" name="name" id="name" required>
                    <button type="button" class="cancel-button">cancel</button>
                    <button type="submit">submit</button>
                </form>
            </dialog>
        </li>
    <?php } 
} ?>

<?php function drawAdmin($departments, $statuses, $priorities){ ?>

    <main class="middle-column">
        <section class="title">
            <h2>TickFlow Manager</h2>
        </section>
        <section id="administration">
            <article class="category" id="departments">
                <section class="title">
                    <h3>Departments</h3>
                    <button class="add-button button">Add</button>
                </section>
                <ul class="content">
                <?=drawItems(
                    $departments,
                    "../actions/editDeparment.action.php",
                    "../actions/removeDeparment.action.php",
                    "department"
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createPriority.action.php" method="post">
                        <label for="name">New Department Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>

            <article class="category" id="statuses">
                <section class="title">
                    <h3>Statuses</h3>
                    <button class="add-button button">Add</button>
                </section>
                <ul class="content">
                <?=drawItems(
                    $statuses, 
                    "../actions/editStatus.action.php",  
                    "../actions/removeStatus.action.php",
                    "status"
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createStatus.action.php" method="post">
                        <label for="name">New Status Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>

            <article class="category" id="prioririties">
                <section class="title">
                    <h3>Priorities</h3>
                    <button class="add-button button">Add</button>
                </section>
                <ul class="content">
                <?=drawItems(
                    $priorities, 
                    "../actions/editPriority.action.php",  
                    "../actions/removePriority.action.php",
                    "priority"
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createPriority.action.php" method="post">
                        <label for="name">New Priority Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>
        </section>
    </main>

<?php } ?>