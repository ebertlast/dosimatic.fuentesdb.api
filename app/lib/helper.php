<?php
namespace App\Lib;
class Helper
{
    public function printf_array($cadena, $arregloValores, $caracterDeSustitucion = '%s')
    {
        $formato = $cadena;
        foreach ($arregloValores as $texto) {
            $pos = stripos($formato,$caracterDeSustitucion,0);
            $formato = substr_replace($formato, $texto, $pos, 2);
        }
        return $formato;
    }
}