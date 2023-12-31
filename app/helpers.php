<?php

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


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
    

    // Truncate
    if(!function_exists('truncate')){
        function truncate($str, $limit = 45) {
            return Str::limit($str, $limit);
        }
    }

    // Show date and time
    if(!function_exists('showDateTime')){
        function showDateTime($date, $format = null){

            $time = $date;
            // 2 May 2023 at 15:42
            $date_format = 'F j, Y';
            if($format == 'short'){
                $date_format = 'd/m/y';
            }
            
            $formatted_date = $date->format($date_format);
                
            $time_format = 'H:i';
            $formatted_time = $time->format($time_format);

            return $formatted_date.' at '.$formatted_time;
        }
    }

    // Show colored status
    if(!function_exists('showColoredStatus')){
        function showColoredStatus(string $status){

            switch ($status){
              case "public":
                $text_color = 'text-green-600';
                break;
              case "private":
                $text_color = 'text-red-600';
                break;
              default:
                $text_color = 'text-gray-600';
            }

            return '<span class="'.$text_color.'"><i class="fa-solid fa-lock mr-2"></i>'.ucfirst($status).'</span>';
        }
    }





    // Check if logged in user car edit an article
    if(!function_exists('verifyPermissions')){
        function verifyPermissions($item = null, $user = null){

            if(!auth()->user()){
                return false;
            }
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




    if(!function_exists('randomHex')){
        function randomHex(){
            return Str::random(11);
        }
    }

    if(!function_exists('pagniationLinks')){
        function paginationLinks($results){
            if($results instanceof \Illuminate\Pagination\AbstractPaginator)
                return $results->links();
            return false;
        }
    }



    if(!function_exists('controllerMethod')){
        function controllerMethod(){
            $route_array = app('request')->route()->getAction();
            return class_basename($route_array['controller']);
        }
    }

    if(!function_exists('getMetadata')){
        function getMetadata(string $element = null){

            // Default metadata
            $metadata = [
                'title' => config('app.meta.title'),
                'description' => config('app.meta.description'),
                'keywords' => config('app.meta.keywords')
            ];
            
            // SiteController
            $controller = 'SiteController';
            if(controllerMethod() === $controller.'@index')
                $metadata = $metadata;
            
            if(controllerMethod() === $controller.'@viewContact')
                $metadata['title'] = 'Contact us | '.config('app.meta.suffix');
            
            if(controllerMethod() === $controller.'@viewTerms')
                $metadata['title'] = 'Terms & conditions | '.config('app.meta.suffix');

            if(controllerMethod() === $controller.'@viewPrivacy')
                $metadata['title'] = 'Privacy policy | '.config('app.meta.suffix');
            
            // ArticleController
            $controller = 'ArticleController';
            if(controllerMethod() === $controller.'@index')
                $metadata['title'] = 'Latest news | '.config('app.meta.suffix');

            if(controllerMethod() === $controller.'@show'){
                $article = app('request')->route('article');
                $metadata['title'] = $article->title.' | '.config('app.meta.suffix');
                $metadata['description'] = strip_tags(truncate($article->body, 200));
            }

            if(controllerMethod() === $controller.'@indexSearchResults')
                $metadata['title'] = 'Search results on '.config('app.name').' | '.config('app.meta.suffix');
        
            // Userontroller
            $controller = 'UserController';
            if(controllerMethod() === $controller.'@viewLoginForm')
            $metadata['title'] = 'Login | '.config('app.meta.suffix');

            if(controllerMethod() === $controller.'@viewRegistrationForm')
                $metadata['title'] = 'Register for an account | '.config('app.meta.suffix');

            return $metadata[$element];
        }
    };

    if(!function_exists('pageHeadings')){
        function pageHeadings(string $main = null, string $sub = null){
            return [
                'main' => $main,
                'sub' => $sub
            ];
        }
    };
    