<html>
        <head>
                <title>{{ Lang::get('web-artisan::webartisan.title') }}</title>
                <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
                <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

                <link rel="stylesheet" type="text/css" href="{{ asset('packages/jones/web-artisan/css/style.css') }}" media="screen" title="Default" />

                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                <script type="text/javascript" src="{{ asset('packages/jones/web-artisan/js/jquery.hotkeys-0.7.9.js') }}"></script>
                <script type="text/javascript" src="{{ asset('packages/jones/web-artisan/js/jquery.browser.js') }}"></script>
                <script type="text/javascript" src="{{ asset('packages/jones/web-artisan/js/jquery.konami.js') }}"></script>
                <script type="text/javascript" src="{{ asset('packages/jones/web-artisan/js/cli.js') }}"></script>
                <script type="text/javascript" src="{{ asset('packages/jones/web-artisan/js/app.js') }}"></script>
        </head>
        <body>
                <div id="screen">
                        <div id="display">
                                <div id="welcome">
                                        <h1>{{ Lang::get('web-artisan::webartisan.terminal.header') }}</h1>
                                </div>
                                <noscript>
                                <p>{{ Lang::get('web-artisan::webartisan.terminal.no_js') }}</p>
                                </noscript>
                        </div>
                        <div id="bottomline">
                                <span id="inputline"><span id="prompt"></span><span id="lcommand"></span><span id="cursor" >&nbsp;</span><span id="rcommand"></span></span><span id="spinner"></span>
                        </div>
                </div>
                <script type="text/javascript">
                        base_url = '{{ Request::getSchemeAndHttpHost() }}{{ Request::server('REQUEST_URI') }}/';
                        token = '{{ Session::getToken() }}';
                        debug = '{{ Config::get('app.debug') }}';
                        js_error = '{{ str_replace('\'', '\\\'', Lang::get('web-artisan::webartisan.terminal.js_error')) }}';
                </script>
        </body>
</html>