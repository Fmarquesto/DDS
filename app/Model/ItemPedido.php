<?php
namespace App\Model;


class ItemPedido implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $posicion;

    /**
     * @var string
     */
    private $codigoMaterialDDS;

    /**
     * @var string
     */
    private $materialConversor;

    /**
     * @var string
     */
    private $codigoBarra;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var float
     */
    private $descuentoTerceros;

    /**
     * @var string
     */
    private $numeroAutorizacion;

    /**
     * @var RemitoItemPedido
     */
    private $remito;

    /**
     * @var Condiciones[]
     */
    private $condiciones;

    /**
     * @var Textos[]
     */
    private $textos;

    /**
     * @var string
     */
    private $zTerm;

    /**
     * @var string
     */
    private $aplicarCondicionHabitual;

    /**
     * @var \DateTime
     */
    private $fechaPedido;

    /**
     * @var string
     */
    private $zagrup;

    /**
     * @var Referencias[]
     */
    private $referencias;

    /**
     * @param int $posicion
     * @return ItemPedido
     */
    public function setPosicion(int $posicion): ItemPedido
    {
        $this->posicion = $posicion;
        return $this;
    }

    /**
     * @param string $codigoMaterialDDS
     * @return ItemPedido
     */
    public function setCodigoMaterialDDS(string $codigoMaterialDDS): ItemPedido
    {
        $this->codigoMaterialDDS = $codigoMaterialDDS;
        return $this;
    }

    /**
     * @param string $materialConversor
     * @return ItemPedido
     */
    public function setMaterialConversor(string $materialConversor): ItemPedido
    {
        $this->materialConversor = $materialConversor;
        return $this;
    }

    /**
     * @param string $codigoBarra
     * @return ItemPedido
     */
    public function setCodigoBarra(string $codigoBarra): ItemPedido
    {
        $this->codigoBarra = $codigoBarra;
        return $this;
    }

    /**
     * @param int $cantidad
     * @return ItemPedido
     */
    public function setCantidad(int $cantidad): ItemPedido
    {
        $this->cantidad = $cantidad;
        return $this;
    }

    /**
     * @param float $descuentoTerceros
     * @return ItemPedido
     */
    public function setDescuentoTerceros(float $descuentoTerceros): ItemPedido
    {
        $this->descuentoTerceros = $descuentoTerceros;
        return $this;
    }

    /**
     * @param string $numeroAutorizacion
     * @return ItemPedido
     */
    public function setNumeroAutorizacion(string $numeroAutorizacion): ItemPedido
    {
        $this->numeroAutorizacion = $numeroAutorizacion;
        return $this;
    }

    /**
     * @param RemitoItemPedido $remito
     * @return ItemPedido
     */
    public function setRemito(RemitoItemPedido $remito): ItemPedido
    {
        $this->remito = $remito;
        return $this;
    }

    /**
     * @param Condiciones[] $condiciones
     * @return ItemPedido
     */
    public function setCondiciones(array $condiciones): ItemPedido
    {
        $this->condiciones = $condiciones;
        return $this;
    }

    /**
     * @param Textos[] $textos
     * @return ItemPedido
     */
    public function setTextos(array $textos): ItemPedido
    {
        $this->textos = $textos;
        return $this;
    }

    /**
     * @param string $zTerm
     * @return ItemPedido
     */
    public function setZTerm(string $zTerm): ItemPedido
    {
        $this->zTerm = $zTerm;
        return $this;
    }

    /**
     * @param string $aplicarCondicionHabitual
     * @return ItemPedido
     */
    public function setAplicarCondicionHabitual(string $aplicarCondicionHabitual): ItemPedido
    {
        $this->aplicarCondicionHabitual = $aplicarCondicionHabitual;
        return $this;
    }

    /**
     * @param \DateTime $fechaPedido
     * @return ItemPedido
     */
    public function setFechaPedido(\DateTime $fechaPedido): ItemPedido
    {
        $this->fechaPedido = $fechaPedido;
        return $this;
    }

    /**
     * @param mixed $zagrup
     * @return ItemPedido
     */
    public function setZagrup($zagrup)
    {
        $this->zagrup = $zagrup;
        return $this;
    }

    /**
     * @param Referencias[] $referencias
     * @return ItemPedido
     */
    public function setReferencias(array $referencias): ItemPedido
    {
        $this->referencias = $referencias;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $data = array(
            "Cantidad"=>$this->cantidad,
            "CodigoBarra"=>$this->codigoBarra,
            "CodigoMaterialDDS"=>$this->codigoMaterialDDS,
            "DescuentoTerceros"=>$this->descuentoTerceros,
            "MaterialConversor"=>$this->materialConversor,
            "NumeroAutorizacion"=>$this->numeroAutorizacion,
            "Posicion"=>$this->posicion,
            "ZTerm"=>$this->zTerm,
            "AplicarCondicionHabitual"=>$this->aplicarCondicionHabitual,
            "ZAGRUP"=>$this->zagrup,
            "Remito"=>$this->remito,
            "Condiciones"=>$this->condiciones,
            "Textos"=>$this->textos,
            "Referencias"=>$this->referencias
        );

        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }
}