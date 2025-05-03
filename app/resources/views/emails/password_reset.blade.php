<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>パスワードリセットのご案内</title>
</head>
<body>
    <p>{{ $user->name }}様</p>
    <p>パスワードリセットのご依頼を受けました。</p>
    <p>以下のリンクをクリックして、新しいパスワードを設定してください。</p>
    <a href="{{ url('reset/form/' . $token . '/' . $user->email) }}">パスワードリセット</a>
    <p>このメールに覚えのない方は、恐れ入りますが破棄してください。</p>
</body>
</html>