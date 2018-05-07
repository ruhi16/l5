@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Compact Marks Register</h1>

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
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}<br>
            Reg: <small>{{ $student->reg }}</small></td>
            <td>{{ $student->roll }}</td>
            @php $total = 0; @endphp
            @forelse($student->studies as $study)
                <td>
                <small>
                @foreach($study->marks as $mark)
                    
                        {{$study->subject->subj or ''}}<br>
                        {{(int)$mark->thmark}}+{{(int)$mark->prmark}}={{(int)$mark->thmark+(int)$mark->prmark}}
                        @php $total += (int)$mark->thmark+(int)$mark->prmark ; @endphp
                @endforeach
                </small>
                </td>
            @empty
                <th></th>
            @endforelse
            <td class="text-right"><b>{{ $total }}</b></td>
        </tr>
        @endforeach
    </tbody>
    </table>


    @foreach($students as $student)

        {{ $student }}<br>

    @endforeach




@endsection

@section('footer')
	@include('layouts.footer')
@endsection
