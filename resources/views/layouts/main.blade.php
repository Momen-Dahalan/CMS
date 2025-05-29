<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <link href="{!!asset('theme/css/sb-admin-2.min.css')!!}" rel="stylesheet">


    <style>
        body {
            font-family: "Cairo", serif;
            background-color: #f0f0f0;
        }

        a { 
            text-decoration: none !important; 
            color: black;
        }

        
        ol, ul, menu {
                list-style: decimal !important;
                padding-right: 2rem !important;
            }

            ul, menu {
                list-style: inside !important;
                padding-right: 2rem !important;
            }

      

        .file-area:hover .input-title {
            background: rgba(255, 255, 255, 0.1);
        }

        .input-group {
            position: relative;
        }

        .custom-file-label {
            cursor: pointer; /* تغيير شكل المؤشر عند المرور */
        }

        .input-title {
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border: 2px dashed rgba(0, 0, 0, 0.5);
            border-radius: 5px; /* زوايا دائرية */
            text-align: center;
            transition: background 0.3s ease-in-out;
        }

        .input-title:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0; /* إخفاء الحقل الأصلي */
            cursor: pointer; /* تغيير شكل المؤشر */
        }
        

    </style>

    @yield('style')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body dir="rtl" style="text-align: right">
    
    <div>
        @include('partials.navbar')
    </div>

    <main class="py-4 mb-5">
        <div class="container">
            <div class="row">
                @include('alerts.success')
                @yield('content')
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1e00477b53.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('dee1e6c9cb26094aedbb', {
          cluster: 'mt1'
        });
    
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          alert(JSON.stringify(data));
        });
      </script>


    <script src="{!!asset('theme/js/sb-admin-2.min.js')!!}"></script>


    <script type="module">
        @if (Auth::check())
            var post_userId = {{ auth()->user()->id }};
            
            Echo.private('real-notification.' + post_userId)
            .listen('CommentNotification', (data) => {
                var notificationWrapper = $('.alert-dropdown');
                var notificationToggle = notificationWrapper.find('a[data-bs-toggle]');
                var notificationCountEle = notificationToggle.find('span[data-count]');
                var notificationCount = parseInt(notificationCountEle.text());
                var notification = notificationWrapper.find('div.alert-body');
    
                var existingNotification = notification.html();
                var newNotificationHtml = '<a class="dropdown-item d-flex align-items-center" href="#">\
                    <div class="ml-3">\
                        <div>\
                            <img style="float:right" src="'+data.user_image+'" width="50px" class="rounded-full"/>\
                        </div>\
                        <div>\
                            <div class="small text-gray-500">'+data.date+'</div>\
                            <span>'+data.user_name+' وضع تعليقا على المنشور <b>'+data.post_title+'</b></span>\
                        </div>\
                    </div>\
                    </a>';
    
                notification.html(newNotificationHtml + existingNotification);
                notificationCount += 1;
                notificationWrapper.find('.notif-count').text(notificationCount);
                notificationWrapper.show();
            });
            
        @endif
    </script>






<script>
    var token = '{{ Session::token() }}';
    var urlNotify = '{{ route('notification') }}';

    $('#alertsDropdown').on('click', function(event) {
        event.preventDefault();
        var notificationsWrapper = $('.alert-dropdown');
        var notificationsToggle = notificationsWrapper.find('a[data-bs-toggle]');
        var notificationsCountElem = notificationsToggle.find('span[data-count]');
        
        notificationsCount = 0;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();

        $.ajax({
            method: 'POST',
            url: urlNotify,
            data: {
                _token: token
            },
            success : function(data) {
                var resposeNotifications = "";
                $.each(data.someNotifications , function(i, item) {
                    var post_slug = "{{ route('post.show', ':post_slug') }}";
                    post_slug = post_slug.replace(':post_slug', item.post_slug);
                    resposeNotifications += '<a class="dropdown-item d-flex align-items-center" href='+post_slug+'>\
                                                <div class="ml-3">\
                                                    <div">\
                                                        <img style="float:right" src='+item.user_image+' width="50px" class="rounded-full"/>\
                                                    </div>\
                                                </div>\
                                                <div>\
                                                    <div class="small text-gray-500">'+item.date+'</div>\
                                                    <span>'+item.user_name+' وضع تعليقًا على المنشور <b>'+item.post_title+'<b></span>\
                                                </div>\
                                            </a>';
                

                    $('.alert-body').html(resposeNotifications);
            });
            }
        });
    });
</script>

    


    @yield('script')
</body>
</html>
