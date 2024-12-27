<?php
use Illuminate\Support\Facades\Log;
//使い方の参考ページ：https://soune.co.jp/openai-api/

/*
 * 【入力】
 * 　　第一引数：GPTへのプロンプト  ※文字列型
 * 【出力】
 *  　GPTが提案したコース          ※文字列型(json形式)
 * */
function gpt(string $prompt):string{
    $apiKey = config('app.open_ai_api_key');
    $endpoint = config('app.open_ai_api_endpoint_gpt');

    // リクエストヘッダー
    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey",
    ];

    // リクエストボディ
    $data = [

        //使用するモデルの指定
        'model' => 'gpt-3.5-turbo-1106',
        // 'model' => 'gpt-3.5-turbo',
        // 'model' => 'gpt-4-32k',
        // 'model' => 'gpt-4o',

        //GPTへの指示出し（処理の前提条件を会話形式で設定できる。）
        'messages' => [
            //  system    ：AIの受け答えなどを指定
            //  user      ：ユーザーから送信されたメッセージ
            //  assistant ：AIから送信されたメッセージ
            ['role' => 'system',    'content' => '箇条書きで回答してください'],
            ['role' => 'user',      'content' => "{$prompt}"]
        ],
        'max_tokens' => 1000,   // GPTが生成する最大トークン数（≒文字数制限）
        'temperature' => 0,     // 応答のばらつき具合の調整（0~1で指定。0ならほぼ変動なし）
    ];

    // cURLのオプションを設定（APIにリクエスト送信の準備）
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //HTTPリクエストヘッダー
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // cURL実行
    $response = curl_exec($ch);

    // cURLの後処理
    curl_close($ch);

    // 結果をデコード
    $result = json_decode($response, true);


    if(isset($result['error'])){
        //GPTでの処理エラー
        $resultMessage = $result['error']['message'];
    }else{
        //GPTでの処理成功
        $resultMessage = $result["choices"][0]["message"]["content"];
    }

    // 結果を出力
    return $resultMessage;
}



