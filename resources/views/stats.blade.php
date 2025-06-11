<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>統計情報管理</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stats.css') }}">
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

    <!-- メインコンテンツ -->
    <div class="main" id="main">
        <h1>統計情報管理</h1>
        <a class="btn-stat" href="{{ url('/stats/sales') }}">顧客別累計売上</a>
        <a class="btn-stat" href="{{ url('/stats/leadtime') }}">顧客別リードタイム</a>
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