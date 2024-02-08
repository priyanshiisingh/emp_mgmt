@extends('layouts.app')
@section('content')
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Add a Department</h3>
        <form action="{{ route('departments.store') }}" method="post">
          @csrf
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
              </select>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Create Department</button>
      </form>
      </div>
    </div>
  </div>
</body>
</html>
@endsection
