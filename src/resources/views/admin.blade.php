<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
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
                <a href="/login" type="submit">logout</a>
            </div>
        </div>
    </header>

    <main>
        <div class="admin-form__content">
            <div class="admin-form__heading">
                <h2 class="admin-form__title">Admin</h2>
            </div>
            <form action="{{ url('/admin') }}" method="GET">
                <div class="admin-form__search">
                    <input name="keyword" class="admin-form__search-text" type="text" placeholder="名前かメールアドレスを入力してください">
                    <div class="admin-form__select">
                        <select name="gender">
                            <option value="" disabled selected {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                    <div class="admin-form__select">
                        <select name="category_id">
                            <option value="" disabled selected {{ request('category_id') === null ? 'selected' : '' }}>お問い合わせの種類</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }} {{ request('category_id') == $category->id ? 'selected' : '' }}">{{ $category->content }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="admin-form__date-picker">
                        <input type="date" name="contact_date" value="{{ request('contact_date') }}">
                    </div>
                    <button class="admin-form__search-button">検索</button>
                    <div class="admin-form__reset-button">
                        <a href="{{ url('/admin') }}">リセット</a>
                    </div>
                </div>
            </form>
            <div class="admin-export-pagination">
                <a class="export-button" href="{{ url('/admin/export') . '?' . http_build_query(request()->except('page')) }}" >エクスポート</a>

                <ul class="pagination">
                    @if ($currentPage > 1)
                        <li><a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">&lt;</a></li>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="{{ $currentPage == $i ? 'active' : '' }}">
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($currentPage < $lastPage)
                        <li><a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}">&gt;</a></li>
                    @endif
                </ul>
            </div>
            <div form class="admin-form__table-wrapper">
                <div class="admin-table">
                    <table>
                        <thead>
                            <tr>
                                <th>お名前</th>
                                <th>性別</th>
                                <th>メールアドレス</th>
                                <th>お問い合わせの種類</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                                    <td>
                                        @if ($contact->gender == 1)
                                            男性
                                        @elseif ($contact->gender == 2)
                                            女性
                                        @else
                                            その他
                                        @endif
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->category->content ?? '不明' }}</td>
                                    <td>
                                        <label for="modal-toggle-{{ $contact->id }}" class="admin-table__detail-button" style="cursor: pointer;">詳細</label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($contacts as $contact)
                        <div class="contact-modal-set">
                            <!-- モーダル開閉用チェックボックス -->
                            <input type="checkbox" id="modal-toggle-{{ $contact->id }}" hidden>

                            <div class="contact-modal__wrapper">
                                <div class="contact-modal" id="modal-{{ $contact->id }}">
                                    <!-- 背景をクリックしたら閉じる -->
                                    <label for="modal-toggle-{{ $contact->id }}" class="contact-modal__background" style="position: fixed; inset: 0;"></label>

                                    <div class="contact-modal__body">
                                        <div class="contact-modal__close-wrap">
                                            <!-- 閉じるボタン -->
                                            <label for="modal-toggle-{{ $contact->id }}" class="contact-modal__close-button">
                                                <span></span><span></span>
                                            </label>
                                        </div>
                                        <div class="contact-modal__content">
                                            <table class="contact-modal__table">
                                                <tr>
                                                    <th>お名前</th>
                                                    <td><span class="last-name">{{ $contact->last_name }}</span>{{ $contact->first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>性別</th>
                                                    <td>{{ ['1'=>'男性','2'=>'女性','3'=>'その他'][$contact->gender] ?? '不明' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>メールアドレス</th>
                                                    <td>{{ $contact->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>電話番号</th>
                                                    <td>{{ $contact->tel }}</td>
                                                </tr>
                                                <tr>
                                                    <th>住所</th>
                                                    <td>{{ $contact->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>建物名</th>
                                                    <td>{{ $contact->building }}</td>
                                                </tr>
                                                <tr>
                                                    <th>お問い合わせの種類</th>
                                                    <td>{{ $contact->category->content ?? '不明' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>お問い合わせ内容</th>
                                                    <td>
                                                        <textarea class="contact-modal__textarea" readonly>{{ $contact->detail }}</textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <form class="contact-modal__delete-form" action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="contact-modal__delete-button">
                                                <button class="delete-form__button-submit" type="submit">削除</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>

</html>