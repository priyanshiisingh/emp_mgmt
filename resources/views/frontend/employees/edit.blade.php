@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Update Employee</h3>
      <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" nullable>
        </div>
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active" {{ $employee->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $employee->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ $employee->department }}" nullable>
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Update Employee</button>
    </form>
    
    </div>
  </div>
</div>
@endsection
