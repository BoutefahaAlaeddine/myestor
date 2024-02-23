<?php
//  var_dump($this->session) 
  ?>

<h3 class="pad-5 wid-fc b-rad-5 c-white"><?= $text_header?></h3>
  
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

  <a href="<?= MAIN_LINK ?>usergroups/add" class="add pad-5 c-white m-bot-5 t-alg-cn b-rad-5 t-trn-cp"><?= $text_add_group ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th class="c-white t-trn-cp pad-10"><?= $text_table_groups_name ?></th>
        <th class="c-white t-trn-cp pad-10"><?= $text_table_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $groups) :

        foreach ($groups as $group) :
      ?>
          <tr>
            <td class="pad-10"> <?php echo $group->GroupName ?></td>
            <td class="pad-10">
              <a class="t-trn-cp f-weg-bold" href="<?= MAIN_LINK . "usergroups/edit/" . $group->GroupId ?>"><i class="fa-solid fa-pen-to-square"></i><?= $text_table_edit ?></a>

              | <a class="t-trn-cp f-weg-bold" href="<?= MAIN_LINK . "usergroups/delete/" . $group->GroupId ?>" onclick="if(!confirm(<?=$text_table_control_delete_confirm?>))return false;"><i class="fa fa_trash"></i> <?= $text_table_delete ?></a>
            </td>
          </tr>

        <?php
        endforeach;
      
      endif;
      ?>
    </tbody>
  </table>

</div>