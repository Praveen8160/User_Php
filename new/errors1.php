<?php  if (count($errors2) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors2 as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>