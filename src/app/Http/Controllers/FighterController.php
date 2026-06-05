<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FighterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        /**
* Get the middleware that should be assigned to the controller.
*/

        return [
            new Middleware('auth'),
        ];
    }
    public function list(): View
    {
        $items = Fighter::orderBy('name', 'asc')->get();

        return view(
            'fighter.list',
            [
                'title' => 'Fighters',
                'items' => $items,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'fighter.form',
            [
                'title' => 'Add a fighter',
                'fighter' => new Fighter()
            ]
        );
    }

    // create new fighter
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $fighter = new Fighter();
        $fighter->name = $validatedData['name'];
        $fighter->save();

        return redirect('/fighters');
    }

    // display fighter editing form
    public function update(Fighter $fighter): View
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
    public function patch(Fighter $fighter, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $fighter->name = $validatedData['name'];
        $fighter->save();

        return redirect('/fighters');
    }

    // delete fighter
    public function delete(Fighter $fighter): RedirectResponse
    {
        $fighter->delete();
        return redirect('/fighters');
    }
}
