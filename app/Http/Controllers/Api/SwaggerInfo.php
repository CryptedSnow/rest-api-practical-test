<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'Places API',
    version: '1.0.0',
    description: 'API REST to manage places'
)]
#[OA\Server(
    url: 'http://localhost:8000/api',
    description: 'Local server (Docker)'
)]
class SwaggerInfo {}
