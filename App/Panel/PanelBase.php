<?php

namespace App\Panel; #auto

use Mmb\Controller\Controller;

class PanelBase extends Controller
{

    public function boot()
    {
        parent::boot();
        $this->needTo('access_panel');
    }
    
}
