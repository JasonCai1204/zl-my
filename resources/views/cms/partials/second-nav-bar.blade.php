<div id="second-nav-bar" class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        @foreach ([
            ['id' => 'order', 'name' => '预约单', 'uri' => '/orders'],
            ['id' => 'hospital', 'name' => '医院', 'uri' => '/hospitals'],
            ['id' => 'doctor', 'name' => '医生', 'uri' => '/doctors'],
            ['id' => 'user', 'name' => '用户', 'uri' => '/users'],
            ['id' => 'type', 'name' => '病种', 'uri' => '/types'],
            ['id' => 'instance', 'name' => '病例', 'uri' => '/instances'],
            ['id' => 'city', 'name' => '城市', 'uri' => '/cities'],
            ['id' => 'news', 'name' => '资讯', 'uri' => '/news'],
            ['id' => 'master', 'name' => '德之天才', 'uri' => '/masters'],
            ['id' => 'department', 'name' => '企业部门', 'uri' => '/departments'],
            ] as $menu)
            <li role="presentation" {{ isset($hero) && $hero == $menu['id'] ? 'class=active' : '' }}>
                <a href="{{ $menu['uri'] }}">{{ $menu['name'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
