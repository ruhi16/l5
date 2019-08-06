@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Compact Merit List Best of 5 Subject</h1>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>            
            <th>Roll</th>
            <th>Lang-I</th>
            <th>Lang-II</th>
            <th>Elec-I</th>
            <th>Elec-II</th>
            <th>Elec-III</th>
            <th>Optl-I</th>
            <th>Total</th>
            <th>Addl Subj</th>
            <th>Best 5 Total</th>
            <th>RANK</th>
        </tr>
    </thead>
    <tbody>
    @php $i = 0; @endphp
    
        @foreach($stbest5mrk as $stmrkdetail)
        @if($stmrkdetail->roll != 0)
        @php $i++; @endphp
        <tr>
            <td>{{ $i }}</td>
            <td>
                {{ $stmrkdetail->name }}<br>
                <small>Reg. NO: {{ $stmrkdetail->reg }}</small>
            </td>
            <td>{{ $stmrkdetail->roll }}</td>
            {{--  @if(stmrkdetail->reg == $reg)  --}}
            @php
                $abc = $stmrkdetails->where('reg', $stmrkdetail->reg);


            @endphp


            
            @foreach($abc->sortBy('subject_id') as $a)
            <td>
                {{ $a->subject_shname }}<br>
                <small>{{ (int)$a->thmark }}+{{ (int)$a->prmark }}={{ $a->thmark + $a->prmark }}</small>
            </td>
            @endforeach
            <td align="center"><b>{{ (int)$stmrkdetail->total6subject }}</b></td>
            <td align="center">{{ $stmrkdetail->subject_shname }}<br>
                <small>{{ (int)$stmrkdetail->minOpmark }}</small>
            </td>
            <td align="center"><b>{{ (int)$stmrkdetail->total5subject }}</b></td>
            <td align="center"><b>{{ $i }}</b></td>
        </tr>
        @endif
        @endforeach  

    </tbody>
    </table>


  



@endsection

@section('footer')
	@include('layouts.footer')
@endsection
