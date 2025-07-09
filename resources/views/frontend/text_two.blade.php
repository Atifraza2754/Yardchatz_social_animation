@include('frontend.layout.header')

<link rel="stylesheet" href="assets/css/text-two.css">
    <style>
        body{
            font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        }
    .apple-logo {
    width: 100%;
    height: 100%;
    background-image: url(assets/img/tree_apple.png);
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
body {
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    background: url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?auto=format&fit=crop&q=80') center/cover no-repeat fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
  
    color: white;
}
 </style>

    <div class="frames-container">
        <div class="frame silver-frame">
            <div class="post-content">
                <div class="user-info">
                    <img src="assets/img/Screenshot_2024-11-23_034131-removebg-preview.png" alt="Avatar" class="avatar">
                    <span class="username">Sharon G.</span>
                </div>
                <p class="quote">"I'm so glad I learned to write in cursive."</p>
            </div>
        </div>
        <div class="frame gold-frame">
            <img src="assets/img/text.png" alt="Avatar" class="avatar">
        </div>
    </div>
    <div class="text-thread">
        <h1>TEXT THREAD</h1>
        <h2>THIS SECTION IS WHERE YOU CAN SEE OTHER PEOPLE'S TEXT POSTS</h2>
    </div>
    <div class="logo-wrapper">
        <div class="apple-logo">
            <a href="{{url('/')}}" class="video-link">Text</a>
        </div>
    </div>
    @include('frontend.layout.footer')
