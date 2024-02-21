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

  <a href="<?= MAIN_LINK ?>privilege/add" class="add"><?= $text_add_privilege ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th><?= $text_table_privilege_title ?></th>
        <th><?= $text_table_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $privileges) :

        foreach ($privileges as $privilege) :
      ?>
          <tr>
            <td> <?= $privilege->PrivilegeTitle ?></td>
            <td>
              <a  href="<?= MAIN_LINK . "privilege/edit/" . $privilege->PrivilegeId ?>"><i class="fa-solid fa-pen-to-square"></i><?= $text_table_edit ?></a>

              | <a href="<?= MAIN_LINK . "privilege/delete/" . $privilege->PrivilegeId ?>"onclick="if(!confirm(<?=$text_table_control_delete_confirm?>))return false;"><i class="fa-solid fa-trash"></i> <?= $text_table_delete ?></a>
            </td>
          </tr>

        <?php
        endforeach;
      
      endif;
      ?>
    </tbody>
  </table>

</div>