<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>顧客別リードタイム</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/stats_leadtime.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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

    <!-- ヘッダー・検索UI・テーブル -->
    <div class="header">
        <span class="title">顧客別リードタイム</span>
    </div>
    <div class="search-bar-area">
        <input type="text" class="search-bar" placeholder="顧客名で検索">
        <span class="search-icon" onclick="openModal()">🔍</span>
        <button class="filter-btn" onclick="openModal()">⏷</button>
    </div>
    <div class="modal-bg" id="modalBg"></div>
    <div class="search-area-modal" id="searchModal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div>
            <label>リードタイム：</label>
            <input type="text"> 日 〜 <input type="text"> 日
        </div>
        <div style="margin-top:10px;">
            <label>顧客名：</label>
            <input type="text" style="width:180px;">
        </div>
        <button class="search-btn" style="margin-top:18px;">検索</button>
    </div>
    <div class="table-area">
        <table>
            <tr>
                <th>顧客名</th>
                <th>累計リードタイム（日）</th>
                <th>平均リードタイム（日）</th>
                <th>最短</th>
                <th>最長</th>
            </tr>
            <tr>
                <td class="customer-name">大阪情報専門学校</td>
                <td>30</td>
                <td>10</td>
                <td>8</td>
                <td>12</td>
            </tr>
            <tr>
                <td class="customer-name">北海道情報大学</td>
                <td>45</td>
                <td>15</td>
                <td>10</td>
                <td>20</td>
            </tr>
            <!-- 必要に応じて行を追加 -->
        </table>
    </div>

    <!-- サイドバー開閉用スクリプト（共通）＋モーダル用JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // サイドバー要素取得
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
    // モーダル
    function openModal() {
        document.getElementById('searchModal').style.display = 'block';
        document.getElementById('modalBg').style.display = 'block';
    }
    function closeModal() {
        document.getElementById('searchModal').style.display = 'none';
        document.getElementById('modalBg').style.display = 'none';
    }
    </script>
</body>
</html>