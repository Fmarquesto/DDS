<?php
namespace App\Model;


class Textos implements \JsonSerializable
{
    /**
     * @var string
     */
    private $textID;

    /**
     * @var string
     */
    private $textLine;

    /**
     * @param string $textID
     * @return Textos
     */
    public function setTextID(string $textID): Textos
    {
        $this->textID = $textID;
        return $this;
    }

    /**
     * @param string $textLine
     * @return Textos
     */
    public function setTextLine(string $textLine): Textos
    {
        $this->textLine = $textLine;
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
            "TextId"=>$this->textID,
            "TextLine"=>$this->textLine
        );
        foreach($data as $k =>$d){
            if(!is_array($d) && is_null($d)){
                unset($data[$k]);
            }
        }
        return $data;
    }
}