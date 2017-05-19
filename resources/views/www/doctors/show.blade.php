@extends('www.layouts.app')

@section('title', '医生 - ')

@section('content')
    <main class="container doctor-show">
        <div class="top">
            <figure></figure>
            <h1>李之德<span> 教授</span></h1>
        </div>

        <div class="tab-bar">
            <div class="left active">
                简介
            </div>
            <div class="right">
                评论
            </div>
        </div>

        <div class="left-content">
            职称：
博士，主任医师、教授，南方医科大学南方医院胸外科主任，博士研究生导师。

专长：
精通普胸外科常见病、疑难病、危重病的诊断和治疗，对本专业的疑难、危重病的诊治具有丰富的临床经验。擅长胸外科各类微创手术，尤其对全胸腔镜单向式肺叶及肺段切除、全胸腹腔镜食管癌根治术具有丰富的治疗经验和精湛的手术技能。同时开展胸外科高端、复合、疑难手术，如肺癌扩大根治性手术(上腔静脉成形、重建，心房部分切除，支气管、肺动脉双袖式肺叶切除，半隆突、隆突切除重建等)；巨大纵膈肿瘤切除术；COPD肺减容手术等。
        </div>

        <div class="right-content" style="display: none">
            <div class="ratings sum-ratings">
                <span class="star-light"></span>
                <span class="star-light"></span>
                <span class="star-light"></span>
                <span class="star-light"></span>
                <span class="star-outline"></span>
                <span class="desc">72份评价</span>
            </div>

            <a class="writing-review" href="#">撰写评论</a>

            <div class="reviews">
                @for ($i = 1; $i < 5; $i++)
                <div class="review">
                    <div class="ratings sum-ratings">
                        <span class="star-light"></span>
                        <span class="star-light"></span>
                        <span class="star-light"></span>
                        <span class="star-light"></span>
                        <span class="star-outline"></span>
                        <span class="desc">评论人：周杰伦</span>
                    </div>
                    <p>我爸已经于2016年10月13日在贵院做了右肺上叶癌根治术。手术非常顺利，恢复非常好。感谢殷伟强主任、贺院长及所有医务人员，是您们精湛的医术、无私的情怀、高尚的医德使我重拾一个温馨的家！ 我们全家感谢您们！！！</p>
                </div>
                @endfor

                <div class="more-reviews">
                    更多评论
                </div>
            </div>
        </div>

        <div class="operating-bar">
            <a href="#" class="weui-btn weui-btn_primary">预约</a>
        </div>
    </div>
    </main>
@endsection
