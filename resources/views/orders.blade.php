<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文書一覧</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
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
        <h1 class="orders-title">注文書一覧</h1>
        <div class="orders-toolbar">
            <div class="search-area">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="注文書No、注文内容、顧客名、電話番号...">
                <button class="filter-btn" onclick="toggleFilter()">
                    <span class="filter-icon">⏷</span>
                </button>
            </div>
        </div>
        <div class="filter-panel" id="filterPanel">
            <div>
                合計金額 <input type="text" class="filter-input" style="width:80px;"> 〜 <input type="text" class="filter-input" style="width:80px;"> 円
            </div>
            <div>
                注文日 <input type="text" class="filter-input" style="width:60px;"> 年
                <input type="text" class="filter-input" style="width:40px;"> 月
                <input type="text" class="filter-input" style="width:40px;"> 日
            </div>
            <div>
                <label><input type="radio" name="status" checked> 未発注</label>
                <label><input type="radio" name="status"> 発注中</label>
                <label><input type="radio" name="status"> 納品済み</label>
            </div>
            <button class="filter-search-btn">検索</button>
        </div>
        <div class="orders-table-area">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>注文書No.</th>
                        <th>顧客</th>
                        <th>注文内容</th>
                        <th>電話番号</th>
                        <th>注文日</th>
                        <th>発注状態</th>
                        <th>合計金額</th>
                        <th>備考</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="circle selected"></span></td>
                        <td>0004</td>
                        <td>大阪情報専門学校様</td>
                        <td><a href="#">この1冊でよくわか...</a></td>
                        <td>06-6974-4611</td>
                        <td>2025/1/17</td>
                        <td>
                            <select>
                                <option>納品済み</option>
                                <option>発注中</option>
                                <option>未発注</option>
                            </select>
                        </td>
                        <td>￥15,000</td>
                        <td>1/22納品予定</td>
                    </tr>
                    <tr>
                        <td><span class="circle"></span></td>
                        <td style="color:red;">0003</td>
                        <td style="color:red;">北海道情報大学様</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <select>
                                <option>未発注</option>
                                <option>発注中</option>
                                <option>納品済み</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- さらに行を追加可能 -->
                </tbody>
            </table>
        </div>
        <div class="orders-btns">
            <a href="{{ url('/order') }}" class="btn create-btn">新規注文書作成</a>
            <button class="btn delete-btn">注文書削除</button>
        </div>
    </div>

    <!-- サイドバー開閉用スクリプト（共通） -->
    <script>
    function toggleFilter() {
        document.getElementById('filterPanel').classList.toggle('show');
    }
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