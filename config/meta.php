<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Meta data information
    |--------------------------------------------------------------------------
    |
    | These values are the default value to be used for the meta elements in
    | the page <HEAD> tags.They can be overwritten by defining the 'meta' 
    | variable in the relevant controller and ensuring the variable is carried 
    | over to the layout component using <x-layout :meta="$meta">
    |
    */

    
    'title' => config('app.name').' | Gripping news | A jar of humour',
    'description' => 'Open news topics on whatever I want to talk about. You can read some of this shit if you like.',
    'keywords' => 'news, news articles',

    

];
