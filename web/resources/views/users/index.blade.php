@extends('layouts.main')

@section('content')
    <div class="container mt-2">
        <a class="btn btn-primary mb-2" href="/users/create">Add User</a>

        <table class="table table-hover">
            <theader>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </theader>
            <tbody>
            @if ($users->count() === 0)
                <tr>
                    <td colspan="3">There is no data</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-default" href="/users/{{ $user->id }}">View</a>
                            <a class="btn btn-warning" href="/users/{{ $user->id }}/edit">Change Password</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
