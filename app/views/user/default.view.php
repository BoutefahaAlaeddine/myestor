<?php

?>
  <h3 class="welcome-title">
  <?= $text_header?>
  </h3>
  
<div class="controller">
  <?php
  if (isset($_SESSION["message"])) { ?>
    <p class="message <?= isset($error) ? "error" : "" ?> ">
      <?= $_SESSION["message"] ?>
    </p>
  <?php
    unset($_SESSION["message"]);
  }

  ?>

  <a href="<?= MAIN_LINK ?>user/add" class="add"><?= $text_add_user ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th><?= $text_table_username ?></th>
        <th><?= $text_table_group ?></th>
        <th><?= $text_table_email ?></th>
        <th><?= $text_table_subscription_date ?></th>
        <th><?= $text_table_last_login ?></th>
        <th><?= $text_table_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $users) :

        foreach ($users as $user) :
      ?>
          <tr>
            <td> <?php echo $user->Username ?></td>
            <td> <?php echo $user->GroupName ?></td>
            <td> <?php echo $user->Email ?></td>
            <td> <?php echo $user->PhoneNumber ?></td>
            <td> <?php echo $user->SubscriptionData ?></td>
            <td> <?php echo $user->LastLogon ?></td>
            <td>
              <a  href="<?= MAIN_LINK . "user/edit/" . $user->UserId ?>"><i class="fa-solid fa-pen-to-square"></i><?= $text_table_edit ?></a>

              | <a href="<?= MAIN_LINK . "user/delete/" . $user->UserId ?>">onclick="if(!confirm(<?=$text_table_control_delete_confirm?>))return false;"><i class="fa fa_trash"></i> <?= $text_table_delete ?></a>
            </td>
          </tr>

        <?php
        endforeach;
      
      endif;
      ?>
    </tbody>
  </table>

</div>