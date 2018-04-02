<?php
namespace App\Model;


class ObtenerEstadoPedido extends RestService
{
    public static $uri = 'ObtenerEstadoPedido';

    /**
     * @var string $nCliente
     */
    private $nCliente;

    /**
     * @var string $nClienteDDS
     */
    private $nClienteDDS;

    /**
     * @var string $prestador
     */
    private $prestador;

    /**
     * @var string $nPedido
     */
    private $nPedido;

    /**
     * @param string $nCliente
     * @return $this
     */
    public function withNCliente(string $nCliente){
        $this->nCliente = $nCliente;
        return $this;
    }

    /**
     * @param string $nClienteDDS
     * @return $this
     */
    public function withNClienteDDS(string $nClienteDDS){
        $this->nClienteDDS = $nClienteDDS;
        return $this;
    }

    /**
     * @param string $prestador
     * @return $this
     */
    public function withPrestador(string $prestador){
        $this->prestador = $prestador;
        return $this;
    }

    /**
     * @param $nPedido
     * @return $this
     */
    public function withNPedido($nPedido){
        $this->nPedido = $nPedido;
        return $this;
    }

    /**
     * @return array
     */
    function jsonSerialize()
    {
        return array(
            "ClienteConversor" => $this->nCliente,
            "NumeroClienteDDS" => $this->nClienteDDS,
            "Prestador" => $this->prestador,
            "NumeroPedido" => $this->nPedido
        );
    }
}