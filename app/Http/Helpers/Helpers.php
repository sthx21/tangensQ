<?php
////namespace App\Http\Helpers;
use Carbon\Carbon;
//
//class Helpers

    function createDate($date)
    {
        return Carbon::create($date);
    }

    function createFormatedDate($date)
    {
        return Carbon::create($date)->format('d.m.y');
    }
function daysToBegin($date)
{

    return $date->diffInDays(Carbon::today());
}
function occupancyRate($rate): \Illuminate\Support\Collection
{
    $output = [];
    if ($rate <= 3 && $rate > 0) {
        $output['rate'] = $rate . trans('workshops.show.occupancyRateClients');
        $output['colour'] = '#be0626';
    }
    if ($rate > 3 && $rate <= 9 ) {
        $output['rate'] = $rate . trans('workshops.show.occupancyRateClients');
        $output['colour'] = 'gold';
    }

    if ($rate > 9 ) {
        $output['rate'] = $rate . trans('workshops.show.occupancyRateClients');
        $output['colour'] = '#5ac45e';
    }

    if($rate == 0) {
        $output['rate'] = trans('workshops.index.unbooked');
        $output['colour'] = '#be0626';
    }
    return collect($output);

}
    /**
     * Remove null
     *
     * @param $input
     * @return array
     */
    function removeNull($input)
    {
        foreach ($input as $key => $value) {
            if ($value == null) {
                unset($input[$key]);
            }
        }
        return $input;
    }

    function shortenTitle($text, $maxchar, $end = '...')
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }
        return $output;
    }

