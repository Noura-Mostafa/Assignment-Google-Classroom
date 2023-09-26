<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\ClassworkUser;

class GradingController extends Controller
{
    public function index(Classwork $classwork)
    {
        $submissions = $classwork->submissions;

        // $submitted = ClassworkUser::where('status', 'submitted')->get();
        return view('classworks.grade.index', [
            'submissions' => $submissions,
            // 'submitted' => $submitted,
            'classwork' => new Classwork(),
        ]);
    }




    // public function update(Request $request, ClassworkUser $submission)
    // {
    //     $request->validate([
    //         'grade' => 'required|numeric|min:0|max:100',
    //     ]);

    //     // Update the 'grade' field in the pivot table 'ClassworkUser'
    //     $submission->update([
    //         'grade' => $request->input('grade'),
    //         'status' => 'graded',
    //     ]);

    //     return redirect()->route('submissions.grade.index')->with([
    //         'success' => 'Grade updated successfully',
    //         'submission' => $submission
    //     ]);
    // }
}
