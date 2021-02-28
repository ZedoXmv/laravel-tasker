@extends('layouts.tasker')
@section('content')
<div class="row justify-content-center">

  <div class="col-12 text-center mb-2">
    <span class="h1 me-2">Projects</span>
    <span><a href="{{route('projects.create')}}" class="btn btn-primary mb-2">New Project</a></span>
  </div>
  @if (session()->has('successmsg'))
  <div class="col-md-6 my-3">
    {!! session()->get('successmsg') !!}
  </div>
  @endif
  <div class='text-center mb-3'>
    <span><button disabled class="btn btn-primary"></button> - Pending</span>
    <span><button disabled class="btn btn-warning ms-3"></button> - Ongoing</span>
    <span><button disabled class="btn btn-success ms-3"></button> - Completed</span>
    <span><button disabled class="btn btn-danger ms-3"></button> - Cancelled</span>
  </div>

  <div class="col-md-10 m-auto">
    <table class="table table-bordered  table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>#</th>
          {{-- <th >Status</th> --}}
          <th>Title</th>
          {{-- <th class="col-md-3">Details</th> --}}
          <th class="col-md-2">Start Date</th>
          <th class="col-md-2">End Date</th>
          <th>Project Manager</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($projects as $project)
        <tr class="table-{{$project->color}}" onclick="window.location='{{route('projects.show',$project->id)}}'">
          <th>{{$project->id}}</th>
          {{-- <td>{{$project->status}}</td> --}}
          <td>{{$project->title}}</td>
          {{-- <td>{{ Str::limit($project->details, 50, '...') }}</td> --}}
          <td>{{ \Carbon\Carbon::parse($project->start_date)->format('jS-M-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($project->end_date)->format('jS-M-Y') }}</td>
          <td>{{ $project->ProjectManager->name }}</td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection