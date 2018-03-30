<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Validator;  // 驗證器
use App\Channels;
use App\Channel_Videos;

class OpenCourseController extends Controller
{
    public function openchannelPage()
    {
        $Videos_Category = DB::table('videocategory')->get();
        $binding = ['title' => '開放式頻道' , 'subject' => '開放式頻道', 'Videos_Category' => $Videos_Category];
        return view('opencourse', $binding);
    }

    //頻道頁面
    public function channelPage()
    {
        $Videos_Category = DB::table('videocategory')->get();
        $channels = DB::table('channels')->orderBy('updated_at', 'desc')->get();
        $binding = ['title' => '開放式頻道' , 'subject' => '開放式頻道', 'Videos_Category' => $Videos_Category, 'channels' => $channels];
        return view('channel', $binding);
    }

    public function addchannelProcess()
    {

        // 接收輸入資料
        $request = Request::all();

        // 驗證規則
        $rules = [
            // channel_name
            'channel_name'=> [
                'required',
                'max:30',
            ],
            // channel_color
            'channel_color' => [
                'required',
            ],
            // description
            'description' => [
                'required',
                'max:300',
            ],

        ];

        // 驗證資料
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $Channels = Channels::create($request);

        // 重新導向到影片區
        return redirect()->back();
    }

    // 開放式頻道(影片頁面)
    public function channel_video_areaPage($channel_name){

        $Videos_Category = DB::table('videocategory')->get(); //nav需要

        $channel_data = DB::table('channels')->where('channel_name', '=', $channel_name)->get();

        $Channel_Videos = DB::table('channel_videos')->where('channel_name', '=', $channel_name)->orderBy('updated_at', 'desc')->paginate(5);

        $subject = '「'.$channel_name.'」';
        $binding = ['title' => '開放式頻道' , 'subject' => $subject, 'Channel_Videos' => $Channel_Videos,
            'Videos_Category' => $Videos_Category, 'channel_data' => $channel_data];
        session()->put('category_manu', 'time');
        session()->put('channel_name', $channel_name);
        return view('channel_area', $binding);
    }

    public function addvideosProcess()
    {
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // Title
            'title'=> [
                'required',
                'max:30',
            ],
            // Author
            'author' => [
                'required',
                'max:20',
            ],
            // Video_ID
            'video_id' => [
                'required',
                'max:40',
            ],
            // Content
            'content' => [
                'required',
                'max:300',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $Channel_Videos = Channel_Videos::create($input);

        // 重新導向到影片區
        return redirect()->back();
    }

    public function channel_videoPage($channel_name,$video_id){

        //取得觀看次數
        $Video_view = DB::table('channel_videos')->where('id', '=', $video_id)->get();
        foreach ($Video_view as $view){
            $views_num = $view->views_num;
        }
        //更新觀看次數(點擊後+1)
        DB::table('channel_videos')
            ->where('id', $video_id)
            ->update(['views_num' => $views_num+1]);

        //取得影片分類+取得點擊後所對應的影片資訊+找尋相類似頻道的影片
        $Videos_Category = DB::table('videocategory')->get(); //nav需要

        $Channel_Videos = DB::table('channel_videos')->where('id', '=', $video_id)->get();
        $SimilarVideos = DB::table('channel_videos')->where('channel_name', '=', $channel_name)->where('id', '!=', $video_id)->get();



        //計算喜愛人數
        $Video_likes_num = DB::table('channel_video_likes')
            ->where('like_channel_video_id','=',$video_id)
            ->count();

        //更新videos資料庫的喜愛人數
        DB::table('channel_videos')
            ->where('id', $video_id)
            ->update(['likes_num' => $Video_likes_num]);


        //取得會員喜愛的影片資料(判斷是否已加入喜愛)
        $User_Like_Video = DB::table('channel_video_likes')
            ->where('user_id', '=', session('user_id'))
            ->where('like_channel_video_id','=',$video_id)
            ->get();

        //取得會員收藏的影片資料(判斷是否已加入收藏)
        $User_Collect_Video = DB::table('channel_video_collects')
            ->where('user_id', '=', session('user_id'))
            ->where('collect_channel_video_id','=',$video_id)
            ->get();

        //取得頻道標題
        foreach ($Channel_Videos as $subject){
            $subject = $subject->title;
        }

        $binding = ['title' => '教學影片' , 'subject' => $subject,
            'Channel_Videos' => $Channel_Videos , 'SimilarVideos' => $SimilarVideos,
            'Videos_Category' => $Videos_Category,
            'User_Like_Video' => $User_Like_Video,
            'Video_likes_num' => $Video_likes_num,
            'User_Collect_Video' => $User_Collect_Video
        ];

        // 重新導向到影片區
        return view('channel_video', $binding);
    }
}
