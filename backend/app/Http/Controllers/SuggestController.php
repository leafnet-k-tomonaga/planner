<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class SuggestController extends Controller
{

    public function index(Request $request){    
        Log::info('SuggestController@indexにHTTPリクエストが有りました。');

        // GPT関連の処理１：プロンプトの作成 /////////////////////
        $promptForGPT = <<<TEXT
            以下の条件を踏まえ、観光するコースを提案してください。
            ・出発時間：{$request['departureTime']}
            ・出発場所：{$request['departurePlace']}
            ・帰着時間：{$request['arrivalTime']}
            ・帰着場所：{$request['arrivalPlace']}
            ・備考：
            なお、コース中の各スポットについては以下の形式で列挙してください。
            {
                "スポット":{
                    "スポット名":
                    "滞在時間":
                    "備考":
                }
            }
        TEXT;

        // GPT関連の処理２：GPTにリクエストを送信 /////////////////////
        $returnValue = gpt($promptForGPT);

        return $returnValue;
    }
}


