<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ツイート操作モデルを読み込む
include_once '../models/tweets.php';
 
// ログインしているか
$user = getUserSession();
if(!$user) {
    
    // ログインしていない
    header('Location:' . HOME_URL . 'controllers/sign-in.php');
    exit;
}
 
// 画面表示
$view_user = $user;
// ツイート一覧
$view_tweets = findTweets($user);
 
// 画面表示
include_once '../Views/home.php';