<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\WorkerPortfolio;

class WorkerPortfolioController extends Controller
{
    // Show all portfolios for logged-in worker
    public function index()
    {
        $userId = session('user')->id;
        $portfolios = WorkerPortfolio::where('user_id', $userId)->get();
        return view('site.seller.portfolio', compact('portfolios'));
    }

    // Show form to create portfolio
    public function store(Request $request)
    {
        $user = session('user');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $portfolio = new WorkerPortfolio();
        $portfolio->user_id = $user->id;
        $portfolio->title = $validated['title'];
        $portfolio->description = $validated['description'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/portfolio'), $filename);
            $portfolio->image = 'uploads/portfolio/' . $filename;
        }

        // Generate slug using title + random string
        $slugBase = Str::slug($validated['title']);
        $portfolio->slug = $slugBase . '-' . Str::random(6); // e.g., my-project-a1b2c3

        $portfolio->save();

        return back();
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $portfolio = WorkerPortfolio::findOrFail($id);
        $portfolio->title = $validated['title'];
        $portfolio->description = $validated['description'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/portfolio'), $filename);
            $portfolio->image = 'uploads/portfolio/' . $filename;
        }

        $portfolio->save();

        return redirect()->back()->with('success', 'Portfolio updated successfully.');
    }

    // Delete a portfolio
    public function destroy($id)
    {
        $portfolio = WorkerPortfolio::findOrFail($id);

        // Delete image if exists
        if ($portfolio->image && File::exists(public_path($portfolio->image))) {
            File::delete(public_path($portfolio->image));
        }

        $portfolio->delete();

        return back()->with('success', 'Portfolio deleted.');
    }
}
