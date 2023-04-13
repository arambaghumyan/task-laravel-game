@extends('layouts.master')
@section('css')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    /* Table hover effect */
    tbody tr:hover {
        background-color: #f9f9f9;
    }
</style>
@stop
@section('content')
    <table>
        <thead>
            <th>Random number</th>
            <th>Result</th>
            <th>Winning amount</th>
        </thead>
        <tbody>
            @foreach($gameHistories as $gameHistory)
                <tr>
                    <td>{{$gameHistory->random_number}}</td>
                    <td>{{$gameHistory->result}}</td>
                    <td>{{$gameHistory->winning_amount}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
