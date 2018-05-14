@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Compact Marks Register</h1>
    <table class="table table-bordered">
    <thead>

    </thead>
    <tbody>
        {{--  @foreach($minelecmarks as $minelecmark)  --}}
        @foreach($meritlists as $merit)
        <tr>
            <td>{{ $merit->name }}</td>
            <td>{{ $merit->tot6subj }}</td>
            <td>{{ $minelecmarks->where('reg', $merit->reg)->first()->minElecMark }}</td>
            <td>{{ $merit->tot6subj - $minelecmarks->where('reg', $merit->reg)->first()->minElecMark }}</td>
        </tr>
        @endforeach
        {{--  @foreach($mrks as $mark)
        <tr>
            <td>{{ $mark->study->sortBy('student_id') }}</td>
            <td>{{ $mark->study->subject->subj }}</td>
            <td>{{ $mark->thmark }}</td>
        </tr>    
        @endforeach  --}}
        {{--   @php $flag = false; $reg = NULL; @endphp


        @foreach($stdy as $std)
            
        @if($reg != $std->student->reg)
            </tr>
            <tr>
                <td>{{ $std->student->name }}</td>
                <td>{{ $std->student->reg }}</td>

                <td>{{ $std->subject->subj }}</td>
                <td>{{ $std->marks->where('exam_id',1)->pluck('thmark')->first() }}</td>
                <td>{{ $std->marks->where('exam_id',1)->pluck('prmark')->first() }}</td>            
        @else
                <td>{{ $std->subject->subj }}</td>
                <td>{{ $std->marks->where('exam_id',1)->pluck('thmark')->first() }}</td>
                <td>{{ $std->marks->where('exam_id',1)->pluck('prmark')->first() }}</td>
        @endif
        @php $reg = $std->student->reg ; @endphp
        @endforeach  --}}
    </tbody>
    
    
    </table>

    

    {{--  <table class="table table-bordered">
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
    </table>  --}}

{{--  
    @foreach($students as $student)

        {{ $student }}<br>

    @endforeach

  --}}


@endsection

@section('footer')
	@include('layouts.footer')
@endsection
