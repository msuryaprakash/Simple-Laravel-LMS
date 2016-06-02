<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

class CoursesController extends Controller
{
    /**
     * Show all courses
     */
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::all()
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    /**
     * Show course details and lessons
     * @param  Course $course
     */
    public function show(Course $course)
    {
        $course->load('lessons');

        return view('courses.show', [
            'course' => $course,
            'users' => \App\User::all()
        ]);
    }

    /**
     * Create a new course
     * @param  Request $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $course = new Course;
        $course->title = $request->title;
        $course->save();

        flash('Course added', 'success');

        return redirect()->route('courses');
    }

    public function update(Request $request, Course $course)
    {
        # code...
    }

    public function updateLecturers(Request $request, Course $course)
    {
        var_dump($request->all());
        foreach ($request->all() as $user_id => $checked) {
            echo $user_id;
        }
        // if ($request->ajax()) {
        //     return response()->json(['test' => 'yes']);
        // }

        // return back();
        // $user = \App\User::find($request->user_id);
        // if ($user->isLecturerIn($course)) {
        //     flash('User is already lecturer in this course', 'danger');
        //     return redirect()->route('course', [$course]);
        // } else {
        //     $course->addLecturer($request->user_id);
        // }

        // return back();
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return redirect()->route('home');
    }
}
