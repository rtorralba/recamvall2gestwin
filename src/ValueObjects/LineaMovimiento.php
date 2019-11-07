<?php

namespace App\ValueObjects;

class LineaMovimiento
{
    public $Ejercicio;
    public $nroOperacion = 1;
    public $NroPagina = 0;
    public $nroLinea;
    public $fecha;
    public $fechaAplicacion;
    public $nroRegistro;
    public $AsignacionOrigen = 2;
    public $tipoMovimientoOrige = 0;
    public $ejercicioOrigen;
    public $nroOperacionOrigen;
    public $nroRegistroOrigen;
    public $UID;
    public $Articulo;
    public $codigoArticulo = '';
    public $codigoClaseA = '';
    public $codigoClaseB = '';
    public $codigoClaseC = '';
    public $loteFabricacion = '';
    public $nroSerie = '';
    public $CampoLibre1 = '';
    public $CampoLibre2 = '';
    public $CampoLibre3;
    public $CampoLibre4;
    public $descripcion = '';
    public $codigoAlmacen = '';
    public $Ubicacion = '';
    public $cantidad;
    public $cantidadAjustada;
    public $cantidadProcesada = 0;
    public $Procesada = false;
    public $precioDivisa = 0;
    public $precio;
    public $recargo = 0;
    public $PuntoVerde = 0;
    public $descuento;
    public $nroCajas = 0;
    public $largo = 0;
    public $ancho = 0;
    public $alto = 0;
    public $bultos;
    public $noCalcularMargen = false;
    public $TipoLinea = '';
    public $Oferta = false;
    public $PesoEnvase;
    public $Tara;
    public $Peso = 0;
    public $ImporteBruto;
    public $ImporteDescuento;
    public $ImporteNeto;
    public $CodigoTipoIVA;
    public $CuotaIVA;
    public $CuotaRE;
    public $PrecioIVA;
    public $ImporteTotal;
    public $Parametros;
    public $Anotacion = '';

    public function __construct($data, $nroLinea)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $data['FECHA']);
        $this->Ejercicio = (int) date_format($date, 'Y');
        $this->nroOperacion = (int) substr($data['NUMERO'], -8);
        $this->nroLinea = $nroLinea;
        $this->nroSerie = $data['SERIE'];
        $this->fecha = $data['FECHA'];
        $this->fechaAplicacion = $data['FECHA'];
        $this->codigoArticulo = $data['REFERENCIA'];
        $this->descripcion = $data['DENOMINACION'];
        $this->cantidad = (int) $data['CANTIDAD'];
        $this->cantidadAjustada = (int) $data['CANTIDAD'];
        $this->precioDivisa = 0;
        $this->precio = (double) str_replace(',', '.', $data['PRECIO']);
        $descuento = (double) $data['DESCUENTO1'];
        $this->descuento = round($this->precio * $descuento / 100, 2);
        $this->ImporteBruto = (double) $this->precio * $this->cantidad;
        $this->ImporteDescuento = (double) round($this->ImporteBruto - ($this->ImporteBruto * $descuento / 100), 2);
        $this->ImporteNeto = $this->ImporteBruto - $this->ImporteDescuento;
        $this->CodigoTipoIVA = (int) $data['POR_IVA'];
        $this->CuotaIVA = round($this->ImporteNeto * $this->CodigoTipoIVA / 100, 2);
        $this->CuotaRE = 0;
        $this->PrecioIVA = round($this->precio + ($this->precio * $this->CodigoTipoIVA / 100), 2);
        $this->ImporteTotal = $this->ImporteNeto + $this->CuotaIVA;
    }

    public function toCsv()
    {
        $csv = "";
        foreach ($this as $key => $value) {
            if ($key == 'fecha' || $key == 'fechaAplicacion') {
                    $csv .= $value.',';
                    continue;
            }
            if ($key != 'Anotacion') {
                if (gettype($value) == 'string') {
                    $csv .= "'${value}',";
                } elseif (gettype($value) == 'boolean') {
                    $csv .= $value ? 'True,' : 'False,';
                } else {
                    $csv .= $value.',';
                }
            } else {
                $csv .= "'${value}'\r\n";
            }
        }

        return $csv;
    }
}
