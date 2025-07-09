<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invite Your Friends</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: "Irish Grover", serif !important;
            font-weight: 200 !important;
            font-style: normal;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Background image stays fixed */
            background-size: cover;
            background-image: url(assets/img/ssdRectangle.svg);
}

.container {
  position: relative;
}

.apple-container {
  position: relative;
  text-align: center;
}

.apple {
  width: 300px;
  /* animation: scaleUp 2s infinite alternate ease-in-out; */
}

.astronaut {
    position: absolute;
    top: -21%;
    right: -40%;
    /* animation: floatAstronaut 3s infinite ease-in-out; */
}



.text {
  position: absolute;
  bottom: 100px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 24px;
  color: white;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}

/* Animations */
@keyframes scaleUp {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

@keyframes floatAstronaut {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-15px);
  }
}
@media (max-width: 768px) {
    .apple {
    width: 206px;
    /* animation: scaleUp 2s infinite alternate ease-in-out; */
}
.astronaut {
    position: absolute;
    top: -38%;
    right: -40%;
    /* animation: floatAstronaut 3s infinite ease-in-out; */
}
.Astronaut{
    width: 75%;
}
.text {
    top: 80px;
}

}
  </style>

  <div class="container">
    <div class="apple-container">
      <img src="assets/img/Clippatgroup.svg" alt="Green Apple" class="apple" >
      <div class="astronaut">
        <img src="assets/img/Groupdsd.svg" alt="Astronaut" class="Astronaut">
      </div>
      <div class="text">Invite Your Friends!</div>
      
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    document.querySelector('.text').addEventListener('click', () => {
  alert('Invite Your Friends!');
});

  </script>
@include('frontend.layout.footer')
