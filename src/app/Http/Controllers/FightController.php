<?php

namespace App\Http\Controllers;

use App\Models\Fight;
use App\Models\Fighter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FightController extends Controller implements HasMiddleware
{
    //  middleware
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // Display all fights
    public function list(): View
    {
        $items = Fight::orderBy('fight_date', 'desc')->get();

        return view('fight.list', [
            'title' => 'Fights',
            'items' => $items,
        ]);
    }

    // Display new fight
    public function create(): View
    {
        $fighters = Fighter::orderBy('name', 'asc')->get();

        return view('fight.form', [
            'title' => 'Add a Fight',
            'fight' => new Fight(),
            'fighters' => $fighters,
        ]);
    }
private function saveFightData(Fight $fight, Request $request): void
{
    $validatedData = $request->validate([
        'fighter_id' => 'required|exists:fighters,id',
        'opponent' => 'required|string|max:256',
        'result' => 'required|string|max:50',
        'method' => 'required|string|max:100',
        'fight_date' => 'required|date',
        'event' => 'required|string|max:256',
        'display' => 'nullable',
        'image' => 'nullable|image',
    ]);

    $fight->fighter_id = $validatedData['fighter_id'];
    $fight->opponent = $validatedData['opponent'];
    $fight->result = $validatedData['result'];
    $fight->method = $validatedData['method'];
    $fight->fight_date = $validatedData['fight_date'];
    $fight->event = $validatedData['event'];
    $fight->display = (bool) ($validatedData['display'] ?? false);

    if ($request->hasFile('image')) {
        $uploadedFile = $request->file('image');
        $extension = $uploadedFile->clientExtension();
        $name = uniqid();
        $fight->image = $uploadedFile->storePubliclyAs('/', $name . '.' . $extension, 'uploads');
    }

    $fight->save();
}
    public function put(Request $request): RedirectResponse
{
    $fight = new Fight();
    $this->saveFightData($fight, $request);
    return redirect('/fights');
}

    // Display fight 
    public function update(Fight $fight): View
    {
        $fighters = Fighter::orderBy('name', 'asc')->get();

        return view('fight.form', [
            'title' => 'Edit Fight',
            'fight' => $fight,
            'fighters' => $fighters,
        ]);
    }

    // Update existing fight data
    public function patch(Fight $fight, Request $request): RedirectResponse
{
    $this->saveFightData($fight, $request);
    return redirect('/fights');
}

    // Delete fight
    public function delete(Fight $fight): RedirectResponse
    {
        $fight->delete();
        return redirect('/fights');
    }
}
