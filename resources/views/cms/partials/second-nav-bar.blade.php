<div id="second-nav-bar" class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        @foreach ([
            ['id' => 'order', 'name' => '订单', 'uri' => '/orders'],
            ['id' => 'review', 'name' => '评论', 'uri' => '/reviews'],
            ['id' => 'hospital', 'name' => '医院', 'uri' => '/hospitals'],
            ['id' => 'doctor', 'name' => '医生', 'uri' => '/doctors'],
            ['id' => 'user', 'name' => '用户', 'uri' => '/users'],
            ['id' => 'type', 'name' => '病种', 'uri' => '/types'],
            ['id' => 'instance', 'name' => '病例', 'uri' => '/instances'],
            ['id' => 'city', 'name' => '城市', 'uri' => '/cities'],
            ['id' => 'news_class', 'name' => '文章类别', 'uri' => '/news_class'],
            ['id' => 'news', 'name' => '文章', 'uri' => '/news'],
            ['id' => 'master', 'name' => '德之天才', 'uri' => '/masters'],
            ['id' => 'department', 'name' => '企业部门', 'uri' => '/departments'],
            ] as $menu)
            @if ($menu['id'] != 'master' && $menu['id'] != 'department')
                <li role="presentation" {{ isset($hero) && $hero == $menu['id'] ? 'class=active' : '' }}>
                        <a href="{{ $menu['uri'] }}">{{ $menu['name'] }}</a>
                </li>
            @elseif (\App\Master::find(Auth::guard()->user()->role_id)->department_id == 2)
                <li role="presentation" {{ isset($hero) && $hero == $menu['id'] ? 'class=active' : '' }}>
                    <a href="{{ $menu['uri'] }}">{{ $menu['name'] }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
