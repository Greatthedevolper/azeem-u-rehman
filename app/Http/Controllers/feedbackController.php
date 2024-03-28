<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class FeedbackController extends Controller
{
    public function CreateFeedback()
    {
        return Inertia::render('Feedback');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'userName' => 'required|min:3|max:20',
        ]);

        Feedback::create($request->all());

        // Redirect to dashboard after successful submission
        return redirect()->route('dashboard')->with('success', 'Feedback submitted successfully.');
    }

    public function FeedbackAll()
    {
        $feedbacks = Feedback::paginate(4);
        return Inertia::render('Dashboard', [
            'feedbacks' => $feedbacks,
        ]);
    }

    public function Liked(Request $request)
    {
        // Assuming you have a Feedback model and a 'likes' column
        $feedback = Feedback::find($request->id);
        $feedback->likes += 1;
        $feedback->save();

        return Inertia::location(route('dashboard'));
    }

    public function Comments(Request $request)
    {
        $feedback = Feedback::find($request->id);

        if ($feedback) {
            // Get the existing comments as an array
            $comments = $feedback->comments ?: [];

            // Add the new comment to the array
            $comments[] = $request->comment;

            // Update the comments column with the updated array
            $feedback->comments = $comments;

            // Save the feedback
            $feedback->save();

            return Inertia::render('Dashboard', ['message' => 'Comment added successfully']);
        } else {
            return Inertia::render('Dashboard', ['error' => 'Feedback not found']);
        }
    }

}
