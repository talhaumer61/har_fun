<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobProposal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ProposalController extends Controller
{

    public function store(Request $request)
    {
        // dd($request);
        // Ensure only worker (login_type = 3) can apply
        if (!session('user') || session('user')->login_type != 3) {
            abort(403, 'Unauthorized action.');
        }

        // Validate input
        $request->validate([
            'job_id' => 'required|exists:hf_jobs,job_id',
            'bid_amount' => 'required|numeric|min:1',
            'cover_letter' => 'required|string|max:5000',
            'attachment' => 'nullable|file|max:2048|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        $workerId = session('user')->id;

        // Check if the user already applied to this job
        $existing = JobProposal::where('job_id', $request->job_id)
            ->where('worker_id', $workerId)
            ->where('is_deleted', false)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already submitted a proposal for this job.');
        }

        // Handle file upload if present
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filename = time() . '_' . $attachment->getClientOriginalName();
            $destination = public_path('uploads/job_proposals');
            $attachment->move($destination, $filename);

            $attachmentPath = 'uploads/job_proposals/' . $filename;
        }

        // Store the proposal
        JobProposal::create([
            'job_id' => $request->job_id,
            'worker_id' => $workerId,
            'bid_amount' => $request->bid_amount,
            'cover_letter' => $request->cover_letter,
            'attachment' => $attachmentPath,
            'status' => 2, // Pending
            'id_added' => $workerId,
            'date_added' => now(),
        ]);

        
        return back()->with('success', 'Your proposal has been submitted successfully!');
    }


}
