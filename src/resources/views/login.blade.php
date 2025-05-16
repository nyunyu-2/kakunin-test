<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inika:wght@400;600&display=swap">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div class="header__logo">
                    FashionablyLate
                </div>
            </div>
            <div class="header__button">
                <a href="/register" type="submit" >register</a>
            </div>
        </div>
    </header>

    <main>
        <div class="login-form__content">
            <div class="login-form__heading">
                <h2 class="login-form__title">Login</h2>
            </div>
            <form class="login-form__form" action="{{ route('login.post') }}" method="post">
                @csrf
                <div class="login-form__group">
                    <div class="login-form__label-wrapper">
                        <span class="login-form__label">メールアドレス</span>
                    </div>
                    <div class="login-form__field">
                        <div class="login-form__field--text">
                            <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                        </div>
                        <div class="login-form__error">
                            @php
                                $emailError = $errors->first('email');
                            @endphp

                            @if ($emailError === 'メールアドレスを入力してください')
                                <p class="login-form__error">メールアドレスを入力してください</p>
                            @elseif ($emailError === 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください')
                                <p class="login-form__error">メールアドレスは「ユーザー名@ドメイン」形式で入力してください</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="login-form__group">
                    <div class="login-form__label-wrapper">
                        <span class="login-form__label">パスワード</span>
                    </div>
                    <div class="login-form__field">
                        <div class="login-form__field--text">
                            <input type="password" name="password" placeholder="例:coachtech1106" />
                        </div>
                        <div class="login-form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="login-form__button-wrapper">
                    <button class="login-form__button" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>