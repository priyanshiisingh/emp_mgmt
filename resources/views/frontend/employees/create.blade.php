@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Add a Employee</h3>
        <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" nullable>
          </div>
          <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image">
          </div>
          <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
              </select>
          </div>
          <div class="form-group">
              <label for="department">Department</label>
              <input type="text" class="form-control" id="department" name="department" nullable>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Create Employee</button>
      </form>
      </div>
    </div>
  </div>
</body>
</html>
@endsection