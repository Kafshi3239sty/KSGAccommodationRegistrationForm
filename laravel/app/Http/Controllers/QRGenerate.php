<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class QRGenerate extends Controller
{
    //

    public function generateQrCode()
    {
        $qrCode = new QrCode('http://127.0.0.1:8000/participant/register');
        $writer = new PngWriter();

        $result = $writer->write($qrCode);

        $response = Response::make($result->getString(), 200);
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'qrcode.png');
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', $result->getMimeType());

        return $response;
    }
}
