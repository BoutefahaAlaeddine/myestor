<div class="action p-rel pad-20 m-top-10 w-full b-rad-5">
  <h4 class="p-abs c-white pad-5 t-trn-cp"><?= $text_labels_data_group ?></h4>
  <form action="" method="post" class="pad-10">
    <div class="row d-flex">
      <div class="inputs flex pad-5 p-rel">
        <label for=""><?= $text_labels_group_name ?></label>
        <input name="GroupName" type="text" placeholder="<?= $text_labels_group_name ?>">
        <span class="p-abs bottom-0 left-0 trans"></span>
      </div>
    </div>
    <h5><?= $text_labels_privilege_group_name ?></h5>
    <ul class="col">
      <li class="d-flex a-itm-cn">
        <input type="checkbox" id="for-1" class="check m-lef-5">
        <label for="for-1">حذف مورد</label>
      </li>
      <li class="d-flex a-itm-cn">
        <input  type="checkbox" id="for-2" class="check m-lef-5">
        <label for="for-2">حذف مورد</label>
      </li>
    </ul>
    <button class="pad-5 c-white t-alg-cn b-rad-5 t-trn-cp m-top-10 c-pointer" type="submit" name="submit"> <?= $text_save_group ?></button>
  </form>
</div>