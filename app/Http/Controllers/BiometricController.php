<?php

namespace App\Http\Controllers;

use App\Models\Biometric;
use Illuminate\Http\Request;

class BiometricController extends Controller
{
    public function index()
    {
        $biometrics = Biometric::orderBy('measured_at')->get();

        return view('biometrics.index', [
            'biometrics' => $biometrics,
        ]);
    }

    public function create()
    {
        return view('biometrics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'measured_at' => ['required', 'date'],
            'weight_kg' => ['nullable', 'numeric'],
            'bp_systolic' => ['nullable', 'integer'],
            'bp_diastolic' => ['nullable', 'integer'],
        ]);

        Biometric::create($validated);

        return redirect()
            ->route('biometrics.index')
            ->with('success', 'Biometric entry saved.');
    }

    public function destroy(Biometric $biometric)
    {
        $biometric->delete();

        return redirect()
            ->route('biometrics.index')
            ->with('success', 'Biometric entry deleted.');
    }
}
