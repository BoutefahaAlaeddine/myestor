<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\models\EmployeeModel;

class EmployeeController extends abstractController
{
  //استعمال التريت
  use  InputFilter;
  use  Helper;

  public function defaultAction()
  {   $this->_language->load("template.common");
    //عمل رفع لمفات صفحة الديفولت
    $this->_language->load("employee.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["employees"] = EmployeeModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    //عمل رفع لمفات صفحة الادد
    $this->_language->load("template.common");
    $this->_language->load("employee.add");

    if (isset($_POST["submit"])) {
      $nom = $this->filterString($_POST["nom"]);
      $prenom = $this->filterString($_POST["prenom"]);
      $matricule = $this->filterInt($_POST["matricule"]);
      $depart = $this->filterString($_POST["depart"]);
      $poste = $this->filterString($_POST["poste"]);
      $date_emb = $this->filterDate($_POST["date_emb"]);
      $statut = $this->filterInt($_POST["statut"]);
      $emp = new EmployeeModel($nom, $prenom,  $matricule,  $depart,    $poste, $date_emb,  $statut);
      if ($emp->save()) {
        $_SESSION["message"] = "Employee, Save Successfully";
        $this->redirect("employee");
      }
      // print_r($emp);
    }
    $this->_view();
  }


  public function editAction()
  {
    $this->_language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->_language->load("employee.edit");

    //edit
    if (!empty($this->_params)) {
      $id = $this->filterInt($this->_params[0]);
      $emp = EmployeeModel::getByPk($id);
      if ($emp == false) {
        $this->redirect("employee");
      }

      $this->_data["employee"] = $emp;


      //update
      if (isset($_POST["submit"])) {
        $nom = $this->filterString($_POST["nom"]);
        $prenom = $this->filterString($_POST["prenom"]);
        $matricule = $this->filterInt($_POST["matricule"]);
        $depart = $this->filterString($_POST["depart"]);
        $poste = $this->filterString($_POST["poste"]);
        $date_emb = $this->filterDate($_POST["date_emb"]);
        $statut = $this->filterInt($_POST["statut"]);
        $emp = new EmployeeModel($nom, $prenom,  $matricule,  $depart,    $poste, $date_emb,  $statut);
        //لتاكيد انها تحديث
        $emp->id =  $id;
        if ($emp->save()) {
          $_SESSION["message"] = "Employee, Save Successfully";
          $this->redirect("employee");
        }
      }
      $this->_view();
    }
  }

  public function deleteAction()
  {

    $id = $this->filterInt($this->_params[0]);
    $emp = EmployeeModel::getByPk($id);
    if ($emp == false) {
      $this->redirect("employee");
    }

    if ($emp->delete()) {
      $_SESSION["message"] = "Employee, delete successfully";
      $this->redirect("employee");
    }
  }
}
