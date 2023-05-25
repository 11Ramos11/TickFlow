<?php function drawStatus($sessionUser, $statuses, $ticket){ 
  if ($sessionUser->isAgent() && $sessionUser->id != $ticket->authorID) { ?>
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
    <article class="cut">Status</article>
    <label for="status" class="placeholder">Status</label>
  </section>
<?php } 
}?>

<?php function drawAssignee($sessionUser, $users, $ticket){ 
  if ($sessionUser->isAgent() && $sessionUser->id != $ticket->authorID || $sessionUser->isAdmin()) { ?>
    <section class="input-container ic2">
    <select id="assignee" class="input" name="assignee">
      <option value=-1 selected>To be assigned</option>
      <?php foreach ($users as  $user){ ?>
        <?php if ($user->id === $ticket->assigneeID) { ?>
          <option value=<?=$user->id?> selected><?=$user->name?> (current)</option>
        <?php } else if ($ticket->departmentID == $sessionUser->department || $sessionUser->isAdmin()) { ?>
          <option value=<?=$user->id?>><?=$user->name?></option>
        <?php } ?>
      <?php } ?>
    </select>
    <article class="cut">Assignee</article>
    <label for="assignee" class="placeholder">Assignee</label>
  </section>
<?php } 
}?>

<?php function drawDepartment($departments, $ticket, $sessionUser) { ?>
  <?php if ($sessionUser->isAgent()) { ?>
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
    <article class="cut">Department</article>
    <label for="department" class="placeholder">Department</label>
  </section>
  <?php } ?>
<?php } ?>

<?php function drawTicketEditor($departments, $priorities, $statuses, $users, $ticket, $sessionUser, $session) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Edit Ticket</h2>
      </section>
      <section>
        <article class="form" id="edit-ticket" data-role=<?=$sessionUser->role?>  data-department=<?=$sessionUser->department?> data-assigneeID=<?=$ticket->assigneeID?>>
          <form action="../actions/editTicket.action.php" method="post">
            <section class="input-container ic1">
              <input value="<?= $ticket->subject ?>" id="subject" class="input" type="text" placeholder=" " name="subject" />
              <article class="cut">Subject</article>
              <label for="subject" class="placeholder">Subject</label>
            </section>
            <section class="input-container ic2">
              <textarea id="description" class="input" placeholder=" " name="description"><?= $ticket->description ?></textarea>
              <article class="cut">Description</article>
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
              <article class="cut">Priority</article>
              <label for="priority" class="placeholder">Priority</label>
            </section>
            <?php drawStatus($sessionUser, $statuses, $ticket); ?>
            <?php drawDepartment($departments, $ticket, $sessionUser); ?>
            <?php drawAssignee($sessionUser, $users, $ticket); ?>
            <section class="input-container ic2">
              <ul class="tags-box tags input-tags" id="tag-creator">
                <input type="text" id="tag-input" name="tag" placeholder="Tags">
              </ul>
              <input type="hidden" id="tags" name="tags" value=<?=implode(',',$ticket->tags)?>>
              <ul id="auto-complete"></ul>
            </section>
            <input name="id" type="hidden" value="<?= $ticket->id ?>">      
					  <input type="hidden" name="csrf" value="<?=$session->token?>">
            <button type="text" class="submit" id="submit-button">Submit</button>
          </form>
        </article>
      </section>
    </main>

    <script> 
    // I want this script to fetch users from department that is selected when user alters the department

    


    </script>

<?php } ?>
