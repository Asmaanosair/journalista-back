<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RssController extends Controller
{
    public function index()
    {

        $url = "https://www.youm7.com/rss/SectionRss?SectionID=286";

        try {

            $feeds = simplexml_load_file($url);
            $site = $feeds->channel->title;
            $sitelink = $feeds->channel->link;


        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }

        // dd($feeds->channel->item->enclosure['url'][0]);


        return view('rss.index', [
            'posts' => $feeds->channel->item,

        ]);
    }


    public function search(Request $request)
    {
        $url = $request->url;
        try {
            $feeds = simplexml_load_file($url);
            // dd($feeds->channel->image->link);
        } catch (\Exception $exception) {
            return  $exception->getMessage();

        }
        return view('rss.index', [
            'posts' => $feeds->channel->item,
            'website_image'=>$feeds->channel->image->link
        ]);
    }
}
