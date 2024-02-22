<div class="action p-rel pad-20 m-top-10 w-full b-rad-5">
  <h4 class="p-abs c-white pad-5"> الاضافة</h4>
  <form action="" method="post" class="pad-10">
    <div class="row d-flex">
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_labels_privilege_title?></label>
        <input name="PrivilegeTitle" type="text" placeholder="<?= $text_labels_privilege_title?>" value="<?=$privilege->PrivilegeTitle?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_labels_privilege_link ?></label>
        <input name="Privilege" type="text" placeholder="<?= $text_labels_privilege_link ?>" value="<?=$privilege->Privilege?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
    </div>

  

    <button  class="pad-5 c-white t-alg-cn b-rad-5 t-trn-cp m-top-10 c-pointer" type="submit" name="submit"> <?=$text_save_privilege?></button>
  </form>
</div>