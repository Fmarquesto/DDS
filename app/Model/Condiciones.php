<?php
namespace App\Model;


class Condiciones implements \JsonSerializable
{
    /**
     * @var string
     */
    private $kschl;

    /**
     * @var string
     */
    private $kbetr;

    /**
     * @param string $kschl
     * @return Condiciones
     */
    public function setKschl(string $kschl): Condiciones
    {
        $this->kschl = $kschl;
        return $this;
    }

    /**
     * @param string $kbetr
     * @return Condiciones
     */
    public function setKbetr(string $kbetr): Condiciones
    {
        $this->kbetr = $kbetr;
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
            "KSCHL"=>$this->kschl,
            "KBETR"=>$this->kbetr
        );
        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }
}