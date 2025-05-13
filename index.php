<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Congratulations</title>
    <style>
        body {
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            text-align: center;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        p {
            font-size: 1.5em;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .balloon {
            position: absolute;
            width: 40px;
            height: 50px;
            background-color: red;
            border-radius: 50% 50% 45% 45%;
            animation: floatUp 10s linear infinite;
        }

        .balloon::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 15px;
            background: white;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-120vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>


    <?php session_start(); ?>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="<?= $_SESSION['status'] ?>">
            <?= $_SESSION['message'] ?>
            <?php unset($_SESSION['message'], $_SESSION['status']); ?>
        </div>
    <?php endif; ?>

    <h1>🎉 Congratulations! 🎉</h1>
    <p>You have successfully logged In.</p>

    <audio id="bg-music" autoplay loop>
        <source src="areybhai.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>


    <script>
        function createBalloon() {
            const colors = ['#FF5E5E', '#FFD966', '#9FE2BF', '#FFB6C1', '#87CEFA'];
            const balloon = document.createElement('div');
            balloon.className = 'balloon';
            balloon.style.left = Math.random() * 100 + 'vw';
            balloon.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            balloon.style.animationDuration = (5 + Math.random() * 5) + 's';
            document.body.appendChild(balloon);

            setTimeout(() => {
                balloon.remove();
            }, 11000);
        }

        setInterval(createBalloon, 500);





        window.addEventListener('load', () => {
            const music = document.getElementById('bg-music');
            music.play().catch(() => {
                console.warn("Autoplay blocked. Click to enable music.");
            });

            document.body.addEventListener('click', () => {
                if (music.paused) music.play();
            }, { once: true });
        });


    </script>
</body>

</html>