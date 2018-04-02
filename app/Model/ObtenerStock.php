<?php
namespace App\Model;

class ObtenerStock extends RestService
{
    public static $uri = 'obtenerStock';

    /**
     * @var array $cliente
     */
    private $cliente;

    /**
     * @var array $materiales
     */
    private $materiales;

    /**
     * @var array
     */
    private static $stockStatus = array(
        " "=>"Hay stock",
        "C"=>"Crítico",
        "F"=>"En falta",
        "N"=>"No se comercializa",
        "I"=>"Material inexistente"
    );

    /**
     * @param string $nCliente
     * @return $this
     */
    public function withNumeroCliente(string $nCliente){
        if(is_null($this->cliente)){
            $this->cliente = array("NumeroCliente"=>$nCliente);
        }
        return $this;
    }

    /**
     * @param string $centro
     * @return $this
     */
    public function withCentro(string $centro){
        if(is_null($this->cliente)){
            $this->cliente = array("Centro"=>$centro);
        }
        return $this;
    }

    /**
     * @param array $materiales
     * @param bool $codigoBarra
     * @return $this
     */
    public function withMateriales(array $materiales, $codigoBarra = false){
        foreach($materiales as $material){
            if($codigoBarra){
                $this->materiales[] = array("CodigoBarra"=>$material);
            }else{
                $this->materiales[] = array("CodigoMaterial"=>$material);
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return array(
            "Cliente"=>$this->cliente,
            "Materiales"=>$this->materiales
        );
    }
}