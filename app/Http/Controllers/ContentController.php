<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function index()
    {
        return Inertia::render('Content/Index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'topic' => 'required|string',
            'type' => 'required|string',
        ]);

        $type = $request->type;
        $topic = $request->topic;

        $prompt = match($type) {
            'مقال' => "اكتب مقالًا احترافيًا باللغة العربية عن \"{$topic}\". اجعله منسقًا بفقرات، وابدأ بمقدمة تعريفية، ثم تناول النقاط الأساسية، وانهِ بخاتمة. استخدم لغة واضحة وشيقة.",

            'منشور إنستغرام' => "اكتب منشورًا جذابًا ومختصرًا لمنصة إنستغرام عن \"{$topic}\". اجعله مشوقًا ويتضمن إيموجي، ونبرة تحفيزية. يمكن إنهاؤه بسؤال تفاعلي.",

            'وصف منتج' => "اكتب وصفًا احترافيًا وجذابًا لمنتج بعنوان \"{$topic}\". اذكر أهم المزايا، ولماذا يجب على العميل شراؤه، بلغة تسويقية جذابة وسهلة.",

            default => "اكتب محتوى عن \"{$topic}\" بأسلوب بسيط وواضح.",
        };

        try {
            $content = $this->openAIService->generateContent($prompt);
        } catch (\Exception $e) {
            Log::error('OpenAI Error', ['error' => $e->getMessage()]);
            $content = 'حدث خطأ أثناء توليد المحتوى.';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'generatedContent' => $content,
                'topic' => $request->topic,
                'type' => $request->type,
            ]);
        }

        return Inertia::render('Content/Index', [
            'generatedContent' => $content,
            'topic' => $request->topic,
            'type' => $request->type,
        ]);
    }
}

