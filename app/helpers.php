<?php

use Illuminate\Support\Str;

    // FORMATTING FUNCTIONS

    // Format employees
    if(!function_exists('formatNumber')){
        function formatNumber($number){
            return number_format(round($number), 0, '.' , ',' );
        }
    }

    // Convert nl to <p>
    if(!function_exists('nl2p')){
        function nl2p($string){
            $paragraphs = '';
            foreach (explode("\n", $string) as $line) {
                if (trim($line)) {
                    $paragraphs .= '<p>' . $line . '</p>';
                }
            }
            return $paragraphs;
        }
    }

    // Show date and time
    if(!function_exists('showDateTime')){
        function showDateTime($date){

            $time = $date;
            // 2 May 2023 at 15:42
            $date_format = 'F j, Y';
            $formatted_date = $date->format($date_format);
                
            $time_format = 'H:i';
            $formatted_time = $time->format($time_format);

            return $formatted_date.' at '.$formatted_time;
        }
    }