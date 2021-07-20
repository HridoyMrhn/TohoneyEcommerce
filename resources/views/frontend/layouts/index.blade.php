@extends('frontend.master-home')

@section('css')
    <style>
        #del-countdown {
        width: 600px;
        margin: 15% auto;
        }

        #clock span {
            float: left;
            text-align: center;
            font-size: 60px;
            margin: 0 2.5%;
            color: #ffffff;
            padding: 20px;
            width: 20%;
            border-radius: 20px;
            box-sizing: border-box;
        }

        #clock span:nth-child(1) {
            background: #C70039;
        }

        #clock span:nth-child(2) {
            background: #FF5733;
        }

        #clock span:nth-child(3) {
            background: #FFC300;
        }

        #clock span:nth-child(4) {
            background: #C9E498;
        }

        #clock:after {
            content: "";
            display: block;
            clear: both;
        }

        #units span {
            float: left;
            width: 25%;
            text-align: center;
            margin-top: 30px;
            color: #D7DBDD;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 2px;
            text-shadow: 1px 1px 1px rgba(10, 10, 10, 0.7)
        }

        span.turn {
            animation: turn 0.5s ease forwards;
        }

        @keyframes turn {
            0% {
                transform: rotateY(0deg)
            }

            100% {
                transform: rotateY(360deg)
            }
        }
    </style>
@endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

@include('frontend.layouts.component.slider')
@include('frontend.layouts.component.featured')

<!-- start count-down-section -->
<div class="count-down-area count-down-area-sub">
    <section class="count-down-section section-padding parallax" data-speed="7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 text-center">
                    <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                </div>
                <div class="col-12 col-lg-12 text-center">
                    <div class="count-down-clock text-center">
                        <div id="clock">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end count-down-section -->

@include('frontend.layouts.component.best-seller')
@include('frontend.layouts.component.product')
@include('frontend.layouts.component.testimonial')
@endsection

@section('js')
    <script>
        const updateTimer = (deadline) => {
        // calculates time left until deadline
        const time = deadline - new Date();
            return {
                'days': Math.floor(time / (1000 * 60 * 60 * 24)),
                'hours': Math.floor((time / (1000 * 60 * 60)) % 24),
                'minutes': Math.floor((time / (1000 * 60)) % 60),
                'seconds': Math.floor((time / (1000)) % 60),
                'total': time
            };
        }

        const animateClock = (span) => {
            // animation lasts for 0.5 seconds
            span.className = 'turn';
            setTimeout(() => {
                span.className = '';
            }, 500);
        }

        const startTimer = (id, deadline) => {
            // calls updateTimer every second
            const timeInterval = setInterval(() => {
                const clock = document.getElementById(id);
                let timer = updateTimer(deadline);

                clock.innerHTML =
                    '<span>' + timer.days + '</span>' +
                    '<span>' + timer.hours + '</span>' +
                    '<span>' + timer.minutes + '</span>' +
                    '<span>' + timer.seconds + '</span>';

                const spans = clock.getElementsByTagName("span");
                animateClock(spans[3]);
                if (timer.seconds == 59) animateClock(spans[2]);
                if (timer.minutes == 59 && timer.seconds == 59) animateClock(spans[1]);
                if (timer.minutes == 23 && timer.minutes == 59 && timer.seconds == 59) animateClock(spans[0]);

                // check if deadline has passed
                if (timer.total < 1) {
                    clearInterval(timeInterval);
                    clock.innerHTML =
                        '<span>0</span><span>0</span><span>0</span><span>0</span>';
                }

            }, 1000);
        }

        window.onload = () => {
            const deadline = new Date("December 23, 2022 13:00:00");
            startTimer("clock", deadline)
        };
    </script>
@endsection
