<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectEditRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('ProjectManager')->paginate();
        foreach ($projects as $project) {
            switch ($project->status) {
                case 'pending':
                    $project->color = 'primary';
                    break;
                case 'ongoing':
                    $project->color = 'warning';
                    break;
                case 'completed':
                    $project->color = 'success';
                    break;
                case 'cancelled':
                    $project->color = 'danger';
                    break;
            }
        }
        return view('projects.index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectManagers = User::all();
        return view('projects.create')->with('projectManagers',$projectManagers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create([
            'title' => $request->title,
            'details' => $request->details,
            'status' => $request->status,
            'project_manager_id' => $request->project_manager_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('projects.index')->with('successmsg', '<div class="alert alert-success"><strong>' . $project->title . '</strong> created successfully</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);


        if ($project) {
            $now = Carbon::now();
            // $currentDay = Carbon::parse(($now->gt($project->start_date)) ? $now->toDateString() : $project->start_date);
            $currentDay = Carbon::parse($now->toDateString());
            switch ($project->status) {
                case 'pending':
                    $project->color = 'primary';
                    $project->remaining_days = $currentDay->diffInDays($project->end_date,false);
                    break;
                case 'ongoing':
                    $project->color = 'warning';
                    $project->remaining_days = $currentDay->diffInDays($project->end_date,false);
                    break;
                case 'completed':
                    $project->color = 'success';
                    break;
                case 'cancelled':
                    $project->color = 'danger';
                    break;
            }
            return view('projects.show')->with('project', $project);
        }
        return redirect()->route('projects.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if ($project) {
            $projectManagers = User::all();
            return view('projects.edit', compact('project','projectManagers'));
        }
        return redirect()->route('projects.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $id)
    {
        $project = Project::find($id);
        $project->fill([
            'title' => $request->title,
            'details' => $request->details,
            'status' => $request->status,
            'project_manager_id' => $request->project_manager_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $project->save();
        return redirect()->route('projects.index')->with('successmsg','<div class="alert alert-warning"><strong>'.$project->title.'</strong> updated successfully</div>');
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        Project::destroy($id);
        return redirect()->route('projects.index')->with('successmsg','<div class="alert alert-danger"><strong>'.$project->title.'</strong> Deleted successfully</div>');
    }
}
