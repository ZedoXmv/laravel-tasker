@extends('layouts.tasker')
@section('content')

{{-- <div class="text-center mb-sm-1 display-5">{{$project->title}}</div> --}}
<div class="row justify-content-center">
  
  <div class="col-10 mb-sm-4">
    <div class="text-center">
      <div class="h4 row">
        <div class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('projects.index')}}" class="text-dark" >Projects</a></li>
          <li class="breadcrumb-item active text-{{$project->color}}" style="-webkit-text-stroke: 0.5px black">{{$project->title}}</li>
          <div class="ms-auto"><a href="{{route('projects.edit',$project->id)}}" class="btn btn-outline-primary">Edit</a></div>
          {{-- <div class="ms-1"><a href="{{route('projects.edit',$project->id)}}" class="btn btn-outline-danger">Delete</a></div> --}}
          <div class="ms-1">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
              Delete
            </button>
          </div>
        </div>

      </div>
      {{-- <div class="h3">#{{$project->id}}</div>
      <div class="mb-1">
        <span><a href="{{route('projects.edit',$project->id)}}" class="btn btn-outline-primary">Edit Project</a></span>
      </div> --}}
      <h1 class="mb-3">{{$project->title}} <span class="h3 text-muted">#{{$project->id}}</span></h1>
      <div class="h5 mb-2"><strong>Project Manager:</strong> {{$project->projectManager->name}}</div>
      <button disabled class="btn btn-{{$project->color}} mb-3">{{Str::ucfirst($project->status)}}</button>
  
      <div class="mb-4 h5 d-md-flex">
          <div class="col-12 col-md-4 mb-2"><strong>Start Date:</strong>  <div>{{ \Carbon\Carbon::parse($project->start_date)->format('l jS F Y') }}</div></div>
          <div class="mb-2 mb-md-4 col-12 col-md-4">
            @if ($project->remaining_days)  
              @if ($project->remaining_days > 0)
                <strong>Days Remaining:</strong>
                <div>{{$project->remaining_days}}</div>                
              @else
                <div>{{abs($project->remaining_days)}} <strong>Days Overdue</strong></div>                
              @endif
            @endif
          </div>
          <div class="col-12 col-md-5 mb-4"><strong>End Date:</strong> <div>{{ \Carbon\Carbon::parse($project->end_date)->format('l jS F Y') }}</div></div>
      </div>

      <div>
        <p class="fs-5">{{$project->details}}</p>
      </div>
    </div>
  </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteConfirm" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure that you want to delete <strong>{{$project->title}}</strong>? This action will be permanent and cannot be undone!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{route('projects.destroy',$project->id)}}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
