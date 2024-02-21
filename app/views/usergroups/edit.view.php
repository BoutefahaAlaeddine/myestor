<div class="action">
  <form action="" method="post">

    <div class="row">
      <div class="inputs">
        <label for=""><?= $text_labels_group_name?></label>
        <input name="GroupName" type="text" placeholder="<?= $text_labels_group_name?>" value="<?= $group->GroupName?>">
      </div>
    </div>
    <button type="submit" name="submit"> <?=$text_save_group?></button>
  </form>
</div>