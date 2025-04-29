<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0066cc;
            font-family: Arial, sans-serif;
        }
        .app-container {
            max-width: 420px;
            margin: 20px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            padding-bottom: 60px;
            position: relative;
            min-height: 85vh;
        }
        .header {
            background: #00a0e9;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            position: relative;
        }
        .wifi-name {
            background: #00a0e9;
            color: white;
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .location {
            background: white;
            padding: 15px 20px;
            color: #666;
            text-align: center;
            font-size: 14px;
            line-height: 1.4;
        }
        .checkin-button {
            width: 150px;
            height: 150px;
            background: #00a0e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            margin: 40px auto;
            cursor: pointer;
            border: none;
            position: relative;
        }
        .checkin-button::after {
            content: '';
            position: absolute;
            width: 170px;
            height: 170px;
            border: 2px dashed var(--checkin-border-color, #00a0e9);
            border-radius: 50%;
        }
        .date-time {
            padding: 15px 20px;
            border-top: 1px solid #eee;
        }
        .time-log {
            padding: 15px 20px;
            color: #666;
        }
        .time-log-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .time-log-item i {
            margin-right: 10px;
            color: #00a0e9;
        }
        .current-time {
            text-align: right;
            color: #00a0e9;
            padding: 5px 20px;
            font-weight: bold;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top: 1px solid #eee;
            max-width: 420px;
            margin: 0 auto;
        }
        .nav-item {
            color: #999;
            text-align: center;
            font-size: 12px;
        }
        .nav-item i {
            font-size: 20px;
            margin-bottom: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        @php
            $array_color = ['#27ae60', '#e74c3c', '#e67e22', '#8e44ad'];
        @endphp
        <div class="header" style="background-color: {{ $array_color[$status] }}">
            CHẤM CÔNG
            @if(isset($vao_ra))
                <span>{{ $vao_ra }}</span>
            @endif
        </div>

        <div class="location">
            <i class="fas fa-wifi"></i> DZFullStack<br>
            32 Xuân Diệu, Thuận Phước,<br>
            Hải Châu, Đà Nẵng
        </div>

        <button class="checkin-button"  style="--checkin-border-color: {{$array_color[$status] }}; background-color: {{$array_color[$status] }};">
            CHECKIN
        </button>

        <div class="date-time">
            <i class="far fa-calendar"></i> <span id="current-date">Ngày {{ $today }}</span>
        </div>

        <div class="current-time">
            Hiện tại: <span id="current-time">10:05:44</span>
        </div>

        <div class="time-log">
            <div class="time-log-item">
                <i class="fas fa-building"></i>
                <div>
                    <span style="color: #00a0e9">{{ $time_now }}</span>
                    {!! $message !!}
                </div>
            </div>
            @if(isset($ca_lam))
                <div class="time-log-item">
                    <i class="fas fa-flag"></i>
                    <div>
                        <span style="color: #00a0e9">{{ $ca_lam->gio_vao }}</span>
                        Bắt đầu ca: {{ $ca_lam->ten_ca }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');

            // Format time as HH:mm:ss
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Update time every second
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // Xử lý sự kiện click nút checkin
        document.querySelector('.checkin-button').addEventListener('click', function() {
            // Thêm hiệu ứng khi click
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
        });
    </script>
</body>
</html>
