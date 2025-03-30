<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class OpenAIController extends Controller
{
    protected $openAIService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $text = $this->openAIService->generateText($request->input('prompt'));

        return response()->json(['generated_text' => $text]);
    }
}
