<?php
namespace App\Model;


class RemitoItemPedido implements \JsonSerializable
{
    /**
     * @var string
     */
    private $numeroPedido;

    /**
     * @var string
     */
    private $numeroReceta;

    /**
     * @var string
     */
    private $numeroSolicitud;

    /**
     * @var string
     */
    private $nombreApellidoAfiliado;

    /**
     * @var string
     */
    private $numeroAfiliado;

    /**
     * @param string $numeroPedido
     * @return RemitoItemPedido
     */
    public function setNumeroPedido(string $numeroPedido): RemitoItemPedido
    {
        $this->numeroPedido = $numeroPedido;
        return $this;
    }

    /**
     * @param string $numeroReceta
     * @return RemitoItemPedido
     */
    public function setNumeroReceta(string $numeroReceta): RemitoItemPedido
    {
        $this->numeroReceta = $numeroReceta;
        return $this;
    }

    /**
     * @param string $numeroSolicitud
     * @return RemitoItemPedido
     */
    public function setNumeroSolicitud(string $numeroSolicitud): RemitoItemPedido
    {
        $this->numeroSolicitud = $numeroSolicitud;
        return $this;
    }

    /**
     * @param string $nombreApellidoAfiliado
     * @return RemitoItemPedido
     */
    public function setNombreApellidoAfiliado(string $nombreApellidoAfiliado): RemitoItemPedido
    {
        $this->nombreApellidoAfiliado = $nombreApellidoAfiliado;
        return $this;
    }

    /**
     * @param string $numeroAfiliado
     * @return RemitoItemPedido
     */
    public function setNumeroAfiliado(string $numeroAfiliado): RemitoItemPedido
    {
        $this->numeroAfiliado = $numeroAfiliado;
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
           "NumeroReceta"=>$this->numeroReceta,
           "NumeroPedido"=>$this->numeroPedido,
           "NumeroSolicitud"=>$this->numeroSolicitud,
           "NombreApellidoAfiliado"=>$this->nombreApellidoAfiliado,
           "NumeroAfiliado"=>$this->numeroAfiliado
       );
        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }
}