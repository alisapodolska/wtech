<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('test'); // Renders test.blade.php
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|json',
        ]);

        // Parse answers
        $answers = json_decode($request->input('answers'), true);
        if (!$answers || !is_array($answers)) {
            return redirect()->back()->with('error', 'Invalid answers provided.');
        }

        // Define answer-to-fragrance mapping
        $fragranceMapping = [
            'question1' => [
                'ATLANTIC COAST' => 'ATLANTIC COAST',
                'LOST GARDEN' => 'LOST GARDEN',
                'GRASSLAND' => 'GRASSLAND',
                'WOODLAND' => 'WOODLAND',
                'HERB GARDEN' => 'HERB GARDEN',
            ],
            'question2' => [
                'Elegant and sophisticated' => 'LOST GARDEN', // Rose, floral elegance
                'Playful and energetic' => 'ATLANTIC COAST', // Citrus, vibrant
                'Calm and grounded' => 'WOODLAND', // Earthy, woody
                'Confident and bold' => 'GRASSLAND', // Fresh, orchid
                'Fresh and herbal' => 'HERB GARDEN', // Lavender, mint
            ],
            'question3' => [
                'Morning' => 'ATLANTIC COAST', // Fresh, citrus dawn
                'Afternoon' => 'GRASSLAND', // Light, summery
                'Evening' => 'LOST GARDEN', // Soft, rosy dusk
                'Night' => 'WOODLAND', // Deep, earthy
                'Anytime' => 'HERB GARDEN', // Versatile, herbal
            ],
            'question4' => [
                'A formal dinner or event' => 'LOST GARDEN', // Elegant, floral
                'A day out with friends' => 'ATLANTIC COAST', // Lively, citrus
                'A cozy evening at home' => 'WOODLAND', // Warm, woody
                'A night out on the town' => 'GRASSLAND', // Fresh, bold
                'A quiet garden retreat' => 'HERB GARDEN', // Soothing, herbal
            ],
            'question5' => [
                'Through classic style' => 'LOST GARDEN', // Timeless, rose
                'Through vibrant colors and fun accessories' => 'ATLANTIC COAST', // Bright, citrus
                'Through simplicity and nature-inspired looks' => 'WOODLAND', // Natural, earthy
                'Through daring fashion choices and unique statements' => 'GRASSLAND', // Distinctive, orchid
                'Through fresh and natural scents' => 'HERB GARDEN', // Clean, herbal
            ],
        ];

        // Calculate scores
        $scores = [
            'ATLANTIC COAST' => 0,
            'LOST GARDEN' => 0,
            'GRASSLAND' => 0,
            'WOODLAND' => 0,
            'HERB GARDEN' => 0,
        ];

        foreach ($answers as $question => $answer) {
            if (isset($fragranceMapping[$question][$answer])) {
                $fragrance = $fragranceMapping[$question][$answer];
                $scores[$fragrance]++;
            }
        }

        // Determine dominant fragrance
        $dominantFragrance = array_search(max($scores), $scores);
        if ($scores[$dominantFragrance] === 0) {
            // Fallback to question1 if no clear winner
            $dominantFragrance = $fragranceMapping['question1'][$answers['question1']] ?? 'LOST GARDEN';
        }

        // Select one product (Eau de Parfum or Eau de Toilette)
        $product = Product::where('scent', $dominantFragrance)
            ->whereIn('type', ['Eau de Parfum', 'Eau de Toilette'])
            ->inRandomOrder()
            ->first();

        return redirect()->route('product-desc', $product->id);
    }
}