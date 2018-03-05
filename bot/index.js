// -----------------------------------------------------------------------------
// モジュールのインポート
const server = require("express")();
const line = require("@line/bot-sdk"); // Messaging APIのSDKをインポート
const request = require('request');

// -----------------------------------------------------------------------------
// パラメータ設定
const line_config = {
    channelAccessToken: process.env.LINE_ACCESS_TOKEN, // 環境変数からアクセストークンをセットしています
    channelSecret: process.env.LINE_CHANNEL_SECRET // 環境変数からChannel Secretをセットしています
};

// -----------------------------------------------------------------------------
// Webサーバー設定
server.listen(process.env.PORT || 3000);

// APIコールのためのクライアントインスタンスを作成
const bot = new line.Client(line_config);

// -----------------------------------------------------------------------------
// ルーター設定

var testData = null;
server.post('/webhook', line.middleware(line_config), (req, res, next) => {
    // 先行してLINE側にステータスコード200でレスポンスする。
    res.sendStatus(200);

    // すべてのイベント処理のプロミスを格納する配列。
    let events_processed = [];
    // イベントオブジェクトを順次処理。
    req.body.events.forEach((event) => {
        
        var options = {
          uri: 'https://dev.prog24.com/public/api2/get-history.php',
          headers: {
            "Content-type": "application/json",
          },
          json: {
            'userId':event.source.userId
          }
        };
        request.post(options, function(error, response, body){
            // returnData = body;

            if (event.type == "message" && event.message.type == "text"){
                // ユーザーからのテキストメッセージが「こんにちは」だった場合のみ反応。
                if (event.message.text == "こんにちは"){
                    // var responseData = getData(event.source.userId);
                    // replyMessage()で返信し、そのプロミスをevents_processedに追加。
                    if(body.status == 200){
                        if(body.lendBooks == 0){
                            events_processed.push(bot.replyMessage(event.replyToken, {
                                type: "text",
                                text: '現在借りている本はありません'
                            }));
                        }else{
                            events_processed.push(bot.replyMessage(event.replyToken, {
                                type: "text",
                                text: body.lendBooks[0].title
                            }));
                        }
                    }else{
                        events_processed.push(bot.replyMessage(event.replyToken, {
                            type: "text",
                            text: '登録されていません。登録をおすすめします（ https://dev.prog24.com/public/login.php ）'
                        }));
                    }
                    
                    
                }
            }
        });
    });

    // すべてのイベント処理が終了したら何個のイベントが処理されたか出力。
    Promise.all(events_processed).then(
        (response) => {
            console.log(`${response.length} event(s) processed.`);
        }
    );
});
