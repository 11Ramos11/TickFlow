<?php function drawItems($items, $editAction, $removeAction, $itemType){ 
    
    foreach($items as $item) { ?>
        <li value=<?=$item->id?> class="admin-item">
            <p><?=$item->name?></p>
            <button class="edit-button">edit name</button>
            <button class="remove-button">remove</button>
            <dialog class="remove-dialog">
                <form action=<?=$removeAction?>>
                    <h2>Do you want to remove the <?=$itemType?> <?=$item->name?>?<h2>
                    <button type="submit" >yes</button>
                    <button type="button">no</button>
                </form>
            </dialog>
            <dialog class="edit-dialog">
                <form action=<?=$editAction?>>
                    <h2>Change name to:<h2>
                    <input type="text" name="name" id="name" required>
                    <button type="button">cancel</button>
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
                    <button class="add-button">Add</button>
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
                    <form>
                        <h2><h2>
                        <label for="name">New Department Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button">Cancel</button>
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
                <?=drawItems(
                    $statuses, 
                    "../actions/editStatus.action.php",  
                    "../actions/removeStatus.action.php",
                    "status"
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form>
                        <h2><h2>
                        <label for="name">New Status Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button">Cancel</button>
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
                <?=drawItems(
                    $priorities, 
                    "../actions/editPriority.action.php",  
                    "../actions/removePriority.action.php",
                    "priority"
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form>
                        <h2><h2>
                        <label for="name">New Priority Name</label>
                        <input type="text" name="name" id="name" required>
                        <button type="button">Cancel</button>
                        <button type="submit">Add</button>
                    </form>
                </dialog>
            </article>
        </section>
    </main>

<?php } ?>