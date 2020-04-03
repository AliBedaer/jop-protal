<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board | @yield('title') </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    {{ asset('frontend') }}/
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nice.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/gijgo.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slicknav.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <style type="text/css">
    .bg-green {
        background: #00D363 !important;
        color: #FFF !important;
    }

    .bg-green:hover {
        color: #FFF !important;
    }

    .bg-blue {
        background: #1488EF !important;
        color: #FFF !important;
    }

    .bg-blue:hover {
        color: #FFF !important;
        border-color: #1488EF !important;
    }
    </style>

    @stack('css')
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    @include('frontend.includes._header')
    <!-- header-end -->
    @yield('content')
    <!-- footer start -->
    @include('frontend.includes._footer')
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/js/ajax-form.js"></script>
    <script src="{{ asset('frontend') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/js/scrollIt.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/js/nice-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/nice.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.slicknav.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins.js"></script>
    <script src="{{ asset('frontend') }}/js/gijgo.min.js"></script>



    <!--contact js-->

    <script src="{{ asset('frontend') }}/js/contact.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.form.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend') }}/js/mail-script.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::render() !!}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
    function sweet(title, position = "top-end", icon = "success", confirm = false, timer = 1500) {

        Swal.fire({
            position: position,
            icon: icon,
            title: title,
            showConfirmButton: confirm,
            timer: timer
        });

    }

    $(function() {

        // Ajax save job

        $('.heart_mark').on('click', function(e) {
            e.preventDefault();
            var url = $(this).data('url') + '/save',
                linkIcon = $(this),
                spinnerIconHtml = `<i class="fa fa-spinner fa-spin fa-fw"></i>`,
                heartIconHtml = `<i class="fa fa-heart" ></i>`;


            $.ajax({
                url: url,
                beforeSend: function() {
                    linkIcon.html(spinnerIconHtml);
                },
                success: function(data) {
                    if (data.added) {
                        linkIcon.html(heartIconHtml)
                        linkIcon.addClass('bg-green');

                    } else {

                        linkIcon.html(heartIconHtml)
                        linkIcon.removeClass('bg-green');
                    }

                },
            })
        })

        // Ajax Apply job

        $('.apply_job').on('click', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            linkIcon = $(this),
                spinnerIconHtml = `<i class="fa fa-spinner fa-spin fa-fw"></i>`;
            $.ajax({
                url: url,
                beforeSend: function() {
                    linkIcon.append(spinnerIconHtml);
                },
                success: function(data) {
                    if (data.added) {
                        linkIcon.text('Applied');
                        linkIcon.addClass('bg-blue');
                    } else {
                        linkIcon.text('Apply Now');
                        linkIcon.removeClass('bg-blue');
                    }
                },
            })
        });


        // Confirm delete 

        $('.confirm').click(function() {

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $(this).closest('form').submit();

                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });

        // Cancel Applicants 

        $('.cancel').on('click', function(event) {

            event.preventDefault();

            var url = $(this).data('url');
            linkIcon = $(this),
                spinnerIconHtml = `<i class="fa fa-spinner fa-spin fa-fw"></i>`;

            console.log(url);


            $.ajax({

                url: url,

                beforeSend: function() {
                    linkIcon.append(spinnerIconHtml);
                },

                success: function(data) {
                    linkIcon.parent().parent().remove();
                    toastr.success('Applicant removed!');
                }

            })

        })
    });
    </script>
    @stack('js')
</body>

</html>