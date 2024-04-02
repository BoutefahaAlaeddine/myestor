<?php
  $messages = $this->messenger->getMessage();
  if (!empty($messages)) :
    foreach ($messages as $message) :
    ?>
      <p class="message t<?=$message[1]?> c-white pad-5 t-alg-cn">
        <?= $message[0] ?>
      </p>
  <?php
    endforeach;
  endif;
  ?>
<div class="action p-rel pad-20 m-top-10 w-full b-rad-5">
  <h4 class="p-abs c-white pad-5"><?= $text_header ?></h4>
  <form action="" method="post" class="pad-10">
    <div class="row d-flex">
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_Name ?></label>
        <input name="Name" type="text" placeholder="<?= $text_label_Name ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_PhoneNumber ?></label>
        <input name="PhoneNumber" type="text" placeholder="<?= $text_label_PhoneNumber ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_Email ?></label>
        <input name="Email" type="email" placeholder="<?= $text_label_Email ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_Address ?></label>
        <input name="Address" type="text" placeholder="<?= $text_label_Address ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
    </div>

    
    <button class="pad-5 c-white t-alg-cn b-rad-5 t-trn-cp m-top-10 c-pointer" type="submit" name="submit"> <?= $text_label_save ?></button>
  </form>
</div>