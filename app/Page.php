<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
    	'apresentation',
    	'logoUrl',
    	'about',
        'aboutTitle',
    	'localization',
    	'contactPhone',
    	'contactEmail',
    	'serviceRowSize',
        'serviceRowQuantity',
        'localizationMapUrl'
    ];
}
