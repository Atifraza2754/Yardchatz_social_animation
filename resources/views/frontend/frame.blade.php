@include('frontend.layout.header')
<style>
      body{
          font-family: "Irish Grover", serif;
      font-weight: 400;
      font-style: normal;
      margin: 0;
      padding: 0;
      background: url('assets/img/ssdRectangle.svg') center/cover no-repeat fixed;
      background-size: cover;
      color: white;
      text-align: center;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      /*padding: 50px 20px;*/
      gap: 20px;
    }

    .div-one, .div-two {
      flex: 1;
      max-width: 400px;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

  

   

  
    .message {
    font-size: 1.6rem;
    background-image: url(assets/img/Groupsdsa.svg);
    background-repeat: no-repeat;
    background-size: cover;
    padding: 61px 0px;
    }

    .next-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 30px;
      background-color: red;
      color: white;
      font-size: 1.2rem;
      text-transform: uppercase;
      text-decoration: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .next-btn:hover {
      background-color: darkred;
    }
    .navbar {
   
    bottom: 96px !important;
        
    }
  
  </style>

    <h1>Now pick a frame</h1>

  <div class="container">

    <div class="div-one">
      <div class="frames">
        <div class="frame frame-1" ><img src="assets/img/Groupsdsa.svg" alt=""></div>
        <div class="frame frame-2" > <img src="assets/img/Groupsdss.svg" alt="" ></div>
      </div>
    </div>
    <div class="div-two">
      <div class="message">
        <img src="assets/img/avatarrr.svg" alt="Avatar" style="border-radius: 50%; margin-bottom: 10px;">
        <br>I love my dogs but I would like them to eat less cheese.
      </div>
      <a href="#" class="next-btn">Next</a>
    </div>
      @include('frontend.layout.navbar')

  </div>

  <!-- <script>
    function selectFrame(selected) {
      const frames = document.querySelectorAll('.frame');
      frames.forEach(frame => frame.classList.remove('selected'));
      selected.classList.add('selected');
    }
  </script> -->
  @include('frontend.layout.footer')

