<?php
namespace App\Model;

class RealizarCompra extends RestService
{
    public static $uri = 'realizarCompra';
    /**
     * @var string
     */
    private $motivo;

    /**
     * @var string
     */
    private $clienteConversor;

    /**
     * @var string
     */
    private $numeroClienteDDS;

    /**
     * @var string
     */
    private $numeroPedido;

    /**
     * @var string
     */
    private $prestador;

    /**
     * @var string
     */
    private $numeroConvenio;

    /**
     * @var string
     */
    private $centroSuministro;

    /**
     * @var ItemPedido[]
     */
    private $items;

    private $validarCliente;

    private $validatCredito;

    private $moverProcesoAutomatico;

    private $moverProcesoAutomaticoNC;

    /**
     * @param string $motivo
     * @return RealizarCompra
     */
    public function setMotivo(string $motivo): RealizarCompra
    {
        $this->motivo = $motivo;
        return $this;
    }

    /**
     * @param string $clienteConversor
     * @return RealizarCompra
     */
    public function setClienteConversor(string $clienteConversor): RealizarCompra
    {
        $this->clienteConversor = $clienteConversor;
        return $this;
    }

    /**
     * @param string $numeroClienteDDS
     * @return RealizarCompra
     */
    public function setNumeroClienteDDS(string $numeroClienteDDS): RealizarCompra
    {
        $this->numeroClienteDDS = $numeroClienteDDS;
        return $this;
    }

    /**
     * @param string $numeroPedido
     * @return RealizarCompra
     */
    public function setNumeroPedido(string $numeroPedido): RealizarCompra
    {
        $this->numeroPedido = $numeroPedido;
        return $this;
    }

    /**
     * @param string $prestador
     * @return RealizarCompra
     */
    public function setPrestador(string $prestador): RealizarCompra
    {
        $this->prestador = $prestador;
        return $this;
    }

    /**
     * @param string $numeroConvenio
     * @return RealizarCompra
     */
    public function setNumeroConvenio(string $numeroConvenio): RealizarCompra
    {
        $this->numeroConvenio = $numeroConvenio;
        return $this;
    }

    /**
     * @param string $centroSuministro
     * @return RealizarCompra
     */
    public function setCentroSuministro(string $centroSuministro): RealizarCompra
    {
        $this->centroSuministro = $centroSuministro;
        return $this;
    }

    /**
     * @param ItemPedido[] $items
     * @return RealizarCompra
     */
    public function setItems(array $items): RealizarCompra
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param mixed $validarCliente
     * @return RealizarCompra
     */
    public function setValidarCliente($validarCliente)
    {
        $this->validarCliente = $validarCliente;
        return $this;
    }

    /**
     * @param mixed $validatCredito
     * @return RealizarCompra
     */
    public function setValidatCredito($validatCredito)
    {
        $this->validatCredito = $validatCredito;
        return $this;
    }

    /**
     * @param mixed $moverProcesoAutomatico
     * @return RealizarCompra
     */
    public function setMoverProcesoAutomatico($moverProcesoAutomatico)
    {
        $this->moverProcesoAutomatico = $moverProcesoAutomatico;
        return $this;
    }

    /**
     * @param mixed $moverProcesoAutomaticoNC
     * @return RealizarCompra
     */
    public function setMoverProcesoAutomaticoNC($moverProcesoAutomaticoNC)
    {
        $this->moverProcesoAutomaticoNC = $moverProcesoAutomaticoNC;
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
        $data =  array(
            "CentroSuministro"=>$this->centroSuministro,
            "ClienteConversor"=>$this->clienteConversor,
            "ValidarCliente"=>$this->validarCliente,
            "ValidarCredito"=>$this->validatCredito,
            "MoverProcesoAutomatico"=>$this->moverProcesoAutomatico,
            "MoverProcesoAutomaticoNC"=>$this->moverProcesoAutomaticoNC,
            "Items"=>$this->items,
            "Motivo"=>$this->motivo,
            "Version" => "005",
            "NumeroClienteDDS"=>$this->numeroClienteDDS,
            "NumeroConvenio"=>$this->numeroConvenio,
            "NumeroPedido"=>$this->numeroPedido,
            "Prestador"=>$this->prestador
        );

        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }

    /**
     * @return mixed
     */
    function handleResponse($response,$httpCode)
    {
        $resultado = 'OK';
        if($httpCode != 204)
            $resultado = 'FALLO';
        return $resultado;
    }
}