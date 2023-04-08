<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
class OpenAIImageController extends Controller
{
    public function process(Request $request)
    {
        $response = OpenAI::images()->create([
            'prompt' => $request->prompt,
            'n' => 1,
            'size' => $request->size,
            'response_format' => 'url',
        ]);
        
        return $response->toArray();
    }
}
