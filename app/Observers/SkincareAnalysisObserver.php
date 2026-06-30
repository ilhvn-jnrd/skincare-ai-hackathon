<?php

namespace App\Observers;

use App\Models\SkincareAnalysis;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SkincareAnalysisObserver
{
    public function creating(SkincareAnalysis $skincareAnalysis): void
    {
        $apiKey = env('GEMINI_API_KEY');
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;

        $prompt = "Bertindaklah sebagai ahli kimia kosmetik dan dermatolog. Pengguna memasukkan rutinitas atau produk skincare berikut: '" . $skincareAnalysis->product_names . "'. 
        Tugas Anda: 
        1. Identifikasi bahan aktif utama dari produk-produk tersebut jika memungkinkan.
        2. Evaluasi apakah produk/bahan tersebut aman digunakan bersamaan (terutama terkait iritasi atau sensitivitas matahari).
        3. Berikan kesimpulan singkat dan rekomendasi jadwal pemakaian (pagi/malam).
        Gunakan bahasa Indonesia yang profesional namun mudah dipahami.";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt]]]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $aiText = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Gagal mendapatkan analisis yang relevan.';
                $skincareAnalysis->ai_response = $aiText;
            } else {
                $skincareAnalysis->ai_response = "Error dari API Google: " . $response->body();
            }
        } catch (\Exception $e) {
            $skincareAnalysis->ai_response = "Terjadi kesalahan sistem: " . $e->getMessage();
            Log::error("Gemini API Error: " . $e->getMessage());
        }
    }
}