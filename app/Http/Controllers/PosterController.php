<?php

namespace App\Http\Controllers;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PosterController extends Controller
{
    public function sendNewPost(Request $request)
    {
        Log::info($request->headers);
        if($request->header('Token')==='hashdui!HoiuhIUOBYIb')
        {
            $data=$request->all();
            Log::info($data);
            $title=$data['title']??null;
            $description=$data['description']??null;
            $url=$data['url']??null;
            $image=$data['image']??null;
            /** @var TelegraphChat $chat */
            $chat=TelegraphChat::find(3);
            $message='<b>'.$title."</b>\n\n".$description;
            $img="<a href='https://mehnat.uz".$image."'".">Rasm</a>";
            if($image)
            {
                $message.="\n".$img;
            }
            if($url===null)
            {
                $url='https://mehnat.uz';
            }
            $message=$chat->html($message)->keyboard(
                Keyboard::make()->buttons(
                    [
                        Button::make('Batafsil')->url($url)
                    ]
                )
            )->send();
            Log::info($message);
        }
        // Telegraph::photo($message)->send();
    }
}
