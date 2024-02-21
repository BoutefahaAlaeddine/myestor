<div class="action">
  <form action="" method="post">

    <div class="row">
      <div class="inputs">
        <label for=""><?= $text_labels_privilege_title?></label>
        <input name="PrivilegeTitle" type="text" placeholder="<?= $text_labels_privilege_title?>">
      </div>
      <div class="inputs">
        <label for=""><?= $text_labels_privilege_link ?></label>
        <input name="Privilege" type="text" placeholder="<?= $text_labels_privilege_link ?>">
      </div>
    </div>

  

    <button type="submit" name="submit"> <?=$text_save_privilege?></button>
  </form>
</div>