<?php
namespace App\Model;


class Referencias implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @param int $id
     * @return Referencias
     */
    public function setId(int $id): Referencias
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $codigo
     * @return Referencias
     */
    public function setCodigo(string $codigo): Referencias
    {
        $this->codigo = $codigo;
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
            "Codigo"=>$this->codigo
        );

        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }
}