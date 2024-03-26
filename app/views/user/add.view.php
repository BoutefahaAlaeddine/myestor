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
        <label for=""><?= $text_label_Username ?></label>
        <input name="Username" type="text" placeholder="<?= $text_label_Username ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_Password ?></label>
        <input name="Password" type="password" placeholder="<?= $text_label_Password ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_CPassword ?></label>
        <input name="CPassword" type="password" placeholder="<?= $text_label_CPassword ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
    </div>

    <div class="row d-flex">
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_Email ?></label>
        <input name="Email" type="email" placeholder="<?= $text_label_Email ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_CEmail ?></label>
        <input name="CEmail" type="email" placeholder="<?= $text_label_CEmail ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_label_phoneNumber ?></label>
        <input name="phoneNumber" type="text" placeholder="<?= $text_label_phoneNumber ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <select name="GroupId" id="">
          <option value=""><?= $text_user_GroupId ?></option>
          <?php foreach ($groups as $group) :  ?>
            <option value="<?= $group->GroupId ?>"><?= $group->GroupName ?></option>
          <?php endforeach;  ?>
        </select>
      </div>
    </div>
    <button class="pad-5 c-white t-alg-cn b-rad-5 t-trn-cp m-top-10 c-pointer" type="submit" name="submit"> <?= $text_label_save ?></button>
  </form>
</div>