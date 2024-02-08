@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Update Department</h3>
      <form action="{{ route('departments.update', $department->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active" {{ $department->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $department->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Update department</button>
    </form>
    
    </div>
  </div>
</div>
@endsection
