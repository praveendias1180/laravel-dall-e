<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show(Request $request): View
    {
        $prompt = $request->input('prompt');
        $n = $request->input('n', 2);
        $size = $request->input('size', '1024x1024');
        $image_urls = [];

        if ($prompt) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withToken(env('OPEN_AI_KEY'))->post('https://api.openai.com/v1/images/generations', [
                "prompt" => $prompt,
                "n" => (int) $n,
                "size" => $size
            ]);
            $data = $response->json()['data'];
            foreach ($data as $image) {
                $image_urls[] = $image['url'];
            }
        }


        return view('dalle.show', [
            'prompt' => $prompt,
            'n' => $n,
            'size' => $size,
            'image_urls' => $image_urls
        ]);
    }
}
