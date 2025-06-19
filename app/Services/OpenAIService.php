<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected string $apiKey;
    protected string $model;
    protected float $temperature;

    public function __construct(?string $apiKey = null, string $model = 'gpt-3.5-turbo', float $temperature = 0.7)
    {
        $this->apiKey = $apiKey ?? env('OPENAI_API_KEY');
        $this->model = $model;
        $this->temperature = $temperature;
    }

    public function generateContent(string $prompt): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => $this->temperature,
            ]);

            if (!$response->successful()) {
                Log::error('OpenAI API Error', ['response' => $response->body()]);
                return 'فشل في توليد المحتوى (خطأ في الاتصال بالخدمة).';
            }

            $result = $response->json();
            return $result['choices'][0]['message']['content'] ?? 'فشل في توليد المحتوى.';
        } catch (\Exception $e) {
            Log::error('OpenAI Exception', ['error' => $e->getMessage()]);
            return 'حدث خطأ غير متوقع أثناء توليد المحتوى.';
        }
    }
}