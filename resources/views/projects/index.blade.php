@extends('layouts.tasker')
@section('content')
<div class="col-12 my-3">
  <span class="h1 mr-3">Projects</span>
  <span><a href="{{route('projects.create')}}" class="btn btn-primary mb-2">New Project</a></span>
</div>
<table class="table table-bordered align-middle">
  <thead class="table-dark text-center">
    <tr>
      <th>#</th>
      <th>Status</th>
      <th>Title</th>
      <th class="col-md-2">Details</th>
      <th>Project Manager</th>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($projects as $project)
        
    <tr>
      <th>{{$project->id}}</th>
      <td>{{$project->status}}</td>
      <td>{{$project->title}}</td>
      <td>{{ Str::limit($project->details, 100, '...') }}</td>
      <td>{{ $project->ProjectManager->name }}</td>
      <td>{{ \Carbon\Carbon::parse($project->start_date)->format('jS-M-Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($project->end_date)->format('jS-M-Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection