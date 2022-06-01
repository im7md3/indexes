<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProjectUserController extends Controller
{
    public function password($project)
    {
        $project = Project::findOrFail($project);
        $depart = $project->departments()->first();
        $cookie = Cookie::get('password' . $project->id);
        if ($cookie) {
            if ($depart) {
                return redirect()->route('show.project', [$project->id, $depart->id]);
                /* مشكلة هنا */
            } else {
                return redirect()->route('project.empty', $project->id);
            }
        }
        return view('front.projects.password', compact('project'));
    }

    public function confirm(Request $request, $project)
    {
        $project = Project::findOrFail($project);
        $depart = $project->departments()->first();
        if ($request->password == $project->password) {
            Cookie::queue('password' . $project->id, serialize($project), 60 * 24 * 30);
            if ($depart) {
                return redirect()->route('show.project', [$project->id, $depart->id]);
                /* مشكلة هنا */
            } else {
                return redirect()->route('project.empty', $project->id);
            }
        }
        return redirect()->back();
    }



    public function show($project, $department = null, $branch = null)
    {
        $settings=Setting::first();
        $project = Project::findOrFail($project);
        $department = Department::findOrFail($department);
        $cookie = Cookie::get('password' . $project->id);
        if ($cookie) {
            if ($branch == null) {
                $branch = Department::with(['project.departments', 'project.branches', 'comments','subBranches','files'])->findOrFail($department->id);
            } else {
                $branch = Department::findOrFail($branch);
                $branch = Department::with(['project.departments', 'project.branches', 'comments','subBranches','files'])->findOrFail($branch->id);
            }
            return view('front.projects.project', compact('branch','settings'));
        }
        return redirect()->route('project.password', $project->id);
    }
}
