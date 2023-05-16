<?php 
function drawTicketCreator($departments) { ?>

    <article class="form">
      <section class="title">Create a New Ticket</section>
      <form action="../actions/createTicket.action.php" method="post">
        <section class="input-container ic1">
          <input id="subject" class="input" type="text" placeholder=" " name="subject" />
          <article class="cut"></article>
          <label for="subject" class="placeholder">Subject</label>
        </section>
        <section class="input-container ic2">
          <textarea id="description" class="input" placeholder=" " name="description"></textarea>
          <article class="cut"></article>
          <label for="description" class="placeholder">Description</label>
        </section>
        <section class="input-container ic2">
          <select id="priority" class="input" name="priority">
            <option value="Normal">Normal</option>
            <option value="Urgent">Urgent</option>
            <option value="Immediate">Immediate</option>
          </select>
          <article class="cut"></article>
          <label for="priority" class="placeholder">Priority</label>
        </section>
        <section class="input-container ic2">
          <input type="text" id="tag-input" class="input" name="tag" placeholder=" "/>
          <article class="cut"></article>
          <label for="tag-input" class="placeholder">Tags</label>
        </section>
        <section class="input-container ic2">
          <select id="department" class="input" name="department">
            <option value="-1">None</option>
            <?php foreach ($departments as $department) { ?>
              <option value="<?= $department->id; ?>"><?= $department->name; ?></option>
            <?php } ?>
          </select>
          <article class="cut"></article>
          <label for="department" class="placeholder">Department</label>
        </section>
        <button type="text" class="submit">Submit</button>
      </form>
    </article>

<?php } ?>
