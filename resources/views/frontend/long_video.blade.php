@include('frontend.layout.header')
         
         <div class="container">

             <div class="map-background">
                 <a href="{{route('video')}}">
                     <h1 class="map-title">Categories</h1>
                 </a>
             </div>
             <div>
                 <a href="{{route('video')}}">
                     <h1 class="map-title-top">Categories</h1>
                 </a>
             </div>
             <div>
                 <a href="{{route('video')}}">
                     <h1 class="map-title-bottom">Anything Local</h1>
                 </a>
             </div>
             @include('frontend.layout.navbar')
         </div>
         <style>
            body {
                font-family: "Irish Grover", serif;
                font-weight: 400;
                font-style: normal;
                background-image: url({{ asset('assets/img/tree2.jpg') }});
            }
   
            @media (max-width: 480px) {
                .map-title-top {
                    margin-top: 26%;
                    margin-left: 6%;
   
                }
   
                .map-title-bottom {
                    margin-top: 100%;
                    margin-left: 43%;
                    font-size: 25px;
                }
            }
   
            .icon {
                position: relative;
                /* Make sure the image is positioned relative */
            }
   
            .map-text {
                display: none;
                position: absolute;
                top: -50px;
                left: 5%;
                transform: translateX(-50%);
                color: #fff;
                z-index: 9999;
                background-color: #2d6a30;
                color: white;
   
                font-size: 22px;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                padding: 7px 21px;
                border-radius: 12px;
                border: none;
                cursor: pointer;
                transition: transform 0.3s ease;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
   
            .icon:hover+.map-text {
                display: block;
            }
   
            span.map-text.Radio-text {
                left: 15%;
            }
   
            span.map-text.music {
                left: 26%;
            }
   
            span.map-text.feed {
                left: 36%;
            }
   
            span.map-text.cameras {
                left: 46%;
            }
   
            span.map-text.Room {
                left: 57%;
            }
   
            span.map-text.Friends {
                left: 67%;
            }
   
            span.map-text.name {
                left: 77%;
            }
   
            span.map-text.setting {
                left: 87%;
            }
   
            span.map-text.fam {
                left: 96%;
            }
        </style>
    @include('frontend.layout.footer')