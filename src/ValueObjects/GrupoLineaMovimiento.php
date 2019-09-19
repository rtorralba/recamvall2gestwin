<?php

namespace App\ValueObjects;

class GrupoLineaMovimiento
{
    public $Ejercicio;
    public $nroOperacion;
    public $NroPagina = 0;
    public $CodigoGrupo = '';
    public $descripcion = '';
    public $Anotacion = '';

    public function __construct($data)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $data['FECHA']);
        $this->Ejercicio = (int) date_format($date, 'Y');
        /*$this->nroOperacion = (int) $nroOperacion;
        $this->CodigoGrupo = $CodigoGrupo;
        $this->descripcion = $descripcion;
        $this->Anotacion = $Anotacion;*/
    }

    public function toCsv()
    {
        $csv = "";
        foreach ($this as $key => $value) {
            if ($key != 'Anotacion') {
                if (gettype($value) == 'string') {
                    $csv .= "'${value}',";
                } elseif (gettype($value) == 'boolean') {
                    $csv .= $value ? 'True,' : 'False,';
                } else {
                    $csv .= $value.',';
                }
            } else {
                $csv .= "'${value}'\n";
            }
        }

        return $csv;
    }
}
