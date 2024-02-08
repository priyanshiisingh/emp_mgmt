@extends('layouts.app')
@section('content')
  <div class="container mt-5">
    <div class="justify-end ">
      <div class="col ">
        <a class="btn btn-sm btn-success" href={{ route('employees.create') }}>Add Employee</a>
      </div>
    </div>
    <table id="employeeTable" class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          @if(Auth::user()->name === 'super_admin')
            <th>Action</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
          <tr>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->email }}</td>
              @if(Auth::user()->name === 'super_admin')
              <td>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Show</a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="post" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
              @endif

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function () {
      new DataTable('#employeeTable');
    });
  </script>
@endsection
