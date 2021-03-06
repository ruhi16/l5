@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Compact Merit List</h1>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Reg No</th>
            <th>Roll</th>
            <th>Total 6 Subj</th>
            <th>Min Subj No</th>
            <th>Best of 5 Subj Total</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 0; @endphp
        @foreach($meritlists as $merit)
        @php $i++; @endphp
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $merit->name }}</td>
            <td>{{ $merit->reg }}</td>
            <td>{{ $merit->roll }}</td>
            <td>{{ $merit->tot6subj }}</td>
            <td>{{ $merit->totminsubj }}</td>
            <td>{{ $merit->tot5subj }}</td>
            <th>{{ $i }}</th>

        </tr>
        @endforeach
    </tbody>
    </table>


    {{--  @foreach($students as $student)

        {{ $student }}<br>

    @endforeach  --}}




@endsection

@section('footer')
	@include('layouts.footer')
@endsection
