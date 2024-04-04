<h3 class="pad-5 wid-fc b-rad-5 c-white"><?= $text_header?></h3>
  
<div class="controller">
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
  <a href="<?= MAIN_LINK ?>productCategory/add" class="add pad-5 c-white m-bot-5 t-alg-cn b-rad-5 t-trn-cp"><?= $text_add_Category ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th class="c-white t-trn-cp pad-10"><?= $text_table_Name ?></th>
        <!-- <th class="c-white t-trn-cp pad-10"><?= $text_table_Image ?></th> -->
        <th class="c-white t-trn-cp pad-10"><?= $text_table_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $Categories) :

        foreach ($Categories as $Category) :
      ?>
          <tr>
            <td class="pad-10"> <?=  $Category->Name ?></td>
            <!-- <td class="pad-10"> <img src="<?=  $Category->Image ?>" alt=""></td> -->
            <td class="pad-10">
              <a class="t-trn-cp f-weg-bold" href="<?= MAIN_LINK . "productCategory/edit/" . $Category->CategoryId ?>"><i class="fa-solid fa-pen-to-square"></i><?= $text_table_edit ?></a>
              |
               <a class="t-trn-cp f-weg-bold" href="<?= MAIN_LINK . "productCategory/delete/" . $Category->CategoryId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i> <?= $text_table_delete ?></a>

            </td>
          </tr>

        <?php
        endforeach;
      
      endif;
      ?>
    </tbody>
  </table>

</div>