@extends('layout.master')

@section('title', $title)

@section('css_link')

    <link rel="stylesheet" href="/layui/css/layui.css">

    <link rel="stylesheet" href="/css/theme.css">
    <style>

        .navecation ul li{
            list-style:none;
            float:left;
            padding-right:20px;
        }
        .navecation ul li a{
            text-decoration:none;
            color:#222;
            background-color:#ccc;
            padding:4px 5px;
        }

        .navecation ul li .active{
            background-color:#d90000;
            color:#fff;

        }

    </style>

    <script type="text/javascript" src="/js/jquery2.min.js"></script>
    <script type="text/javascript" src="/js/theme.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $('.theme-login').click(function(){
                $('.theme-popover-mask').fadeIn(100);
                $('.theme-popover').slideDown(200);
            })
            $('.theme-poptit .close').click(function(){
                $('.theme-popover-mask').fadeOut(100);
                $('.theme-popover').slideUp(200);
            })

        })

        jQuery(document).ready(function($) {
            $('.theme-newlogin').click(function(){
                $('.theme-newpopover-mask').fadeIn(100);
                $('.theme-newpopover').slideDown(200);
            })
            $('.theme-newpoptit .close').click(function(){
                $('.theme-newpopover-mask').fadeOut(100);
                $('.theme-newpopover').slideUp(200);
            })

        })

    </script>

    @if($errors AND count($errors))
        <script>
            jQuery(document).ready(function($) {

                $('.theme-popover-mask').fadeIn(100);
                $('.theme-popover').slideDown(200);

                $('.theme-poptit .close').click(function(){
                    $('.theme-popover-mask').fadeOut(100);
                    $('.theme-popover').slideUp(200);
                    window.location.reload();
                })

            })
        </script>

    @endif


@endsection
@section('subscribe')
    <a class="layui-btn layui-btn-normal"    href="#13">
        <i class="layui-icon" style="vertical-align: unset;">&#xe756;</i>訂閱頻道
    </a>
@endsection

@section('category_well')

    <div class="well" style="margin-top: 15px; margin-bottom: 1px;border: 5px solid #d3d3d3;">
        @foreach($channel_data as $color)
            {{$color ->description}}
        @endforeach

    </div>

@endsection

@section('content')


    @if(session('category_manu') == 'time')
        <script>
            $(function() {
                $('li .val1').addClass("active");
            });
        </script>


    @elseif(session('category_manu') == 'views')
        <script>
            $(function() {
                $('li .val2').addClass("active");
            });
        </script>


    @elseif(session('category_manu')== 'likes')
        <script>
            $(function() {
                $('li .val3').addClass("active");
            });
        </script>
    @else
        <script>
            $(function() {
                $('li a').removeClass("active");
            });
        </script>
    @endif

    <section class="content content-light  videos-list videos-list-grid">

        <div class="container">


            @if(session()->has('user_id'))
                <div class="theme-newpopover-mask"></div>

                <div class="pull-right list-view-change">
                    <a class="layui-btn theme-login"  style="padding: 5px 15px;background-color: #ff0000a6; color: #fff;"  href="javascript:;">
                        <i class="layui-icon" style="vertical-align: unset;">&#xe654;</i>新增影片</a>

                    <div class="theme-popover">
                        <div class="theme-poptit">
                            <a href="javascript:;" title="关闭" class="close">×</a>
                            <h3 style=" font-family: 微軟正黑體; font-weight: bold;" >新增 「{{session('channel_name')}}」 影片</h3>
                        </div>

                        {{-- 錯誤訊息模板元件 --}}
                        @include('components.validationErrorMessage')
                        <div class="theme-popbod dform">

                            <form class="theme-signin" name="add_video" action="/openchannel/videos/add" method="post">
                                <ol>

                                    <li>
                                        <strong>影片標題：</strong>
                                        <input class="ipt" type="text" name="title"  placeholder="title"/>
                                    </li>

                                    <li>
                                        <strong>影片作者：</strong>
                                        <input class="ipt" type="text"  name="author"  placeholder="author"/>
                                    </li>

                                    <li>
                                        <strong>影片ID：</strong>
                                        <input class="ipt" type="text" name="video_id"  placeholder="youtube_video_ID"/>
                                        <a  class="btn  btn-large theme-newlogin" href="javascript:;" style="color: red;">ID如何填寫 ?</a>
                                    </li>

                                    <li>
                                        <strong>內容描素：</strong>
                                        <textarea class="form-control" name="content" rows="4"></textarea>
                                    </li>

                                    <input type="hidden" name="views_num" value="0">
                                    <input type="hidden" name="likes_num" value="0">
                                    <input type="hidden" name="channel_name" value="{{session('channel_name')}}">
                                    <input type="hidden" name="user_id" value="{{ session('user_id')}}">
                                    <li>
                                        <input class="btn btn-primary" type="submit" name="submit" value=" 確認上傳 " />
                                    </li>

                                </ol>
                                {{-- CSRF 欄位--}}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <div class="theme-popover-mask"></div>

                    <div class="theme-newpopover">
                        <div class="theme-newpoptit">
                            <a href="javascript:;" title="关闭" class="close">返回 &#8629;</a>
                            <h3 style=" font-family: 微軟正黑體; font-weight: bold;">該如何填寫影片ID欄位 ?</h3>
                        </div>
                        <div class="theme-popbod newdform">
                            <form class="theme-signin" name="loginform" action="" method="post">
                                <ol>
                                    <br>
                                    <p style="font-size: medium;font-weight: 600;">本系統只接受YOUTUBE上的影片 !</p>
                                    <br>
                                    <p style="font-size: x-large;font-weight: 800;">教學範例:</p>

                                    <p style="font-size: medium;font-weight:600;">影片網址若為https://www.youtube.com/watch?v=<span style="color: tomato;">go6q_ZKRnvE</span></p>
                                    <p style="font-size: medium;font-weight: 600;">影片ID即為<span style="color: tomato;">go6q_ZKRnvE</span></p>
                                    <br>
                                    <img src="/img/EX.jpg" alt="Smiley face" width="95%">

                                </ol>
                            </form>
                        </div>
                    </div>

                </div>
            @endif



            <div class="filter">

                <nav class="navecation">
                    <span style="float: left;margin-right: 10px;">排序:</span>
                    <ul id="navi">

                        <li><a class="val1" href="/video/index/{{session('channel_name')}}/time">依發佈時間</a></li>
                        <li><a class="val2" href="/video/index/{{session('channel_name')}}/views">依觀看人數</a></li>
                        <li><a class="val3" href="/video/index/{{session('channel_name')}}/likes">依喜愛人數</a></li>

                    </ul>
                </nav>

            </div>


            <hr class="invisible" />

            <div class="row" style="display: flex;flex-wrap: wrap;">
                @foreach($Channel_Videos as $videos)

                    <article class="col-md-4 video-item">

                        <a href="/openchannel/{{ $videos->channel_name }}/{{ $videos->id }}" class="video-prev video-prev-small">
                            <img  width="100%" height="100%" src='http://img.youtube.com/vi/{{ $videos->video_id }}/mqdefault.jpg'>
                        </a>

                        <h3 class="video-title">
                            <a href="/test3"> {{ $videos->title }}</a>
                        </h3>

                        <div class="row video-params">
                            <div class="col-md-8">
                                發佈者：<b> {{ $videos->author }}</b>
                            </div>
                            <div class="col-md-4 text-right">
                                瀏覽人數：<b> {{ $videos->views_num }}</b>
                            </div>
                        </div>

                        <div class="row video-params">
                            <div class="col-md-7">
                                建立日期：<b>{{ date('Y-m-d', strtotime($videos->updated_at))}}</b>
                            </div>
                            <div class="col-md-5 text-right">
                                喜愛人數：<b>{{ $videos->likes_num }}</b>
                            </div>
                        </div>

                        @foreach($channel_data as $color)
                            <div class="row video-{{$color->channel_color}}-params">
                                @endforeach
                                <div class="col-md-12">
                                    <b>#{{ $videos->channel_name }}</b>
                                </div>
                            </div>

                    </article>
                @endforeach
            </div>



            <!-- Pagination -->

            {{  $Channel_Videos->links() }}


        </div>
    </section>

@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>


