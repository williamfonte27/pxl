@extends('layout.base')
@section('title', 'Imported Users')
@section('content')

    <div class="container-fluid">
        <h1 class="title text-warning mt-5 mb-5 text-center">Imported Users</h1>

        <table id="results" class="table table-striped table-bordered table-dark text-white mb-5"
               style="width:100%;">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Checked</th>
                <th scope="col">Description</th>
                <th scope="col">Interest</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Email</th>
                <th scope="col">Account</th>
                <th scope="col">Credit card_type</th>
                <th scope="col">Credit Card Number</th>
                <th scope="col">Credit Card Name</th>
                <th scope="col">Credit Card Expiration Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($allUsers as $idx => $user)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->checked }}</td>
                    <td>{{ $user->description }}</td>
                    <td>{{ $user->interest }}</td>
                    <td>{{ $user->date_of_birth }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->account }}</td>
                    <td>{{ $user->credit_card_type }}</td>
                    <td>{{ $user->credit_card_number }}</td>
                    <td>{{ $user->credit_card_name }}</td>
                    <td>{{ $user->credit_card_expirationDate }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
