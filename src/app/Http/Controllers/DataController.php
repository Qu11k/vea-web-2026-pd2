<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    // Return top fighters
    public function getTopFighters(): JsonResponse
    {
        $fighters = Fighter::inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($fighters);
    }

    // Return selected fighter
    public function getFighter(Fighter $fighter): JsonResponse
    {
        return response()->json($fighter);
    }

    // Return related fighters
    public function getRelatedFighters(Fighter $fighter): JsonResponse
    {
        $fighters = Fighter::where('id', '<>', $fighter->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($fighters);
    }
}
