@extends('www.layouts.app')

@section('title', '应用下载 - ')

@section('content')
    <main>
        <h1 id="page-title-with-background-image">应用下载</h1>

        <section id="content">
            <div class="weui-cells__title">Android</div>
            <div class="weui-cells">
                <a class="weui-cell weui-cell_desc weui-cell_access" href="/storage/apps/android/user/com.zl-my_1.0.0_101.apk">
                    <div class="weui-cell__bd">
                        <p>肿瘤名医</p>
                        <span>立即下载</span>
                    </div>
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <a class="weui-cell weui-cell_desc weui-cell_access" href="/storage/apps/android/ys/com.zl-my.ys_1.0.0_101.apk">
                    <div class="weui-cell__bd">
                        <p>肿瘤名医医生版</p>
                        <span>立即下载</span>
                    </div>
                    <div class="weui-cell__ft">
                    </div>
                </a>
            </div>

            <div class="weui-cells__title">iOS</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <p>即将到来...</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
