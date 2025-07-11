<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>納品書（A4）</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
</head>
<body>
    <div class="menu-btn" id="menuBtn">☰</div>
    <div class="sidebar-bg" id="sidebarBg"></div>
    <div class="sidebar" id="sidebar">
        <span class="sidebar-close" id="sidebarClose">&times;</span>
        <ul>
            <li><a href="{{ url('/home') }}"><span style="font-size:1.2em;">&#8962;</span> <b>HOME</b></a></li>
            <li><a href="{{ url('/orders') }}">・注文書一覧</a></li>
            <li><a href="{{ url('/deliveries') }}">・顧客納品書一覧</a></li>
            <li><a href="{{ url('/stats') }}">・統計情報一覧</a></li>
            <li><a href="{{ url('/trash') }}">・ゴミ箱</a></li>
        </ul>
    </div>
    <div class="a4-sheet">
        <h1 class="order-title">納品書</h1>
        <div class="order-info-row">
            <div class="order-to">
                <div class="order-to-name"><input type="text" class="input-line" placeholder="宛先名"></div>
                <div class="order-to-etc"><input type="text" class="input-line" placeholder="御中"></div>
            </div>
            <div class="order-meta">
                <div>納品No.：<input type="text" class="input-meta" placeholder="XXXXXXXXXX"></div>
                <div>納品日：<input type="date" class="input-meta"></div>
            </div>
        </div>
        <div class="order-message">
            下記の通り、納品致します。
        </div>
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
        <table class="order-table">
            <tr>
                <th>No.</th>
                <th>品目</th>
                <th>数量</th>
                <th>単位</th>
                <th>単価</th>
                <th>金額</th>
                <th>備考</th>
            </tr>
            @for($i=1; $i<=12; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td><input type="text" name="item{{ $i }}"></td>
                <td><input type="number" name="qty{{ $i }}"></td>
                <td><input type="text" name="unit{{ $i }}"></td>
                <td><input type="number" name="price{{ $i }}"></td>
                <td><input type="number" name="amount{{ $i }}"></td>
                <td><input type="text" name="note{{ $i }}"></td>
            </tr>
            @endfor
            <tr>
                <td colspan="5" class="right">小計</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
            <tr>
                <td colspan="5" class="right">消費税</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
            <tr>
                <td colspan="5" class="right">合計金額</td>
                <td colspan="2"><input type="number" class="input-total"></td>
            </tr>
        </table>
        <div class="note-area">
            <label>備考：</label>
            <textarea rows="3"></textarea>
        </div>
        <div class="btn-area">
            <button type="submit" class="btn">保存</button>
            <button type="button" class="btn" onclick="window.print()">印刷</button>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menuBtn');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarBg = document.getElementById('sidebarBg');

        function openSidebar() {
            sidebar.classList.add('open');
            sidebarBg.classList.add('show');
        }
        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebarBg.classList.remove('show');
        }

        menuBtn.addEventListener('click', function (e) {
            openSidebar();
            e.stopPropagation();
        });
        sidebarClose.addEventListener('click', closeSidebar);
        sidebarBg.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSidebar();
        });
    });
    </script>
</body>
</html>