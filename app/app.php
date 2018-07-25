<?php
use App\Model\Condiciones;
use App\Model\ItemPedido;
use App\Model\ObtenerEstadoPedido;
use App\Model\ObtenerStock;
use App\Model\RealizarCompra;
use App\Model\Referencias;
use App\Model\RemitoItemPedido;
use App\Model\RestService;
use App\Model\Textos;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
require_once __DIR__ . '/../vendor/autoload.php';

$user = '14004';
$pass = 'sisqas31';
$baseUri = 'https://www.farmaciaesencia.com/apis/ventas/';

$logLevel = Logger::DEBUG;
$logger = new Logger('DDS.RESTSERVICE');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/dds_log.log',$logLevel));

$os = (new ObtenerStock($logger,$user,$pass,$baseUri))->withNumeroCliente('13456')->withMateriales(array('103189','100321'),false);
$ep = (new ObtenerEstadoPedido($logger,$user,$pass,$baseUri))->withNClienteDDS('14027')->withNPedido('100000090');

$rC = (new RealizarCompra($logger,$user,$pass,$baseUri))
    ->setItems(
        array(
            (new ItemPedido())
                ->setCantidad('4')
                ->setCodigoMaterialDDS('103189')
                ->setPosicion(1),
            (new ItemPedido())
                ->setCantidad('4')
                ->setCodigoMaterialDDS('100321')
                ->setPosicion(2)
        )
    )
    ->setNumeroClienteDDS('14027')
    ->setNumeroPedido('100000090')
;

$allServices = array($os,$rC,$ep);

foreach($allServices as $service){
    try{
        $res = $service->post($service::$uri);
        var_dump($res);
    }catch (Exception $e){
        echo $e->getMessage().PHP_EOL;
    }
}