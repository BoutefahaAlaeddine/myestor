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

  <a href="<?= MAIN_LINK ?>employee/add" class="add"><?= $text_add_employee ?></a>

  <table class="tableInfo data">
    <thead>
      <tr>
        <th><?= $text_table_employee_nom_et_prenom ?></th>
        <th><?= $text_table_employee_matricule ?></th>
        <th><?= $text_table_employee_depart ?></th>
        <th><?= $text_table_employee_poste ?></th>
        <th><?= $text_table_employee_date ?></th>
        <th><?= $text_table_employee_statut ?></th>
        <th><?= $text_table_employee_control ?></th>
      </tr>
    </thead>

    <tbody>

      <?php
      //استدعائه على حساب وش كتبناه كامفتاح في الكنترولور
      if (false != $employees) :

        foreach ($employees as $employee) :
      ?>
          <tr>
            <td> <?php echo $employee->nom . " " . $employee->prenom ?></td>
            <td> <?php echo $employee->matricule ?></td>
            <td> <?php echo $employee->depart ?></td>
            <td> <?php echo $employee->poste ?></td>
            <td> <?php echo $employee->date_emb ?></td>
            <td data-status="<?php echo ($employee->statut == 1) ? "active" : "résilié" ?>"> <?php echo ($employee->statut == 1) ? $text_table_employee_active : $text_table_employee_resilie ?></td>
            <td>
              <a  href="<?= MAIN_LINK . "employee/edit/" . $employee->id ?>"><?= $text_table_employee_edit ?></a>

              | <a href="<?= MAIN_LINK . "employee/delete/" . $employee->id ?>"><?= $text_table_employee_delete ?></a>
            </td>
          </tr>

        <?php
        endforeach;
      else :
        ?>
        <td>
          <p>Sorry no employees to list</p>
        </td>
      <?php
      endif;
      ?>
    </tbody>
  </table>

</div>