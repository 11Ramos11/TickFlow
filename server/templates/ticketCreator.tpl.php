<?php 
function drawTicketCreator($departments, $priorities) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Create a New Ticket</h2>
      </section>
      <section>
        <article class="form" id="create-ticket">
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
                <?php foreach ($priorities as $priority){ ?>
                  <option value=<?=$priority->id?>><?=$priority->name?></option>
                <?php } ?>
              </select>
              <article class="cut"></article>
              <label for="priority" class="placeholder">Priority</label>
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
            <section class="input-container ic2">
              <!---<input type="text" id="tag-input" class="input" name="tag" placeholder=" "/>
              <article class="cut"></article>
              <label for="tag-input" class="placeholder">Tags</label>-->
              <ul class="tags-box tags" id="tag-creator">
                <input type="text" id="tag-input" name="tag" placeholder="Tags">
              </ul>
              <input type="hidden" id="tags" name="tags" value="">
            </section>
            <button type="text" class="submit" id="submit-button">Submit</button>
          </form>
        </article>
      </section>
    </main>

<?php } ?>
