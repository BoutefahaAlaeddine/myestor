<div class="action">
  <form action="" method="post">

    <div class="row">
      <div class="inputs">
        <label for=""><?=$text_edit_employee_nom ?></label>
        <input name="nom" type="text" placeholder="<?=$text_edit_employee_nom?>" value="<?=$employee->nom?>">
      </div>
      <div class="inputs">
        <label for=""><?=$text_edit_employee_prenom ?></label>
        <input name="nom" type="text" placeholder="<?=$text_edit_employee_nom_et_prenom ?>" value="<?=$employee->prenom?>">
      </div>
      <div class="inputs">
        <label for=""><?=$text_edit_employee_matricule ?></label>
        <input name="matricule" type="text" placeholder="<?=$text_edit_employee_matricule ?>" value="<?=$employee->prenom?>">
      </div>
    </div>

    <div class="row">
      <div class="inputs">
        <label for=""><?=$text_edit_employee_depart ?></label>
        <input name="depart" type="text" placeholder="<?=$text_edit_employee_depart ?>" value="<?=$employee->depart?>">
      </div>
      <div class="inputs">
        <label for=""><?=$text_edit_employee_poste ?></label>
        <input name="poste" type="text" placeholder="<?=$text_edit_employee_poste ?>" value="<?=$employee->poste?>">
      </div>
      <div class="inputs">
        <label for=""><?=$text_edit_employee_date ?> </label>
        <input name="date_emb" type="datetime-local" placeholder="<?=$text_edit_employee_date ?>" value="<?=$employee->date_emb?>">
      </div>

      <div class="inputs">
        <label for=""><?=$text_edit_employee_statut ?></label>
        <select name="statut" id="" placeholder="<?=$text_edit_employee_statut?>">
          <option value="">...</option>
          <option value="1"  <?= ($employee->statut==1)?"selected":"" ?>><?=$text_edit_employee_active?></option>
          <option value="0" <?= ($employee->statut==0)?"selected":"" ?>> <?=$text_edit_employee_resilie?></option>
        </select>
      </div>
    </div>
    <button type="submit" name="submit"> <?=$text_edit_employee?></button>
  </form>
</div>