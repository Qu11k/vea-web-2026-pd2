<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FighterController extends Controller
{
    // display all fighters
    public function list(): View
    {
        $items = Fighter::orderBy('Id', 'asc')->get();

        return view(
            'fighter.list',
            [
                'title' => 'Fighters',
                'items' => $items,
            ]
        );
    }
    // display new fighter form
    public function create(): View
    {
        return view(
            'fighter.form',
            [
                'title' => 'Add a fighter',
                "fighter" => new fighter()
            ]
        );
    }
    // create new fighter
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $fighter = new fighter();
        $fighter->name = $validatedData['name'];
        $fighter->save();

        return redirect('/fighters');
    }
    // display fighter editing form
    public function update(fighter $fighter): View
    {
        return view(
            'fighter.form',
            [
                'title' => 'Edit fighter',
                'fighter' => $fighter
            ]
        );
    }
    // update existing fighter data
    public function patch(fighter $fighter, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $fighter->name = $validatedData['name'];
        $fighter->save();

        return redirect('/fighters');
    }
    public function delete(fighter $fighter): RedirectResponse
    {
        // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
        $fighter->delete();
        return redirect('/fighters');
    }
}
