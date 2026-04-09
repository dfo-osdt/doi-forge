<?php

use App\Providers\AppServiceProvider;
use App\Providers\DataCiteServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\HorizonServiceProvider;
use App\Providers\TypeScriptTransformerServiceProvider;
use Spatie\LaravelTypeScriptTransformer\TypeScriptTransformerServiceProvider as SpatieTypeScriptTransformerServiceProvider;

return [
    AppServiceProvider::class,
    DataCiteServiceProvider::class,
    FortifyServiceProvider::class,
    HorizonServiceProvider::class,
    SpatieTypeScriptTransformerServiceProvider::class,
    TypeScriptTransformerServiceProvider::class,
];
