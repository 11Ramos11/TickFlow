<?php 
function drawTicketCreator($departments, $priorities, $session) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Create a New Ticket</h2>
      </section>
      <section>
        <article class="form" id="create-ticket">
          <form action="../actions/createTicket.action.php" method="post">
            <section class="input-container ic1">
              <input id="subject" class="input" type="text" placeholder=" " name="subject" />
              <article class="cut">Subject</article>
              <label for="subject" class="placeholder">Subject</label>
            </section>
            <section class="input-container ic2">
              <textarea id="description" class="input" placeholder=" " name="description"></textarea>
              <article class="cut">Description</article>
              <label for="description" class="placeholder">Description</label>
            </section>
            <section class="input-container ic2">
              <select id="priority" class="input" name="priority">
                <?php foreach ($priorities as $priority){ ?>
                  <option value=<?=$priority->id?>><?=$priority->name?></option>
                <?php } ?>
              </select>
              <article class="cut">Priority</article>
              <label for="priority" class="placeholder">Priority</label>
            </section>
      
            <section class="input-container ic2">
              <select id="department" class="input" name="department">
                <option value="-1">None</option>
                <?php foreach ($departments as $department) { ?>
                  <option value="<?= $department->id; ?>"><?= $department->name; ?></option>
                <?php } ?>
              </select>
              <article class="cut">Department</article>
              <label for="department" class="placeholder">Department</label>
            </section>
            <section class="input-container ic2">
              <ul class="tags-box tags input-tags" id="tag-creator">
                <input type="text" id="tag-input" name="tag" placeholder="Tags">
              </ul>
              <ul id="auto-complete"></ul>
              <input type="hidden" id="tags" name="tags" value="">
            </section>
            <button type="text" class="submit" id="submit-button">Submit</button>
					  <input type="hidden" name="csrf" value="<?=$session->token?>">
          </form>
        </article>
      </section>
    </main>

<?php } ?>
