<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmailJob;

class MessegerController extends Controller {
    

    public function mailtest(){
       
        $details ['email']='el3esrojo@gmail.com';
        dispatch(new SendEmailJob($details));
        echo "Email enviado";
    
        
    }
}

