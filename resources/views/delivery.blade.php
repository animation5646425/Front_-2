<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>納品書（A4）</title>
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

    <!-- A4納品書本体 -->
    <div class="a4-sheet">
        <h1 class="order-title">納品書</h1>
        <!-- 納品先・納品情報 -->
        <div class="order-info-row">
            <div class="order-to">
                <!-- 宛先名・御中など（必要に応じて追加） -->
            </div>
            <div class="order-meta">
                <!-- 納品No・納品日など（必要に応じて追加） -->
            </div>
        </div>
        <div class="order-message">下記の通り、納品致します。</div>
        <!-- 納品先住所・合計金額 -->
        <div class="order-address-row">
            <div class="order-address">
                <!-- 住所等（必要に応じて追加） -->
            </div>
            <div class="order-total">
                <!-- 合計金額等（必要に応じて追加） -->
            </div>
        </div>
        <!-- 納品明細テーブル -->
        <table class="order-table">
            <tr>
                <!-- ヘッダー（必要に応じて追加） -->
            </tr>
            @for($i=1; $i<=12; $i++)
            <tr>
                <!-- 明細行（必要に応じて追加） -->
            </tr>
            @endfor
            <tr></tr>
            <tr></tr>
            <tr></tr>
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