@extends('layouts.tasker')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="display-5 mb-sm-3 text-center">Edit existing Project</div>
    <form action="{{route('projects.update',$project->id)}}" method="POST">
      @method('PUT')
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="title" value="{{$project->title}}" required>
        <label for="title">Title</label>
        @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control" name="details" id="details" placeholder="details" style="height: 120px"required>{{$project->details}}</textarea>
        <label for="details">Project Details</label>
      </div>
      <div class="row mb-3">
        <div class="form-floating col-6">
          <select name="status" id="status" class="form-control">
            <option value="pending" @if($project->status === 'pending') selected @endif>Pending</option>
            <option value="ongoing" @if($project->status === 'ongoing') selected @endif>On Going</option>
            <option value="completed" @if($project->status === 'completed') selected @endif>Completed</option>
            <option value="cancelled" @if($project->status === 'cancelled') selected @endif>Cancelled</option>
          </select>
          <label for="status">Choose Status</label>
        </div>
        <div class="form-floating col-6">
          <select class="form-control" name="project_manager_id" id="project_manager" required>
            {{-- <option selected>Open Manager List</option> --}}
            @foreach ($projectManagers as $projectManager)
            <option value="{{$projectManager->id}}" @if($project->project_manager_id === $projectManager->id) selected @endif>{{$projectManager->name}}</option>
            @endforeach
          </select>
          <label for="project_manager">Select Project Manager</label>
        </div>
      </div>

      <div class="row mb-3">
        <div class="form-floating col-6">
          <input class="form-control" type="date" name="start_date" id="start_date" value="{{$project->start_date}}" required>
          <label for="start_date">Start Date</label>
        </div>
        <div class="form-floating mb-3 col-6">
          <input class="form-control" type="date" name="end_date" id="end_date" value="{{$project->end_date}}" required>
          <label for="end_date">End Date</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="{{route('projects.show',$project->id)}}" class="btn btn-secondary">Go Back</a>
    </form>
  </div>
</div>
@endsection