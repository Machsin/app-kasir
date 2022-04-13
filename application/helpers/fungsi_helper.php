<?php
function indo_currency($nominal)
{
    $result = "Rp " . number_format($nominal, 0, ',', '.');
    return $result;
}
function indo_date($date)
{
    $d = substr($date, '8', '2');
    $m = substr($date, '5', '2');
    $y = substr($date, '0', '4');
    return $d . '-' . $m . '-' . $y;
}
function indo_date2($date)
{
    $d = substr($date, '8', '2');
    $m = substr($date, '5', '2');
    $y = substr($date, '0', '4');
    $h = substr($date, '11', '8');
    return '<i class="fa fa-calendar"></i> ' . $d . '-' . $m . '-' . $y . ' <i class="fa fa-clock-o"></i> ' . $h;
}
