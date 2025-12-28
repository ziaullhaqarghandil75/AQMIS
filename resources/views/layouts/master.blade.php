<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!-- head section -->

    @include('layouts.head')
    @stack('style')
    @yield('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dataTables_filter {
        float: right;
        text-align: right;
    }

    .d-flex {
        display: flex;
        align-items: center;
        gap: 10px;
        /* فاصله بین عناصر */
    }

    .timer-container {
        display: inline-block;
        padding: 15px 25px;
        border: 2px solid #4caf50;
        /* رنگ سبز زیبا */
        border-radius: 10px;
        background-color: #f9f9f9;
        /* پس‌زمینه روشن */
        font-family: 'Arial', sans-serif;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* سایه ملایم */
    }

    .timer-container h4 {
        margin: 0 0 10px;
        font-size: 1.1rem;
        color: #333;
    }

    .timer {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4caf50;
        margin: 0 0 0 7px;

        /* رنگ سبز */
    }

    .timer span {
        min-width: 30px;
        display: inline-block;
        text-align: center;
    }
</style>

<body>

    <!-- Main navbar -->
    @include('layouts.header')
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        @include('layouts.sidebar')
        <!-- /main sidebar -->
        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    @include('layouts.script')
    @stack('script')
    @yield('script')
    @php
        $sessionLifetime = config('session.lifetime');

        $timerDuration = $sessionLifetime * 60;
    @endphp
    <script>
        let timeRemaining = @json($timerDuration);

        function startTimer(duration) {
            const hoursElement = document.getElementById('hours');
            const minutesElement = document.getElementById('minutes');
            const secondsElement = document.getElementById('seconds');

            let timer = duration;

            const countdown = setInterval(() => {
                const hours = Math.floor(timer / 3600);
                const minutes = Math.floor((timer % 3600) / 60);
                const seconds = timer % 60;

                hoursElement.textContent = hours < 10 ? '0' + hours : hours;
                minutesElement.textContent = minutes < 10 ? '0' + minutes : minutes;
                secondsElement.textContent = seconds < 10 ? '0' + seconds : seconds;

                if (--timer < 2) {
                    clearInterval(countdown);
                    logoutUser();
                }
            }, 1000);
        }

        function logoutUser() {
            document.getElementById('logout-form').submit();
        }

        startTimer(timeRemaining);
    </script>

</body>
</html>
