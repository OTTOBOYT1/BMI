<?php

namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BmiController extends Controller
{
    public function index()
    {
        $latest = BmiRecord::latest()->take(10)->get();
        return view('bmi.index', compact('latest'));
    }

    public function calculate(Request $request)
    {
        $data = $request->validate([
            'height_cm' => ['required', 'numeric', 'min:10', 'max:250'],
            'weight_kg' => ['required', 'numeric', 'min:10', 'max:600'],
        ]);

        $heightM = $data['height_cm'] / 100;
        $bmi = $data['weight_kg'] / ($heightM * $heightM);
        $bmi = round($bmi, 1);
        if ($bmi < 18.5) $category = 'Underweight';
        elseif ($bmi < 25) $category = 'Normal';
        elseif ($bmi < 30) $category = 'Overweight';
        else $category = 'Obesity';
        $record = BmiRecord::create([
            'user_id'   => Auth::check() ? Auth::id() : null,
            'height_cm' => $data['height_cm'],
            'weight_kg' => $data['weight_kg'],
            'bmi'       => $bmi,
            'category'  => $category,
        ]);

        return view('bmi.result', compact('record'));
    }
}
