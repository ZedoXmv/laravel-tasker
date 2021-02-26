@extends('layouts.tasker')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="display-5 mb-sm-3 text-center">Create New Project</div>
    <form action="{{route('projects.store')}}" method="POST">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" name="title" id="title" placeholder="title" >
        <label for="title">Title</label>
        @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control @error('details') is-invalid @enderror" name="details" id="details" placeholder="details" style="height: 120px" >{{old('details')}}</textarea>
        <label for="details">Project Details</label>
        @error('details')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
      </div>
      <div class="row mb-3">
        <div class="form-floating col-6">
          <select name="status" id="status" class="form-control">
            <option value="pending" selected>Pending</option>
            <option value="ongoing">On Going</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
          </select>
          <label for="status">Choose Status</label>
        </div>
        <div class="form-floating col-6">
          <select class="form-control" name="project_manager_id" id="project_manager" >
              {{-- <option selected>Open Manager List</option> --}}
            @foreach ($projectManagers as $projectManager)
                <option value="{{$projectManager->id}}">{{$projectManager->name}}</option>
            @endforeach
          </select>
          <label for="project_manager">Select Project Manager</label>
        </div>
      </div>

      <div class="row mb-3">
        <div class="form-floating col-6">
          <input class="form-control @error('start_date') is-invalid @enderror" type="date" value="{{old('start_date')}}" name="start_date" id="start_date">
          <label for="start_date">Start Date</label>
          @error('start_date')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-floating mb-3 col-6">
          <input class="form-control @error('end_date') is-invalid @enderror" type="date" value="{{old('end_date')}}" name="end_date" id="end_date">
          <label for="end_date">End Date</label>
          @error('end_date')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="{{route('projects.index')}}" class="btn btn-secondary">Go Back</a>
    </form>
  </div>
</div>
@endsection