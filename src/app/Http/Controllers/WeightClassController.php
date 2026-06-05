<?php

namespace App\Http\Controllers;

use App\Models\WeightClass;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WeightClassController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function list(): View
    {
        $items = WeightClass::orderBy('name', 'asc')->get();
        return view('weightclass.list', [
            'title' => 'Weight Classes',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('weightclass.form', [
            'title' => 'Add Weight Class',
            'weightclass' => new WeightClass(),
        ]);
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $weightclass = new WeightClass();
        $weightclass->name = $validatedData['name'];
        $weightclass->save();

        return redirect('/weightclasses');
    }

    public function update(WeightClass $weightclass): View
    {
        return view('weightclass.form', [
            'title' => 'Edit Weight Class',
            'weightclass' => $weightclass,
        ]);
    }

    public function patch(WeightClass $weightclass, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $weightclass->name = $validatedData['name'];
        $weightclass->save();

        return redirect('/weightclasses');
    }

    public function delete(WeightClass $weightclass): RedirectResponse
    {
        $weightclass->delete();
        return redirect('/weightclasses');
    }
}
