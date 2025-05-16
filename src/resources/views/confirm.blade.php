<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inika:wght@400;600&display=swap">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo">
                FashionablyLate
            </a>
        </div>
    </header>

    <main>
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2 class="confirm__title">Confirm</h2>
            </div>
            <form class="form" action="/thanks" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                <span class="confirm-table__last-name">{{ $contact['last_name'] }}</span><span class="confirm-table__first-name">{{ $contact['first_name'] }}</span>
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly/>
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                @php
                                    $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
                                @endphp
                                {{ $genderMap[$contact['gender']] }}
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                                <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                                <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                                <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                @php
                                    $category = App\Models\Category::find($contact['category_id']);
                                @endphp
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly />
                                <p>{{ $category->content }}</p>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <textarea class="confirm-table__textarea" name="detail" readonly>{{ $contact['detail'] }}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                    <button type="button" class="form__button-submit--correction" onclick="window.history.back()">修正</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>