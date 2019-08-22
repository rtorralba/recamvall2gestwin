<?php

namespace App\ValueObjects;

class LineaMovimiento
{
    public $Ejercicio = "";
    public $nroOperacion = "";
    public $NroPagina = "";
    public $nroLinea = "";
    public $fecha = "";
    public $fechaAplicacion = "";
    public $nroRegistro = "";
    public $AsignacionOrigen = "";
    public $tipoMovimientoOrige = "";
    public $ejercicioOrigen = "";
    public $nroOperacionOrigen = "";
    public $nroRegistroOrigen = "";
    public $UIDArticulo = "";
    public $codigoArticulo = "";
    public $codigoClaseA = "";
    public $codigoClaseB = "";
    public $codigoClaseC = "";
    public $loteFabricacion = "";
    public $nroSerie = "";
    public $CampoLibre1 = "";
    public $CampoLibre2 = "";
    public $CampoLibre3 = "";
    public $CampoLibre4 = "";
    public $descripcion = "";
    public $codigoAlmacen = "";
    public $Ubicacion = "";
    public $cantidad = "";
    public $cantidadAjustada = "";
    public $cantidadProcesada = "";
    public $Procesada = "";
    public $precioDivisa = "";
    public $precio = "";
    public $recargo = "";
    public $PuntoVerde = "";
    public $descuento = "";
    public $nroCajas = "";
    public $largo = "";
    public $ancho = "";
    public $alto = "";
    public $bultos = "";
    public $noCalcularMargen = "";
    public $TipoLinea = "";
    public $Oferta = "";
    public $PesoEnvase = "";
    public $Tara = "";
    public $Peso = "";
    public $ImporteBruto = "";
    public $ImporteDescuento = "";
    public $ImporteNeto = "";
    public $CodigoTipoIVA = "";
    public $CuotaIVA = "";
    public $CuotaRE = "";
    public $PrecioIVA = "";
    public $ImporteTotal = "";
    public $Parametros = "";
    public $Anotacion = "";

    public function __construct($data)
    {
        $this->nroSerie = $data['SERIE'];
        $this->fecha = $data['FECHA'];
        $this->codigoArticulo = $data['REFERENCIA'];
        $this->descripcion = $data['DENOMINACION'];
        $this->cantidad = $data['CANTIDAD'];
        $this->precio = $data['PRECIO'];
        $this->descuento = $data['DESCUENTO1'];
        $this->ImporteBruto = $data['IMP_LINEA'];
        $this->ImporteNeto = $data['IMP_BASE'];
        $this->precioDivisa = $data['DIVISA'];
    }

    public function toCsv()
    {
        $csv = "";
        foreach ($this as $key => $value) {
            if ($key != 'Anotacion') {
                $csv .= $value.',';
            } else {
                $csv .= $value."\n";
            }
        }

        return $csv;
    }
}
