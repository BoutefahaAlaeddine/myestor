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
<form class='login  f-cairo col pad-20' action="" method='POST'>

  <img class="logo m-auto" src="<?= MAIN_SRC ?>/img/user.png" alt="">
  <h4 class='t-alg-cn c-white'><?= $login_header?></h4>
  <input class='m-bot-5 pad-5' type="text" name="user" placeholder='<?= $login_username?>' autocomplete='off'>
  <input class='m-bot-5 pad-5' type="password" name="pass" placeholder='<?= $login_password?>' autocomplete='new-password'>
  <input class='m-bot-5 pad-10 c-pointer c-white' name="login" type="submit" value='<?= $title?>' />
</form>