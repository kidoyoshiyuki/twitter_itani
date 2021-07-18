<?php
///////////////////////////////////////
// ポストコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';
//  ツイートデータ操作モデルを読み込み
include_once '../models/tweets.php';
// ログインしているか
$user = getUserSession();
if(!$user) {
    
    // ログインしていない
    header('Location:' . HOME_URL . 'controllers/sign-in.php');
    exit;
}

// ツイートがある場合
if (isset($_POST['body'])) {
    $image_name = null;
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $image_name = uploadImage($user, $_FILES['image'], 'tweet');
    }

        $data = [
            'user_id' =>$user['id'],
            'body' =>$_POST['body'],
            'image_name' =>$image_name
        
        ];

        if (createTweet($data)) {
            // ホーム画面に遷移
            header('Location:' . HOME_URL . 'controllers/home.php');
            exit;

        }
    }


// 画面表示
$view_user = $user;
include_once '../Views/post.php';