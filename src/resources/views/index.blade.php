<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inika:wght@400;600&display=swap">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo">
                    FashionablyLate
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2 class="contact-form__title">Contact</h2>
            </div>
            <form class="contact-form__form" action="/thanks/confirm" method="post" novalidate>
                @csrf
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">お名前</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--name">
                            <label class="contact-form__field--name--last_name">
                                <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}"/>
                                <div class="form__error">
                                    @if ($errors->has('last_name'))
                                        <p>{{ $errors->first('last_name') }}</p>
                                    @endif
                                </div>
                            </label>
                            <label class="contact-form__field--name--first_name">
                                <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}"/>
                                <div class="contact-form__error">
                                    @if ($errors->has('first_name'))
                                        <p>{{ $errors->first('first_name') }}</p>
                                    @endif
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">性別</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--gender">
                            <label class="contact-form__radio">
                                <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}/>
                                <span class="contact-form__custom-radio">男性</span></label>
                            <label class="contact-form__radio">
                                <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}/>
                                <span class="contact-form__custom-radio">女性</span></label>
                            <label class="contact-form__radio">
                                <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}/>
                                <span class="contact-form__custom-radio">その他</span>
                            </label>
                        </div>
                        <div class="contact-form__error">
                            @error('gender')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">メールアドレス</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--email">
                            <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                        </div>
                        <div class="contact-form__error">
                            @php
                                $emailError = $errors->first('email');
                            @endphp

                            @if ($emailError === 'メールアドレスを入力してください')
                                <p class="contact-form__error">メールアドレスを入力してください</p>
                            @elseif ($emailError === 'メールアドレスはメール形式で入力してください')
                                <p class="contact-form__error">メールアドレスはメール形式で入力してください</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">電話番号</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--tel">
                            <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}"/><label>-</label>
                            <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}"/><label>-</label>
                            <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}"/>
                        </div>
                        <div class="contact-form__error">
                            @php
                                $telErrors = collect([
                                    $errors->first('tel1'),
                                    $errors->first('tel2'),
                                    $errors->first('tel3'),
                                ])->filter();

                                $requiredError = $telErrors->contains('電話番号を入力してください');
                                $formatError = $telErrors->contains('電話番号は5桁までの数字で入力してください');
                            @endphp

                            @if ($requiredError)
                                <p class="contact-form__error">電話番号を入力してください</p>
                            @elseif ($formatError)
                                <p class="contact-form__error">電話番号は5桁までの数字で入力してください</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">住所</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--address">
                            <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}"/>
                        </div>
                        <div class="contact-form__error">
                            @error('address')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">建物名</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--building">
                            <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}"/>
                        </div>
                        <div class="contact-form__error">
                            @error('building')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">お問い合わせの種類</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--select">
                            <select class="contact-form__field--select--item" name="category_id" >
                                <option value="" disabled selected>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" value="{{ old('category_id') }}">{{ $category->content }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contact-form__error">
                            @error('category_id')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-form__group">
                    <div class="contact-form__label-wrapper">
                        <span class="contact-form__label">お問い合わせ内容</span>
                        <span class="contact-form__required">※</span>
                    </div>
                    <div class="contact-form__field">
                        <div class="contact-form__field--textarea">
                            <textarea  name="detail" placeholder="お問い合わせ内容をご記載くださ"></textarea>
                        </div>
                        <div class="contact-form__error">
                            @error('detail')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-form__button-wrapper">
                    <button class="contact-form__button" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>