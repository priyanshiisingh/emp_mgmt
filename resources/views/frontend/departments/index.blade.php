@extends('layouts.app')
@section('content')
  <div class="container mt-5">
      <div class="justify-end">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('departments.create') }}>Add Department</a>
        </div>
      </div>
    <table id="departmentTable" class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($departments as $department)
          <tr>
            <td>{{ $department->name }}</td>
            <td>{{ $department->status }}</td>
            <td>
              <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">Show</a>
              <form action="{{ route('departments.destroy', $department->id) }}" method="post" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function () {
      $('#departmentTable').DataTable();
    });
  </script>
@endsection
