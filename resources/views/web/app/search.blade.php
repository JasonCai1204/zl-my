@extends('web.layouts.user-basic')

@section('title','搜索 - 肿瘤名医')

@section('content')

<div class="container" id="container_searchbar">
    <div class="bd">
        <div class="weui-search-bar" id="searchBar">
            <form action="/search" class="weui-search-bar__form">

                <div class="weui-search-bar__box">
                    <i class="weui-icon-search" style="top: 1px;"></i>
                    <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索医院、医生"
                           name="q"
                           value="{{ $q ? : ''}}" autofocus/>
                    <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                </div>

                <label class="weui-search-bar__label" id="searchText">
                    <i class="weui-icon-search"></i>
                    <span>搜索医院、医生</span>
                </label>

            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
        </div>
    </div>

    @if ($hospitals || $doctors)
        @if (count($hospitals) > 0 || count($doctors) > 0)

            <div class="my_recommend_list">
                @if (count($hospitals) > 0)

                    <div class="weui-cells__title">相关医院</div>
                    <div class="weui-cells">
                        @foreach ($hospitals as $hospital)

                            <a href="/hospital/{{ $hospital->id }}" class="weui-cell weui-cell_access">
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

                @if (count($doctors) >0 )
                    <div class="weui-cells__title">相关医生</div>
                    <div class="weui-cells">
                        @foreach($doctors as $doctor)

                            <a href="/doctor/{{ $doctor->id }}" class="weui-cell weui-cell_access my_doctor_cell">
                                <div class="weui-cell__bd">
                                    <p>{{ $doctor->name }}</p>
                                    <span class="my_cell_index">{{ $doctor->hospital->name }}</span>
                                </div>
                                <div class="weui-cell__ft">
                                    {{ $doctor->grading }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="bd">
                <div class="weui-cells__title">暂无“{{ $q }}”的相关医院和医生，欢迎选择相近的医院或医生。</div>
            </div>
        @endif
    @endif
</div>
@endsection