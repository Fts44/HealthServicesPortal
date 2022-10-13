<!-- 
    Final Version: Authentication Layout
    Date: 10/11/2022
    Created by: Joseph E. Calma
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@stack('title')
	
    <!-- tab icon -->
	<link rel="icon" href="{{ asset('storage/SystemFiles/logo.png') }}">
	
    <!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	
    <!-- font-awesome icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- authentication css -->
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">
    
    
    <!-- swal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    @stack('css')

</head>
<body>
    @if(Session::get('CurrentRoute')!=url()->current()) 
        @include('Components.Loader')
    @endif

    @php
        Session::put('CurrentRoute', url()->current());
    @endphp

	<section class="side" style="background: url({{ asset('storage/SystemFiles/background.png') }}) no-repeat; background-size: 100% 100%;">
		<img src="{{ asset('storage/SystemFiles/logo.png') }}">
	</section>

	@yield('content')

    <!-- google recaptcha -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
    <!-- jquery lib -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- showpassword -->
    <script>
        @if(session('status'))
            @php 
                $status = json_decode(session('status'));                      
            @endphp
            swal('{{$status->title}}','{{$status->message}}','{{$status->icon}}');
        @endif

        $('.showpassword').click(function(){
            var input = $('#pass');
            if(input.attr('type') === 'password'){
                $('#pass, #pass1').attr('type','text');
                $('.showpassword').removeClass('fa-eye-slash');
                $('.showpassword').addClass('fa-eye');
            }
            else{
                $('#pass, #pass1').attr('type','password');
                $('.showpassword').removeClass('fa-eye');
                $('.showpassword').addClass('fa-eye-slash');
            }
        });
    </script>

    @stack('script')
</body>
</html>