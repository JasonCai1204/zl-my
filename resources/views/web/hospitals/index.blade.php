@extends('web.layouts.user-basic')

@section('title','找医院 - 肿瘤名医')

@section('content')

<div class="container">
    @if (count($hospitals) > 0)
        <div class="weui-cells">
            @foreach ($hospitals as $hospital)

                <a href="hospital/{{ $hospital->id }}" class="weui-cell weui-cell_access">
                    <div class="weui-cell__bd">
                        <p>{{ $hospital->name }}</p>
                    </div>
                    <div class="weui-cell__ft">
                        {{ $hospital->grading }}
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection