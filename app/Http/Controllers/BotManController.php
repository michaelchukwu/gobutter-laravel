<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {
            $chat = Chat::where('chat', $message)->first();
            if ($chat) {
                $botman->reply(strip_tags($chat->reply));
            } else {
                $chat2 = Chat::where('chat', 'LIKE', '%' . $message . '%')->first();
                if ($chat2) {
                    $botman->reply(strip_tags($chat2->reply));
                } else {
                    $ser = DB::table('chat_suggestions')->where('chat', $message)->first();
                    if ($ser) {
                        DB::table('chat_suggestions')->where('chat', $message)->update([
                            'count' => DB::raw('count+1')
                        ]);
                    } else {
                        DB::table('chat_suggestions')->insert([
                            'chat' => $message,
                            'count' => 1,
                            'created_at' => now()
                        ]);
                    }
                    $botman->reply('Please contact us on 08130630784');
                }
            }

            // switch ($message) {
            //     case "hello":
            //         $botman->reply('Hi, how are you?');
            //         break;
            //     case "fine":
            //         $botman->reply('that is good');
            //         break;
            //     case ".*pass.*":
            //         $botman->reply('you can ');
            //         break;
            //     default:
            //         $botman->reply('Please contact us on 0910099');
            // }
            // if ($message == '.*hi.*') {
            //     $this->reply("we are here");
            //     // $this->askName($botman);
            // } else {
            //     $botman->reply("write 'hi' for testing...");
            // }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name);
        });
    }
}
