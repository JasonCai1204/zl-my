<div id="second-nav-bar" class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        @foreach ([
            ['id' => 'order', 'name' => '预约单', 'uri' => '/orders'],
            ['id' => 'hospital', 'name' => '医院', 'uri' => '/hospitals'],
            ['id' => 'doctor', 'name' => '医生', 'uri' => '/doctors'],
            ['id' => '', 'name' => '用户', 'uri' => '/'],
            ['id' => '', 'name' => '病种', 'uri' => '/'],
            ['id' => '', 'name' => '病例', 'uri' => '/'],
            ['id' => 'city', 'name' => '城市', 'uri' => '/cities'],
            ['id' => '', 'name' => '资讯', 'uri' => '/'],
            ['id' => '', 'name' => '系统设置', 'uri' => '/'],
            ] as $menu)
            <li role="presentation" {{ isset($hero) && $hero == $menu['id'] ? 'class=active' : '' }}>
                <a href="{{ $menu['uri'] }}">{{ $menu['name'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
