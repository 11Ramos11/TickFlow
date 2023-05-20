<?php 
function drawFAQeditor($departments, $faq) { ?>
    <main class="middle-column">
      <section class="title">
      <h2>Edit FAQ</h2>
      </section>
      <section>
        <article class="form" id="create-form">
          <form action="../actions/editFAQ.action.php" method="post">
            <section class="input-container ic1">
              <input id="question" class="input" type="text" placeholder=" " name="question" value="<?=$faq->question?>"/>
              <article class="cut">Question</article>
              <label for="subject" class="placeholder">Question</label>
            </section>
            <section class="input-container ic2">
              <textarea id="answer" class="input" placeholder="" name="answer"><?=$faq->answer?></textarea>
              <article class="cut">Answer</article>
              <label for="answer" class="placeholder">Answer</label>
            </section>
            <section class="input-container ic2">
              <select id="department" class="input" name="department">
                <option value="-1">None</option>
                <?php foreach ($departments as $department) { ?>
                  <?php if($department->id == $faq->department) { ?>
                    <option value="<?= $department->id; ?>" selected><?= $department->name; ?></option>
                  <?php } else { ?>
                    <option value="<?= $department->id; ?>"><?= $department->name; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <article class="cut">Department</article>
              <label for="department" class="placeholder">Department</label>
            </section>
            <input type="hidden" name="id" value="<?=$faq->id?>">
            <button type="text" class="submit" id="submit-button">Submit</button>
          </form>
        </article>
      </section>
    </main>

<?php } ?>
