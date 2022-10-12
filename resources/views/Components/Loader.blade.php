    <style>
        .loader-bg{
            position:fixed;
            z-index:999999;
            background:#fff;
            width:100%;
            height:100%;
        }

        .loader{
            border:0 solid transparent;
            border-radius:50%;
            max-height: 100vw;
            position:absolute;
            top:calc(50vh - 75px);
            left:calc(50vw - 75px)
        }

        .loader img {
            animation: blinker 3s linear infinite;
        }


        @keyframes blinker {
            40% { 
                opacity: 0; 
            }
        }
    </style>
    
    <div class="loader-bg">
        <div class="loader">
            <img src="{{ asset('storage/SystemFiles/loader.png') }}" alt="loader_image">
        </div>
    </div>

    <script>
        setTimeout(function(){
            $('.loader-bg').fadeToggle();
        }, 1500);
    </script>