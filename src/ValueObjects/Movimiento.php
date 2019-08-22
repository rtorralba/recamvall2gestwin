<?php

namespace App\ValueObjects;

class Movimiento
{
    public $Ejercicio = '';
    public $nroOperacion = '';
    public $tipoMovimiento = '';
    public $propietario = '';
    public $serie = '';
    public $nroDocumento = '';
    public $UUID = '';
    public $fecha = '';
    public $fechaAplicacion = '';
    public $fechaEmision = '';
    public $fechaAuxiliar = '';
    public $GrupoFacturacion = '';
    public $RegistroAuxiliar = '';
    public $CodigoVendedor = '';
    public $CodigoOperario = '';
    public $centroCoste = '';
    public $FormaEnvio = '';
    public $ejercicioFactura = '';
    public $propietarioFactura = '';
    public $serieFactura = '';
    public $nroFactura = '';
    public $noFacturar = '';
    public $facturado = '';
    public $traspasado = '';
    public $origen = '';
    public $EjercicioOrigen = '';
    public $NroOperacionOrigen = '';
    public $NroDocumentoProp = '';
    public $entregaACuenta = '';
    public $entregaEfectivo = '';
    public $codigoTransportista = '';
    public $portes = '';
    public $codigoFormaCobro = '';
    public $OrganismoPublico = '';
    public $Situación = '';
    public $descripción = '';
    public $CampoLibre1 = '';
    public $CampoLibre2 = '';
    public $CampoLibre3 = '';
    public $CampoLibre4 = '';
    public $CampoLibre5 = '';
    public $TipoVentaPeriodica = '';
    public $Creado = '';
    public $Revisado = '';
    public $FechaEnvioPorCorreo = '';
    public $Anotación = '';
    public $Firma = '';

    public function __construct($documentType, $data)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $data['FECHA']);
        $this->tipoMovimiento = $documentType;

        $this->Ejercicio = date_format($date, 'Y');
        $this->nroDocumento = $data['NUMERO'];
        $this->fecha = $data['FECHA'];
    }

    public function toCsv()
    {
        $csv = "";
        foreach ($this as $key => $value) {
            if ($key != 'Firma') {
                $csv .= $value.',';
            } else {
                $csv .= $value."\n";
            }
        }

        return $csv;
    }
}
