<?php

namespace App\ValueObjects;

class Movimiento
{
    public $Ejercicio = '';
    public $nroOperacion;
    public $tipoMovimiento = '';
    public $propietario = '';
    public $serie = '';
    public $nroDocumento = '';
    public $UUID;
    public $fecha = '';
    public $fechaAplicacion = '';
    public $fechaEmision;
    public $fechaAuxiliar;
    public $GrupoFacturacion = '';
    public $RegistroAuxiliar = '';
    public $CodigoVendedor = '';
    public $CodigoOperario = '';
    public $centroCoste = '';
    public $FormaEnvio = '';
    public $ejercicioFactura = '';
    public $propietarioFactura = '';
    public $serieFactura = '';
    public $nroFactura = 0;
    public $noFacturar = false;
    public $facturado = false;
    public $traspasado = false;
    public $origen = 0;
    public $EjercicioOrigen;
    public $NroOperacionOrigen;
    public $NroDocumentoProp = '';
    public $entregaACuenta = 0;
    public $entregaEfectivo = 0;
    public $codigoTransportista = '';
    public $portes;
    public $codigoFormaCobro = '';
    public $OrganismoPublico = '';
    public $Situacion = 0;
    public $descripcion = '';
    public $CampoLibre1 = '';
    public $CampoLibre2 = '';
    public $CampoLibre3 = '';
    public $CampoLibre4 = '';
    public $TipoVentaPeriodica = '';
    public $Creado;
    public $Revisado = false;
    public $FechaEnvioPorCorreo;
    public $Anotación = '';
    public $Firma;

    public function __construct($documentType, $data)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $data['FECHA']);
        $this->tipoMovimiento = $documentType;

        $this->Ejercicio = (int) date_format($date, 'Y');
        $this->nroDocumento = (int) $data['NUMERO'];
        $this->fecha = $data['FECHA'];
        $this->fechaAplicacion = $data['FECHA'];
        $this->Creado = $data['FECHA'].' 00:00:00';
    }

    public function toCsv()
    {
        $csv = "";
        foreach ($this as $key => $value) {
            if ($key == 'fecha' || $key == 'fechaAplicacion' || $key == 'Creado') {
                    $csv .= $value.',';
                    continue;
            }
            if ($key != 'Firma') {
                if (gettype($value) == 'string') {
                    $csv .= "'${value}',";
                } elseif (gettype($value) == 'boolean') {
                    $csv .= $value ? 'True,' : 'False,';
                } else {
                    $csv .= $value.',';
                }
            } else {
                $csv .= "${value}\n";
            }
        }

        return $csv;
    }
}
