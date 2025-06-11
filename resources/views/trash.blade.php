<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ゴミ箱</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .sidebar {
            width: 300px;
            background: black;
            color: white;
            padding: 30px 0 0 0;
            position: fixed;
            top: 0;
            left: -320px;
            height: 100%;
            transition: left 0.3s;
            z-index: 100;
        }
        .sidebar.show { left: 0; }
        .sidebar ul { list-style: disc inside; padding: 0 0 0 30px; }
        .sidebar li { margin: 40px 0; font-size: 2.2rem; }
        .sidebar a { color: white; text-decoration: underline; }
        .main { margin-left: 0; padding: 20px; transition: margin-left 0.3s; }
        .main.shift { margin-left: 300px; }
        .menu-btn {
            font-size: 36px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 200;
        }
        h1 { font-size: 2.5rem; margin-left: 60px; }
        .notification {
            position: absolute;
            right: 40px;
            top: 30px;
            cursor: pointer;
        }
        .bell {
            font-size: 36px;
            position: relative;
        }
        .red-dot {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            text-align: center;
            font-size: 14px;
            line-height: 22px;
            font-weight: bold;
        }
        .search-bar {
            margin: 30px 0 10px 60px;
        }
        .search-bar input {
            font-size: 1.2rem;
            padding: 5px 10px;
            width: 300px;
        }
        .search-bar button {
            font-size: 1.2rem;
            padding: 5px 20px;
            margin-left: 10px;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background: #fff;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 4px;
            text-align: center;
        }
        th {
            background: #eee;
        }
        .btn {
            padding: 10px 30px;
            margin: 20px 10px;
            font-size: 1.1rem;
            border-radius: 6px;
            border: 2px solid #333;
            background: #fff;
            cursor: pointer;
        }
        .btn.restore {
            background: #fff;
            color: #333;
        }
        .btn.delete {
            background: #e53935;
            color: #fff;
            border: none;
        }
        /* モーダル風 */
        .modal-bg {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 999;
        }
        .modal {
            background: #fff;
            border: 2px solid #333;
            border-radius: 10px;
            width: 320px;
            margin: 120px auto 0 auto;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        .modal .btn {
            margin: 10px 20px;
        }
        .toast {
            display: none;
            position: fixed;
            top: 30px;
            right: 40px;
            background: #2196f3;
            color: #fff;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 1.1rem;
            z-index: 2000;
        }
        .toast.red { background: #e53935; }
    </style>
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
    <div class="main" id="main">
        <h1>ゴミ箱</h1>
        <div class="search-bar">
            <input type="text" placeholder="注文番号、納品書番号、内容、顧客名、電話番号">
            <button>検索</button>
        </div>
        <table>
            <tr>
                <th></th>
                <th>種別</th>
                <th>番号</th>
                <th>内容</th>
                <th>顧客名</th>
                <th>日付</th>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>注文書</td>
                <td>0001</td>
                <td>商品A</td>
                <td>山田太郎</td>
                <td>2025/05/21</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>納品書</td>
                <td>1001</td>
                <td>商品B</td>
                <td>佐藤花子</td>
                <td>2025/05/21</td>
            </tr>
        </table>
        <div style="text-align:center;">
            <button class="btn restore" onclick="showModal('restore')">復元</button>
            <button class="btn delete" onclick="showModal('delete')">削除</button>
        </div>
    </div>

    <!-- モーダル -->
    <div class="modal-bg" id="modal-bg">
        <div class="modal" id="modal-content">
            <!-- JSで内容を切り替え -->
        </div>
    </div>
    <!-- トースト通知 -->
    <div class="toast" id="toast"></div>
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
        function showModal(type) {
            const modalBg = document.getElementById('modal-bg');
            const modalContent = document.getElementById('modal-content');
            if(type === 'restore') {
                modalContent.innerHTML = `
                    <div>復元しますか？</div>
                    <button class="btn" onclick="doRestore()">はい</button>
                    <button class="btn" onclick="closeModal()">いいえ</button>
                `;
            } else {
                modalContent.innerHTML = `
                    <div>本当に削除しますか？</div>
                    <button class="btn delete" onclick="doDelete()">はい</button>
                    <button class="btn" onclick="closeModal()">いいえ</button>
                `;
            }
            modalBg.style.display = 'block';
        }
        function closeModal() {
            document.getElementById('modal-bg').style.display = 'none';
        }
        function doRestore() {
            closeModal();
            showToast('納品書No. 0001復元しました。');
        }
        function doDelete() {
            closeModal();
            showToast('納品書No. 0001削除しました。', true);
        }
        function showToast(msg, isRed) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.className = 'toast' + (isRed ? ' red' : '');
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 2500);
        }
    </script>
</body>
</html>