<?php

namespace App\Http\Controllers;

use App\Models\RepairJob;
use App\Models\Customer;
use Illuminate\Http\Request;

class RepairJobController extends Controller
{
    public function index()
    {
        $repairJobs = RepairJob::with('customer')->get();
        return view('repair_jobs.index', [
            'repairJobs' => $repairJobs,
            'title' => 'Repair Jobs',
            'resourceName' => 'repair_jobs'
        ]);
    }

    public function create()
    {
        return view('repair_jobs.create', [
            'title' => 'Create Repair Job',
            'resourceName' => 'repair_jobs',
            'customers' => Customer::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'device_type' => 'required|string|max:255',
            'device_brand' => 'required|string|max:255',
            'issue_description' => 'required|string|max:1000',
            'status' => 'required|string|in:pending,in_progress,awaiting_parts,completed,cancelled',
            'repair_date' => 'required|date',
            'completion_date' => 'nullable|date',
            'total_cost' => 'required|numeric',
        ]);

        // Store the repair job
        RepairJob::create($validated);

        // Redirect to the index route
        return redirect()->route('repair-jobs.index')->with('success', 'Repair Job Created Successfully!');
    }

    public function edit(RepairJob $repairJob)
    {
        return view('repair_jobs.edit', [
            'repairJob' => $repairJob,
            'title' => 'Edit Repair Job',
            'resourceName' => 'repair_jobs',
            'customers' => Customer::all()
        ]);
    }
    public function show(RepairJob $repairJob)
    {
        return view('repair_jobs.show', [
            'repairJob' => $repairJob,
            'title' => 'Repair Job Details',
            'customers' => Customer::all()
        ]);
    }

// app/Http/Controllers/RepairJobController.php

public function update(Request $request, RepairJob $repairJob)
{
    // Validate incoming request data
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'device_type' => 'required|string|max:255',
        'device_brand' => 'required|string|max:255', // Make device brand required
        'issue_description' => 'required|string|max:1000', // Make issue description required
        'status' => 'required|string|in:pending,in_progress,awaiting_parts,completed,cancelled',
        'repair_date' => 'required|date',
        'completion_date' => 'nullable|date',
        'total_cost' => 'required|numeric', // Make total cost required
    ]);
    
    // Update the repair job with the validated data
    $repairJob->update($validated);
    
    // Redirect after update
    return redirect()->route('repair-jobs.index')->with('success', 'Repair job updated successfully.');
}


    public function destroy(RepairJob $repairJob)
    {
        $repairJob->delete();
        return redirect()->route('repair-jobs.index')->with('success', 'Repair job deleted successfully.');
    }
}
