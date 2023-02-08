<?php 

use Jenssegers\Blade\Blade;

if(!function_exists('view')){

    function view($view, $data = []){
        $path       =   APPPATH . 'views';
        $blade      =   new Blade($path, $path . '/cache');
        $data['CI'] =   get_instance();

        // custom directive
        $blade->compiler()->directive('test', function($any){
            return "Hai " . $any;
        });

        echo $blade->make($view, $data);
    }

}

?>