<?php function drawStatus($sessionUser, $statuses, $ticket){ 
  if ($sessionUser->isAdmin() || $sessionUser->isAssignedTo($ticket)) { ?>
    <section class="input-container ic2">
    <select id="status" class="input" name="status">
      <?php foreach ($statuses as  $status){ ?>
        <?php if ($status->id === $ticket->status) { ?>
          <option value=<?=$status->id?> selected><?=$status->name?></option>
        <?php } else { ?>
          <option value=<?=$status->id?>><?=$status->name?></option>
        <?php } ?>
      <?php } ?>
    </select>
    <article class="cut"></article>
    <label for="status" class="placeholder">Status</label>
  </section>
<?php } 
}?>

<?php function drawAssignee($sessionUser, $users, Ticket $ticket){ 
  if ($sessionUser->isAdmin()) { ?>
    <section class="input-container ic2">
    <select id="status" class="input" name="assignee">
      <?php foreach ($users as  $user){ ?>
        <?php if ($user->id === $ticket->assigneeID) { ?>
          <option value=<?=$user->id?> selected><?=$user->name?></option>
        <?php } else { ?>
          <option value=<?=$user->id?>><?=$user->name?></option>
        <?php } ?>
      <?php } ?>
    </select>
    <article class="cut"></article>
    <label for="status" class="placeholder">Assignee</label>
  </section>
<?php } 
}?>

<?php function drawTicketEditor(array $departments, array $priorities, array $statuses, array $users, Ticket $ticket, User $sessionUser) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Edit Ticket</h2>
      </section>
      <section>
        <article class="form" id="edit-ticket">
          <form action="../actions/editTicket.action.php" method="post">
            <section class="input-container ic1">
              <input value="<?= $ticket->subject ?>" id="subject" class="input" type="text" placeholder=" " name="subject" />
              <article class="cut"></article>
              <label for="subject" class="placeholder">Subject</label>
            </section>
            <section class="input-container ic2">
              <textarea id="description" class="input" placeholder=" " name="description"><?= $ticket->description ?></textarea>
              <article class="cut"></article>
              <label for="description" class="placeholder">Description</label>
            </section>
            <section class="input-container ic2">
              <select id="priority" class="input" name="priority">
                <?php foreach ($priorities as  $priority){ ?>
                  <?php if ($priority->id === $ticket->priority) { ?>
                    <option value=<?=$priority->id?> selected><?=$priority->name?></option>
                  <?php } else { ?>
                    <option value=<?=$priority->id?>><?=$priority->name?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <article class="cut"></article>
              <label for="priority" class="placeholder">Priority</label>
            </section>
            <?php drawStatus($sessionUser, $statuses, $ticket); ?>
            <?php drawAssignee($sessionUser, $users, $ticket); ?>
            <section class="input-container ic2">
              <select id="department" class="input" name="department">
                <option value="-1">None</option>
                <?php foreach ($departments as $department) { ?>
                  <?php if ($department->id === $ticket->departmentID) { ?>
                    <option value="<?= $department->id; ?>" selected><?= $department->name; ?></option>
                  <?php } else { ?>
                    <option value="<?= $department->id; ?>"><?= $department->name; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <article class="cut"></article>
              <label for="department" class="placeholder">Department</label>
            </section>
            <section class="input-container ic2">
              <ul class="tags-box tags input-tags" id="tag-creator">
                <input type="text" id="tag-input" name="tag" placeholder="Tags">
              </ul>
              <input type="hidden" id="tags" name="tags" value=<?=implode(',',$ticket->tags)?>>
            </section>
            <input name="id" type="hidden" value="<?= $ticket->id ?>">      
            <button type="text" class="submit" id="submit-button">Submit</button>
          </form>
        </article>
      </section>
    </main>

<?php } ?>
