<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文書（A4）</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
</head>
<body>
    <!-- ハンバーガーメニューボタン -->
    <div class="menu-btn" id="menuBtn">☰</div>
    <!-- サイドバー背景（モーダル用） -->
    <div class="sidebar-bg" id="sidebarBg" style="display:none;"></div>
    <!-- サイドバー -->
    <div class="sidebar" id="sidebar" style="display:none;">
        <span class="sidebar-close" id="sidebarClose">&times;</span>
        <ul>
            <li><a href="{{ url('/home') }}"><span style="font-size:1.2em;">&#8962;</span> <b>HOME</b></a></li>
            <li><a href="{{ url('/orders') }}">・注文書一覧</a></li>
            <li><a href="{{ url('/deliveries') }}">・顧客納品書一覧</a></li>
            <li><a href="{{ url('/stats') }}">・統計情報一覧</a></li>
            <li><a href="{{ url('/trash') }}">・ゴミ箱</a></li>
        </ul>
    </div>

    <!-- A4注文書本体 -->
    <div class="a4-sheet">
        <h1 class="order-title">注文書</h1>
        <!-- 宛先・発注情報 -->
        <div class="order-info-row">
            <div class="order-to">
                <div class="order-to-name"><input type="text" class="input-line" placeholder="宛先名"></div>
                <div class="order-to-etc"><input type="text" class="input-line" placeholder="御中"></div>
            </div>
            <div class="order-meta">
                <div>発注No.：<input type="text" class="input-meta" placeholder="XXXXXXX"></div>
                <div>発注日：<input type="date" class="input-meta"></div>
            </div>
        </div>
        <div class="order-message">下記の通り、発注致します。</div>
        <!-- 納品先住所・合計金額 -->
        <div class="order-address-row">
            <div class="order-address">
                <div>納品先：</div>
                <div>
                    〒<input type="text" class="input-meta" style="width:80px;" placeholder="郵便番号"><br>
                    <input type="text" class="input-meta" style="width:220px;" placeholder="住所"><br>
                    <input type="text" class="input-meta" style="width:120px;" placeholder="会社名"><br>
                    TEL：<input type="text" class="input-meta" style="width:120px;" placeholder="電話番号"><br>
                    FAX：<input type="text" class="input-meta" style="width:120px;" placeholder="FAX"><br>
                    担当者：<input type="text" class="input-meta" style="width:120px;" placeholder="担当者名">
                </div>
            </div>
            <div class="order-total">
                <div>合計金額：</div>
                <div>
                    <input type="number" class="input-total" placeholder="0"> 円（税込）
                </div>
            </div>
        </div>
        <!-- 注文明細テーブル -->
        <table class="order-table">
            <tr>
                <th>No.</th>
                <th>品目</th>
                <th>数量</th>
                <th>単価</th>
                <th>金額</th>
                <th>備考</th>
            </tr>
            @for($i=1; $i<=12; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td><input type="text" name="item{{ $i }}"></td>
                <td><input type="number" name="qty{{ $i }}"></td>
                <td><input type="number" name="price{{ $i }}"></td>
                <td><input type="number" name="amount{{ $i }}"></td>
                <td><input type="text" name="note{{ $i }}"></td>
            </tr>
            @endfor
            <tr>
                <td colspan="4" class="right">小計</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
            <tr>
                <td colspan="4" class="right">消費税</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
            <tr>
                <td colspan="4" class="right">合計金額</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
        </table>
        <!-- 備考欄 -->
        <div class="note-area">
            <label>備考：</label>
            <textarea rows="3"></textarea>
        </div>
        <!-- ボタンエリア -->
        <div class="btn-area">
            <button type="submit" class="btn">保存</button>
            <button type="button" class="btn" onclick="window.print()">印刷</button>
        </div>
    </div>

    <!-- サイドバー開閉用スクリプト（共通） -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // 要素取得
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menuBtn');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarBg = document.getElementById('sidebarBg');

        // サイドバーを開く
        function openSidebar() {
            sidebar.classList.add('open');
            sidebar.style.display = 'block';
            sidebarBg.classList.add('show');
            sidebarBg.style.display = 'block';
            document.body.classList.add('sidebar-open');
            menuBtn.style.display = 'none'; // サイドバー表示中はボタン非表示
        }
        // サイドバーを閉じる
        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebar.style.display = 'none';
            sidebarBg.classList.remove('show');
            sidebarBg.style.display = 'none';
            document.body.classList.remove('sidebar-open');
            menuBtn.style.display = 'flex'; // サイドバー閉じたらボタン表示
        }

        // イベント登録
        menuBtn.addEventListener('click', function (e) {
            openSidebar();
            e.stopPropagation();
        });
        sidebarClose.addEventListener('click', closeSidebar);
        sidebarBg.addEventListener('click', closeSidebar);

        // ESCキーでサイドバーを閉じる
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSidebar();
        });
    });
    </script>
</body>
</html>