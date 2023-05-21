<?php function drawItems($items, $editAction, $removeAction, $itemType, $session){ 
    foreach($items as $item) { ?>
        <li class="admin-item">
            <p><?=$item->name?></p>
            <div class="buttons">
              <button class="edit-button"><i class="fa-regular fa-pen-to-square"></i></button>
              <button class="remove-button"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <dialog class="remove-dialog">
                <form action=<?=$removeAction?> method="post">
                    <input type="hidden" class="input" name="id" value=<?=$item->id?>>
                    <p>Do you want to remove the <?=$itemType?> <?=$item->name?>?<p>
                    <div class="button-group">
                        <button type="button" class="cancel-button">No</button>
                        <button type="Submit">Yes</button>
                    </div>
                    <input type="hidden" name="csrf" value="<?=$session->token?>">
                </form>
            </dialog>
            <dialog class="edit-dialog">
                <form action=<?=$editAction?> method="post">
                    <input type="hidden" class="input" name="id" value=<?=$item->id?>>
                    <label for="name">Change <?=$item->name?> name to:</label>
                    <input type="text" class="input" name="name" id="name" required value="<?=$item->name?>">
                    <div class="button-group">
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="submit">Submit</button>
                    </div>
                    <input type="hidden" name="csrf" value="<?=$session->token?>">
                </form>
            </dialog>
        </li>
    <?php } 
} ?>

<?php function drawAdmin($departments, $statuses, $priorities, $session){ ?>
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
                    "../actions/editDepartment.action.php",
                    "../actions/removeDepartment.action.php",
                    "department",
                    $session
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createDepartment.action.php" method="post">
                        <label for="name">New Department Name</label>
                        <input type="text" class="input" name="name" id="name" required>
                        <div class="button-group">
                            <button type="button" class="cancel-button">Cancel</button>
                            <button type="submit">Add</button>
                        </div>
					    <input type="hidden" name="csrf" value="<?=$session->token?>">
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
                    "status",
                    $session
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createStatus.action.php" method="post">
                        <label for="name">New Status Name</label>
                        <input type="text" class="input" name="name" id="name" required>
                        <div class="button-group">
                            <button type="button" class="cancel-button">Cancel</button>
                            <button type="submit">Add</button>
                        </div>
					    <input type="hidden" name="csrf" value="<?=$session->token?>">
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
                    "priority",
                    $session
                );?>
                </ul>
                <dialog class="add-dialog">
                    <form action="../actions/createPriority.action.php" method="post">
                        <label for="name">New Priority Name</label>
                        <input type="text" class="input" name="name" id="name" required>
                        <div class="button-group">
                            <button type="button" class="cancel-button">Cancel</button>
                            <button type="submit">Add</button>
                        </div>
					    <input type="hidden" name="csrf" value="<?=$session->token?>">
                    </form>
                </dialog>
            </article>
        </section>
    </main>
<?php } ?>