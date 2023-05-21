<?php 
function drawFAQcreator($departments, $session) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Create a New FAQ</h2>
      </section>
      <section>
        <article class="form" id="create-form">
          <form action="../actions/createFAQ.action.php" method="post">
            <section class="input-container ic1">
              <input id="question" class="input" type="text" placeholder=" " name="question" />
              <article class="cut">Question</article>
              <label for="subject" class="placeholder">Question</label>
            </section>
            <section class="input-container ic2">
              <textarea id="answer" class="input" placeholder=" " name="answer"></textarea>
              <article class="cut">Answer</article>
              <label for="answer" class="placeholder">Answer</label>
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
            <button type="text" class="submit" id="submit-button">Submit</button>
            <input hidden type="text" name="csrf" value=<?=$session->token?>>
          </form>
        </article>
      </section>
    </main>

<?php } ?>
