<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rkun | رُكن</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: "Courier New", Courier, monospace;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                font-weight: bold;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 110px;
                font-weight: 800;
                letter-spacing: -2px;
                color: #222;
                margin-bottom: 0.5rem;
                font-family: 'SF Pro Display', 'Nunito', 'Segoe UI', Arial, sans-serif;
                line-height: 1.05;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .project-name {
                font-size: 2.8rem;
                font-weight: 700;
                color: #2874A6;
                letter-spacing: 0.01em;
                margin-bottom: 2.5rem;
                font-family: 'SF Pro Display', 'Nunito', 'Segoe UI', Arial, sans-serif;
            }
            .logo-apple-style {
                width: 240px;
                height: 240px;
                margin-bottom: 1.2rem;
                filter: drop-shadow(0 8px 32px rgba(40,116,166,0.18));
                display: block;
            }
            body {
                background: linear-gradient(120deg, #f8fafc 0%, #e3eef7 100%);
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md text-success d-flex flex-column align-items-center">
                    <div>
                        <!-- Custom SVG Logo -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="logo-apple-style">
                          <style>.st1{fill:#2874A6}</style>
                          <g transform="translate(50 50) scale(0.3)">
                            <path d="M102.24 248.11c-4.12 0-7.64-2.96-8.35-7.02L57.23 33.2a10.28 10.28 0 00-7.1-8.06l-16.37-5.09c-4.49-1.35-7.03-6.09-5.68-10.58s6.09-7.03 10.58-5.68c.05.01.1.03.15.05l16.37 5.09a27.216 27.216 0 0118.78 21.33l36.65 207.88c.82 4.62-2.27 9.02-6.88 9.84-.5.08-1 .13-1.49.13zm40.36 28.26c-4.69 0-8.49-3.8-8.49-8.49 0-4.12 2.96-7.65 7.02-8.36l150.61-26.56c5.62-.95 9.4-6.28 8.45-11.9-.95-5.62-6.28-9.4-11.9-8.45-.04.01-.09.01-.13.02l-129.35 22.81c-14.85 2.62-29.01-7.3-31.63-22.14l-22.8-129.35c-2.62-14.85 7.3-29.01 22.14-31.63l129.35-22.81c14.85-2.62 29.01 7.3 31.63 22.14l21.11 119.73a8.488 8.488 0 01-7.02 9.74c-4.54.74-8.84-2.28-9.7-6.8L270.78 54.61c-.99-5.61-6.34-9.36-11.95-8.37l-129.36 22.8c-5.61.99-9.36 6.34-8.37 11.95l22.81 129.35c.99 5.61 6.34 9.36 11.95 8.37h.01l129.35-22.81c14.8-2.87 29.13 6.8 32 21.61 2.87 14.8-6.8 29.13-21.61 32-.3.06-.61.11-.91.16l-150.61 26.56c-.49.1-.99.14-1.49.14z" class="st1"/>
                            <path d="M176.77 111.21c-4.69 0-8.49-3.8-8.49-8.49 0-4.12 2.96-7.65 7.02-8.36l49.11-8.66c4.62-.81 9.02 2.27 9.83 6.89.81 4.62-2.27 9.02-6.89 9.83l-49.11 8.66c-.48.09-.97.13-1.47.13z" fill="#2874A6"/>
                            <path d="M118.89 292.57c-18.75 0-33.95-15.21-33.95-33.96s15.21-33.95 33.96-33.95 33.95 15.21 33.95 33.96c0 16.46-11.81 30.55-28.02 33.43-1.96.35-3.95.52-5.94.52zm.1-50.75c-1 0-1.99.09-2.97.26-9.14 1.63-15.24 10.36-13.61 19.5 1.63 9.14 10.36 15.24 19.5 13.61 9.14-1.63 15.24-10.36 13.61-19.5a16.806 16.806 0 00-16.53-13.87z" class="st1"/>
                          </g>
                        </svg>
                    </div>
                    <div class="project-name"><span style="color:#636b6f;font-weight:900;float:right;">رُكن</span> <span style="color:#2874A6;font-weight:900;">Rkun -</span></div>
                    @if (Route::has('login'))
                        <div class="d-flex justify-content-center w-100 mt-3">
                            @auth
                                <a class="btn btn-success btn-lg rounded-pill shadow-sm px-5 py-3 mx-auto" style="background-color:#2874A6;border-color:#2874A6;" href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn btn-success btn-lg rounded-pill shadow-sm px-5 py-3 mx-auto" style="background-color:#2874A6;border-color:#2874A6;" href="{{ route('login') }}">Login</a>
                            @endauth
                        </div>
                    @endif
                </div>
                <!-- حذف القسم المكرر للزر -->
            </div>
        </div>
    </body>
</html>
