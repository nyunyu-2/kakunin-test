<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
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
                <a href="/login" type="submit">login</a>
            </div>
        </div>
    </header>

    <main>
        <div class="register-form__content">
            <div class="register-form__heading">
                <h2 class="register-form__title">Register</h2>
            </div>
            <form class="register-form__form" method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="register-form__group">
                    <div class="register-form__label-wrapper">
                        <span class="register-form__label">お名前</span>
                    </div>
                    <div class="register-form__field">
                        <div class="register-form__field--text">
                            <input type="text" name="name" placeholder="例:山田 太郎" value="{{ old('name') }}"/>
                        </div>
                        <div class="register-form__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__label-wrapper">
                        <span class="register-form__label">メールアドレス</span>
                    </div>
                    <div class="register-form__field">
                        <div class="register-form__field--text">
                            <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                        </div>
                        <div class="register-form__error">
                            @php
                                $emailError = $errors->first('email');
                            @endphp

                            @if ($emailError === 'メールアドレスを入力してください')
                                <p class="register-form__error">メールアドレスを入力してください</p>
                            @elseif ($emailError === 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください')
                                <p class="register-form__error">メールアドレスは「ユーザー名@ドメイン」形式で入力してください</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__label-wrapper">
                        <span class="register-form__label">パスワード</span>
                    </div>
                    <div class="register-form__field">
                        <div class="register-form__field--text">
                            <input type="password" name="password" placeholder="例:coachtech1106" />
                        </div>
                        <div class="register-form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register-form__button-wrapper">
                    <button class="register-form__button" type="submit">登録</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>