<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \Auth;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function confirm(Request $request, $id)
    {
        if (Auth::user()->hasRole(User::ROLE_TEACHER)) {
            User::findOrFail($id)->teachers()->updateExistingPivot(Auth::user()->id, ['confirmed' => true]);
            $response['error'] = false;
        } else {
            $response['error'] = true;
        }
        return $response;
    }

    public function decline(Request $request, $id)
    {
        if (Auth::user()->hasRole(User::ROLE_TEACHER)) {
            User::findOrFail($id)->teachers()->detach(Auth::user()->id);
            $response['error'] = false;
        } else {
            $response['error'] = true;
        }
        return $response;
    }

    public function addToGroup(Request $request)
    {
        if (Auth::user()->hasRole(User::ROLE_TEACHER)) {
            $this->validate($request, [
                'group_id' => 'required|exists:groups,id|unique:group_user,group_id,NULL,group_id,user_id,' . $request->get('student_id'),
                'student_id' => 'required|exists:users,id'
            ]);
            $user = User::find($request->get('student_id'));
            $user->groups()->attach($request->get('group_id'));
            $user->save();
            $response['error'] = false;
        } else {
            $response['error'] = true;
        }
        return $response;
    }

    public function getStudents(Request $request)
    {
        return [
            'result' => User::user()->
            join('teacher_student', 'student_id', '=', 'users.id')
                ->where('teacher_id', $request->get('teacher_id'))->select(['id', 'name'])->get()
        ];
    }

    public function searchStudents(Request $request)
    {
        return User::search($request->get('term'), $request->get('page'), false);
    }

    public function searchTeachers(Request $request)
    {
        return User::search($request->get('term'), $request->get('page'), true);
    }

    public function addTeacher(Request $request, $id)
    {
        if (Auth::user()->hasRole(User::ROLE_USER)) {
            $remainingRequests = Auth::user()->getRemainingRequests();
            if ($remainingRequests > 0) {
                $teacher = User::where('role', User::ROLE_TEACHER)->find($id);
                Auth::user()->teachers()->attach($teacher->id);
            }
            $response['remainingRequests'] = $remainingRequests - 1;
            $response['error'] = false;
        } else {
            $response['error'] = true;
        }
        return $response;
    }
}

