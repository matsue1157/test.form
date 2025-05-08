<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate 管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Bootstrap & jQuery（CDN使用）-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container d-flex justify-content-between">
            <h1 class="h3"><a href="/" class="text-white text-decoration-none">FashionablyLate</a></h1>
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
            @endif
        </div>
    </header>

    <main class="container py-4">
        <!-- 検索フォーム -->
        <form method="GET" action="{{ route('admin.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label>名前：</label>
                <input type="text" name="name" value="{{ request('name') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label>メールアドレス：</label>
                <input type="email" name="email" value="{{ request('email') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label>性別：</label>
                <select name="gender" class="form-select">
                    <option value="">すべて</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
                    <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="col-md-2">
                <label>お問い合わせの種類：</label>
                <select name="category" class="form-select">
                    <option value="">すべて</option>
                    <option value="資料請求" {{ request('category') == '資料請求' ? 'selected' : '' }}>資料請求</option>
                    <option value="ご相談" {{ request('category') == 'ご相談' ? 'selected' : '' }}>ご相談</option>
                    <option value="その他" {{ request('category') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>年月日：</label>
                <div class="d-flex">
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control me-1">
                    <span class="mx-1">〜</span>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control ms-1">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">検索</button>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">リセット</a>
            </div>
        </form>

        <!-- 一覧表示 -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メール</th>
                    <th>性別</th>
                    <th>種類</th>
                    <th>登録日</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->family_name }} {{ $contact->given_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->gender }}</td>
                        <td>{{ $contact->category }}</td>
                        <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                                data-id="{{ $contact->id }}" data-name="{{ $contact->family_name }} {{ $contact->given_name }}"
                                data-email="{{ $contact->email }}" data-category="{{ $contact->category }}">
                                詳細
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- モーダル -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">詳細情報</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>名前：</strong> <span id="modalName"></span></p>
                        <p><strong>メール：</strong> <span id="modalEmail"></span></p>
                        <p><strong>種類：</strong> <span id="modalCategory"></span></p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- モーダル制御スクリプト -->
    <script>
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const category = button.getAttribute('data-category');

            detailModal.querySelector('#modalName').textContent = name;
            detailModal.querySelector('#modalEmail').textContent = email;
            detailModal.querySelector('#modalCategory').textContent = category;
            detailModal.querySelector('#deleteForm').setAttribute('action', `/admin/contacts/${id}`);
        });
    </script>
</body>

</html>