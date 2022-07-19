<?php

namespace App\Http\Controllers;



use Illuminate\Contracts\View\View;



class ReminderController extends Controller

{
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

    /**
     * Show all Workshops.
     *
     * @return View
     */
    public function create(): View
    {


        return view('reminders.create-reminder');
    }


}
