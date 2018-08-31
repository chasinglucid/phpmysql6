<?php if (empty($joke->id) || $userId == $joke->authorId): ?>
<form action="" method="post">
  <input type="hidden" name="joke[id]" value="<?=$joke->id ?? ''?>">
  <label for="joketext">Type your joke here:</label>
  <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?=$joke->joketext ?? ''?></textarea>

  <p>Select categories for this joke:</p>
  <!-- loop over each category -->
  <?php foreach ($categories as $category): ?>

  <!-- create a checkbox for each category w/ the value
        propertiy set to the category id -->
  <!-- name="category[]" -- an array will be created -->
  <input type="checkbox"
         name="category[]" 
         value="<?=$category->id?>" />
  <label><?=$category->name?></label>
  <input type="submit" name="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit jokes that you posted.</p>

<?php endif; ?>