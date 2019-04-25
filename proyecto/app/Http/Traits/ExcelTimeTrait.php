<?php

namespace App\Http\Traits;

/**
* Trait destinado para conversión de serial de tiempo de Excel
* a timestamp y viceversa
*/
trait ExcelTimeTrait {
    /*
        Please use this formula to change from Excel date to Unix date, then you can use "gmdate" to get the real date in PHP:

        UNIX_DATE = (EXCEL_DATE - 25569) * 86400
        and to convert from Unix date to Excel date, use this formula:

        EXCEL_DATE = 25569 + (UNIX_DATE / 86400)
        After doing this formula into a variable, you can get the real date in PHP using this example:

        $UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
        echo gmdate("d-m-Y H:i:s", $UNIX_DATE);
    */

    /**
     * Convertir el serial de fecha de Excel
     * a un timestamp. Recibe el serial y el timestamp como se quiere mostrar
     * @param Int: $excel, String: $timestamp
     * @return Date
     */
    public function excel_to_timestamp( $excel, $timestamp )
    {
        return gmdate($timestamp, (($excel - 25569) * 86400) );
    }

    /**
     *
     *
     *
     */
    // public function timestamp_to_excel()
    // {
    //     // EXCEL_DATE = 25569 + (UNIX_DATE / 86400)
    // }
}