@include('frontend.layout.header')
<style>
    body {
      font-family: "Irish Grover", serif;
      font-weight: 400;
      font-style: normal;
      align-items: center;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-image: url(assets/img/ssdRectangle.svg);
    }

    .container {
      text-align: center;
    }

    .container h1 {
      color: white;
      font-size: 3rem;
      cursor: pointer;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .input-container {
      margin-top: 20px;
      text-align: center;
    }

    .input-container textarea {
      display: none;
      padding: 10px;
      font-size: 1rem;
      border: 0px;
      border-radius: 5px;
      width: 80%;
      max-width: 400px;
      margin: auto;
      background: transparent;
      color: #fff;
      font-size: 25px;
      resize: none;
      height: 150px; /* Set height for textarea */
    }

    .input-container textarea:focus {
      outline: none;
      border-color: #4CAF50;
    }
  </style>

  <div class="container">
    <h1 onclick="showInput()">Who would you like in your <br>household?</h1>
    <div class="input-container">
      <textarea id="hiddenInput" placeholder="Write here..."></textarea>
    </div>
  </div>

  <script>
    function showInput() {
      const input = document.getElementById('hiddenInput');
      input.style.display = 'block'; // Show the textarea
      input.focus(); // Automatically focus the textarea
    }
  </script>
    @include('frontend.layout.footer')

