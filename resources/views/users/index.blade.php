@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Utilisateurs</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-striped">
                          <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($users as $user)
                            <tr>
                              <th scope="row"><a href="{{ route('users.edit', ['user' => $user]) }}">{{ $user->name }}</a></th>
                              <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
