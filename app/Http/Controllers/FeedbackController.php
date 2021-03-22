<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function _construct()
    {
        return $this->middleware('auth');
    }

    public function addFeedback(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'feedback' => 'required|min:3|max:255'
        ]);

        $fb = new Feedback();
        $fb->ticket_id = $request->ticketID;
        $fb->level = $request->level;
        $fb->feedback = $request->feedback;
        $fb->given_by = auth()->user()->id;
        $fb->given_to = $request->SupEngID;
        $fb->save();
        session()->flash('message', 'Feedback successfully added.');
        return redirect()->route('tickets.show', $request->ticketID);
    }
}
