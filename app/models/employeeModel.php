<?php
namespace PHPMVC\models;

class EmployeeModel extends AbstractModel
{
  public $id;
  protected $nom;
  protected $prenom;
  protected $matricule;
  protected $depart;
  protected $poste;
  protected $date_emb;
  protected $statut;

  protected static $primaryKey="id";
  protected static $tableName = "employes";
  protected static $tableSchema = array(
    "nom" => self::DATA_TYPE_STR,
    "prenom" => self::DATA_TYPE_STR,
    "matricule" => self::DATA_TYPE_INT,
    "depart" => self::DATA_TYPE_STR,
    "poste" => self::DATA_TYPE_STR,
    "date_emb" => self::DATA_TYPE_DATE,
    "statut" => self::DATA_TYPE_INT,
  );

  public function __construct($nom, $prenom, $matricule, $depart, $poste, $date_emb, $statut)
  {
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->matricule = $matricule;
    $this->depart = $depart;
    $this->poste = $poste;
    $this->date_emb = $date_emb;
    $this->statut = $statut;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }
public function setName($nom){
  $this->nom = $nom;
}

}
?>
