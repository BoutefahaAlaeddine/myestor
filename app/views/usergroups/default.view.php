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

  <a href="<?= MAIN_LINK ?>usergroups/add" class="add"><?= $text_add_group ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th><?= $text_table_groups_name ?></th>
        <th><?= $text_table_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $groups) :

        foreach ($groups as $group) :
      ?>
          <tr>
            <td> <?php echo $group->GroupName ?></td>
            <td>
              <a  href="<?= MAIN_LINK . "usergroups/edit/" . $group->GroupId ?>"><i class="fa-solid fa-pen-to-square"></i><?= $text_table_edit ?></a>

              | <a href="<?= MAIN_LINK . "usergroups/delete/" . $group->GroupId ?>" onclick="if(!confirm(<?=$text_table_control_delete_confirm?>))return false;"><i class="fa fa_trash"></i> <?= $text_table_delete ?></a>
            </td>
          </tr>

        <?php
        endforeach;
      
      endif;
      ?>
    </tbody>
  </table>

</div>