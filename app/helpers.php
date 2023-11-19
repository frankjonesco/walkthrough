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


    // Check if logged in user car edit an article
    if(!function_exists('verifyPermissions')){
        function verifyPermissions($item = null, $user = null){
            // Set user to logged in user if not specified
            if($user === null){
                $user = auth()->user();
            }
            // Check if we are checking permission for a model
            if($item === null){
                if($user->user_type_id >= 2){

                    return true;
                }
            }
            if($item){
                // If user type pulisher or above
                if($user->user_type_id >= 2){
                    // If this user owns item return true
                    if($user->id === $item->user_id){
                        return true;
                    }
                    // If user type admin or above
                    if($user->user_type_id >= 3){
                        return true;
                    }
                    // Die
                    return false;
                }
            }
            // Die
            return false;
        }
    }