<div class="action">
  <form action="" method="post">

    <div class="row">
      <div class="inputs">
        <label for=""><?= $text_add_employee_nom?></label>
        <input name="nom" type="text" placeholder="<?= $text_add_employee_nom?>">
      </div>
      <div class="inputs">
        <label for=""><?= $text_add_employee_prenom ?></label>
        <input name="nom" type="text" placeholder="<?= $text_add_employee_prenom ?>">
      </div>
      <div class="inputs">
        <label for=""><?= $text_add_employee_matricule?> </label>
        <input name="matricule" type="text" placeholder="<?= $text_add_employee_matricule?> ">
      </div>
    </div>

    <div class="row">
      <div class="inputs">
        <label for=""><?= $text_add_employee_depart?></label>
        <input name="depart" type="text" placeholder="<?= $text_add_employee_depart?>">
      </div>
      <div class="inputs">
        <label for=""><?=$text_add_employee_poste?></label>
        <input name="poste" type="text" placeholder="<?=$text_add_employee_poste?>">
      </div>
      <div class="inputs">
        <label for=""><?= $text_add_employee_date?> </label>
        <input name="date_emb" type="datetime-local" placeholder="<?= $text_add_employee_date?>">
      </div>

      <div class="inputs">
        <label for=""><?= $text_add_employee_statut ?></label>
        <select name="statut" id="" placeholder="<?= $text_add_employee_statut ?>">
          <option value="">...</option>
          <option value="1"><?= $text_add_employee_active?></option>
          <option value="0"><?= $text_add_employee_resilie?></option>
        </select>
      </div>
    </div>

    <button type="submit" name="submit"> <?=$text_add_employee?></button>
  </form>
</div>