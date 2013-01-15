<?php

/**
 * 
 */
class Departamento extends CI_Model{
  
  var $IdDepartamento;
  var $IdJefeDepartamento;
  var $Nombre;
  
  
  function __construct(){
    parent::__construct();
  }
 
 
  /**
   * Obtener el listado de carreras del departamento. Devuleve un array de objetos.
   *
   * @access  public
   * @param posicion del primer item de la lista a mostrar
   * @param cantidad de items a mostrar (tamaño de página)
   * @return  array
   */  
  public function listarCarreras($pagNumero, $pagLongitud){
    $idDepartamento = $this->db->escape($this->IdDepartamento);
    $pagNumero = $this->db->escape($pagNumero);
    $pagLongitud = $this->db->escape($pagLongitud);
    $query = $this->db->query("call esp_listar_carreras_departamento($idDepartamento, $pagNumero, $pagLongitud)");
    $data = $query->result('Carrera');
    $query->free_result();
    $this->db->reconnect();
    return $data;
  }
    
    
  /**
   * Obtener la cantidad de carreras del departamento.
   *
   * @access public
   * @return int
   */ 
  public function cantidadCarreras(){
    $idDepartamento = $this->db->escape($this->IdDepartamento);
    $query = $this->db->query("call esp_cantidad_carreras_departamento($idDepartamento)");
    $data=$query->row();
    $query->free_result();
    $this->db->reconnect();
    return ($data!=FALSE)?$data->Cantidad:0;
  }

}

?>