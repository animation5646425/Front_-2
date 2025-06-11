<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>顧客納品書一覧</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/deliveries.css') }}">
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

    <!-- メインコンテンツ -->
    <div class="main" id="main">
        <h1>顧客納品書一覧</h1>
        <div class="search-bar">
            <input type="text" placeholder="納品書No.,顧客,納品内容,合計金額,電話番号,納品日,納品状態,リードタイム,備考">
            <button>検索</button>
        </div>
        <table>
            <tr>
                <th></th>
                <th>納品書No.</th>
                <th>顧客</th>
                <th>納品内容</th>
                <th>合計金額</th>
                <th>電話番号</th>
                <th>納品日</th>
                <th>納品状態</th>
                <th>リードタイム</th>
                <th>備考</th>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>1001</td>
                <td>商品B</td>
                <td>佐藤花子</td>
                <td>080-xxxx-xxxx</td>
                <td>2025/05/21</td>
                <td>納品日</td>
                <td>納品状態</td>
                <td>リードタイム</td>
                <td>備考</td>
            </tr>
            <!-- サンプルデータ行を追加可能 -->
        </table>
        <div style="text-align:center;">
            <a href="{{ url('/delivery') }}" class="btn create">新規納品書作成</a>
            <button class="btn delete">納品書削除</button>
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