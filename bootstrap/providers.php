<?php

use App\Providers\AppServiceProvider;
use App\Providers\DataCiteServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\TypeScriptTransformerServiceProvider;

return [
    AppServiceProvider::class,
    TypeScriptTransformerServiceProvider::class,
    DataCiteServiceProvider::class,
    FortifyServiceProvider::class,
];
