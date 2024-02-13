<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// this calls will be available once the config is using
// $config['composer_autoload'] = TRUE; inside the config.php
// and the vendor folder is located inside 'application' folder too...
require_once APPPATH . '../vendor/autoload.php';
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Endroid\QrCode\QrCode;

class Barcode {

	 protected $CI;

   public function generateBarcode($text, $type){
        $qrCodeStatus = false;
        $generator = new BarcodeGeneratorPNG();
        switch ($type) {
            case 'CODE39':
                $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_39);
            break;
            case 'EAN13':
                $barcode = $generator->getBarcode($text, $generator::TYPE_EAN_13);
            break;
            case 'QRCODE':
                $barcode = new QrCode($text);
                $qrCodeStatus = true;	
            break;
            default :
                $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_128);
            break;
        }

        // Simpan barcode sebagai file PNG
        $filename = 'media/barcodes/barcode_' . $type . '_' . time() . '.png';
        if(!$qrCodeStatus){
        file_put_contents($filename, $barcode);
        }else{
            $barcode->writeFile($filename);
        }
        
        return $filename;
    }

	public function test($n, $a){
			
			// Contoh panggilan fungsi dengan teks '123456'
	$nomer = $n; //$_POST['nomer'];
	$jenis = $a; //$_POST['jenis'];

	$barcodeFile = "";
	$barcodeFile = $this->generateBarcode($nomer, $jenis);
	echo $barcodeFile;
   
	}
   
}
?>