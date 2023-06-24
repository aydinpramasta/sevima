<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class RoadmapMakerController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate(['search' => ['required', 'string']]);

        $prompt = <<<PROMPT
Buatkan daftar materi yang harus dipelajari tentang `{$data['search']}`.
Berikan output berupa list, tanpa ada teks penjelasan awal dan akhir.
PROMPT;

        try {
            $result = OpenAI::completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 999,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        $formatted_result = preg_split('/\n/', trim($result['choices'][0]['text']));

        return response()->json([
            'status' => 'success',
            'data' => ['result' => $formatted_result],
        ]);
    }
}
