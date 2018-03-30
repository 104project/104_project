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


@endsection



@section('content')

    @if(session('category_manu') == 'collect')
        <script>
            $(function() {
                $('li .val1').addClass("active");
            });
        </script>


    @elseif(session('category_manu') == 'likes')
        <script>
            $(function() {
                $('li .val2').addClass("active");
            });
        </script>


    @elseif(session('category_manu')== 'subscribe')
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

            <div class="filter">

                <nav class="navecation">
                    <span style="float: left;margin-right: 10px;">分類 :</span>

                    <ul id="navi">
                        <li><a class="val1" href="/user/videos/collect/{{session('user_id')}}">個人收藏區</a></li>
                        <li><a class="val2" href="/user/videos/likes/{{session('user_id')}}">個人喜愛區</a></li>
                        <li><a class="val3" href="/user/videos/subscribe/{{session('user_id')}}">個人訂閱區</a></li>

                    </ul>
                </nav>
            <br/>
            </div>

            <hr class="invisible" />

            <div class="row" style="display: flex;flex-wrap: wrap;margin-top: 30px;">
                @foreach($User_Videos as $videos)

                        <article class="col-md-3 video-item"
                             style="background-color:white;
                            -webkit-box-shadow: inset 0 0 5px white;
                            -moz-box-shadow: inset 0 0 10px white;
                            box-shadow: inset 0 0 1px #666;
                            padding-top: 15px;
                            position: relative;
                            overflow: hidden;">


                            <div class="row video-tag-params" style="float: left;" >
                                <div class="col-md-12">
                                    @if(session('category_manu') == 'collect')
                                        <b>★ 收藏</b>
                                    @endif
                                    @if(session('category_manu') == 'likes')
                                        <b>❤ 喜愛</b>
                                    @endif
                                    @if(session('category_manu') == 'subscribe')
                                        <b>★ 訂閱</b>
                                    @endif
                                </div>
                            </div>
                            <div class="row video-{{$videos->tag_color}}-params" style="float: right;">
                                <div class="col-md-12">
                                    <b>#{{ $videos->category }}</b>
                                </div>
                            </div>

                        @if(session('category_manu') == 'collect')
                            <a href="/video/{{ $videos->category }}/{{ $videos->collect_video_id }}" class="video-prev video-prev-small" style="margin-top: 35px;">
                            <img  width="100%" height="100%" src='http://img.youtube.com/vi/{{ $videos->video_id }}/mqdefault.jpg'></a>
                        @endif
                        @if(session('category_manu') == 'likes')
                            <a href="/video/{{ $videos->category }}/{{ $videos->like_video_id }}" class="video-prev video-prev-small" style="margin-top: 35px;">
                                <img  width="100%" height="100%" src='http://img.youtube.com/vi/{{ $videos->video_id }}/mqdefault.jpg'></a>
                        @endif
                        @if(session('category_manu') == 'subscribe')
                            <a href="/video/{{ $videos->category }}/{{ $videos->subscribe_video_id }}" class="video-prev video-prev-small" style="margin-top: 35px;">
                                <img  width="100%" height="100%" src='http://img.youtube.com/vi/{{ $videos->video_id }}/mqdefault.jpg'></a>
                        @endif
                        <h3 class="video-title" >
                            <a href="/test3"> {{ $videos->title }}</a></h3>

                                @if(session('category_manu') == 'collect')

                                        <form name="dislike" id="dislike" action="/video/{{$videos->collect_video_id}}/discollect" method="post">
                                            <button class="btn btn-link" style="float: right;margin-bottom: 5px; padding: 0px 3px;"> <i class="fa fa-trash-o"></i>刪除收藏</button>
                                            {{-- CSRF 欄位--}}
                                            {{ csrf_field() }}
                                        </form>

                                @endif

                                @if(session('category_manu') == 'likes')

                                        <form name="dislike" id="dislike" action="/video/{{$videos->like_video_id}}/dislike" method="post">
                                            <button class="btn btn-link" style="float: right;margin-bottom: 5px; padding: 0px 3px;"> <i class="fa fa-trash-o"></i>刪除喜愛</button>
                                            {{-- CSRF 欄位--}}
                                            {{ csrf_field() }}
                                        </form>

                                @endif

                                @if(session('category_manu') == 'subscribe')

                                        <form name="dislike" id="dislike" action="/video/{{$videos->collect_video_id}}/dislike" method="post">
                                            <button class="btn btn-link" style="float: right;margin-bottom: 5px; padding: 0px 3px;"> <i class="fa fa-trash-o"></i>刪除訂閱</button>
                                            {{-- CSRF 欄位--}}
                                            {{ csrf_field() }}
                                        </form>

                                @endif



                    </article>
                @endforeach

            </div>

            <!-- Pagination -->




        </div>
    </section>
@endsection


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>


<script type="text/javascript" src="/layui/layui.js"></script>
