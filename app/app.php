<?php
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
require_once __DIR__ . '/../vendor/autoload.php';

$user = '14027';
$pass = 'sisqas31';
$baseUri = 'https://www.farmaciaesencia.com/apis/ventas/';

$logLevel = Logger::DEBUG;
$logger = new Logger('dds.log');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/dds_log.log',$logLevel));

$os = (new \App\Model\ObtenerStock($logger,$user,$pass,$baseUri))->withNumeroCliente('13456')->withMateriales(array('45623','1235','22134','2684','9697','77558'),false);
$ep = (new \App\Model\ObtenerEstadoPedido($logger,$user,$pass,$baseUri))->withNClienteDDS('123')->withNPedido('112');

$rC = (new \App\Model\RealizarCompra($logger,$user,$pass,$baseUri))
    ->setCentroSuministro('BSAS')
    ->setClienteConversor('321')
    ->setValidarCliente('X')
    ->setValidatCredito('')
    ->setMoverProcesoAutomatico('X')
    ->setMoverProcesoAutomaticoNC('')
    ->setItems(
        array(
            (new \App\Model\ItemPedido())
                ->setCantidad('4')
                ->setCodigoBarra('12121212121')
                ->setCodigoMaterialDDS('0123456789')
                ->setDescuentoTerceros('23')
                ->setMaterialConversor('9876543210')
                ->setNumeroAutorizacion('128937')
                ->setPosicion(1)
                ->setZTerm('ABCD')
                ->setAplicarCondicionHabitual('X')
                ->setZagrup('ASDKLJ')
                ->setRemito((new \App\Model\RemitoItemPedido())->setNumeroReceta('11')->setNumeroPedido('22')->setNumeroSolicitud('33')->setNombreApellidoAfiliado('44')->setNumeroAfiliado('55'))
                ->setCondiciones(array((new \App\Model\Condiciones())->setKschl('a')->setKbetr('4'),(new \App\Model\Condiciones())->setKschl('c')->setKbetr('5')))
                ->setTextos(array((new \App\Model\Textos())->setTextID('e')->setTextLine('f'),(new \App\Model\Textos())->setTextID('g')->setTextLine('h')))
                ->setReferencias(array((new \App\Model\Referencias())->setCodigo('aaaa'),(new \App\Model\Referencias())->setCodigo('bbbb'))),
            (new \App\Model\ItemPedido())
                ->setCantidad('4')
                ->setCodigoBarra('989898989898')
                ->setCodigoMaterialDDS('1234567890')
                ->setDescuentoTerceros('3')
                ->setMaterialConversor('0987654321')
                ->setNumeroAutorizacion('14141')
                ->setPosicion(2)
                ->setRemito((new \App\Model\RemitoItemPedido())->setNumeroPedido('55')->setNombreApellidoAfiliado('66')->setNumeroAfiliado('77'))
        )
    )
    ->setMotivo('A')
    ->setNumeroClienteDDS('345')
    ->setNumeroConvenio('1115151')
    ->setNumeroPedido('124')
    ->setPrestador('123123')
;
$allServices = array($ep,$os,$rC);
/**
 * @var \App\Model\RestService $service
 */
foreach($allServices as $service){
    try{
        $service->post($rC::$uri);
    }catch (Exception $e){
        echo $e->getMessage().PHP_EOL;
    }
}