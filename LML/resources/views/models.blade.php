<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Learning Topics</title>
    <style>
        body {
            background-image: url("/images/background.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;

            /* background: rgba(255, 255, 255, 0.3);
            padding: 2px 10px;
            border-radius: 0 0 8px 8px;
            /* border: 1px solid #9c9c9c; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); */
        }
        
        
        /* Desktop-style window controls */
        .window-controls {
            display: flex;
            gap: 5px;
        }
        
        .window-btn {
            width: 30px;
            height: 30px;
            /* border-radius: 4px; */
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s;
        }

        .close-btn {
            background: rgb(163, 0, 0);
            color:white;
        }
        
        .window-btn:hover {
            filter: brightness(1.2);
        }
        
        .close-btn:hover {
            background: rgba(211, 0, 0, 0.8);
            color: white;
        }

        h1 {
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
            text-align: center;
            margin: 30px 0;
            font-size: 50px;
            color: #2c3e50;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1000px;
            margin: 0 auto;
            gap: 20px;
            padding: 20px;
        }

        .box {
            width: 400px;
            height: 400px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            cursor: pointer;
            background-color: rgba(0, 102, 255, 0.3);
        }
        
        .box a {
            text-decoration: none;
            color: #000000;
            font-size: 24px;
            font-weight: bold;
            display: block;
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: "Papyrus", "Impact", "Chiller", "Jokerman", fantasy, cursive;
        }
        
        .box a:hover {
            color: #ffffff;
        }
        
        .icon {
            width: 100px;
            height: 100px;
        }

        #special-icon {
            width: 48px;
            height: 48px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1 style="font-size: 50px";>Machine Learning Topics</h1>

    <div class="container">
        
        <div class="box">
            <a href="{{ route('linearReg') }}">
                <div style="margin-bottom: 20px;">Linear Regression</div>
                <img src="/images/linear.gif" width="200" height="200">
            </a>
        </div>
        
        <div class="box">
            <a href='{{ route('logisticReg') }}'>
                <div style="margin-bottom: 20px;">Logistic Regression</div>
                <img src="/images/logisitc.gif" width="200" height="200">
            </a>
        </div>
        
        
        <div class="box">
            <a href="page3.html">
                <div style="margin-bottom: 20px;">Decision Tree</div>
                <img src="/images/decision.gif" width="200" height="200">
            </a>
        </div>
        
       
        <div class="box">
            <a href="page4.html">
                <div style="margin-bottom: 20px;">Neural Networks</div>
                <img src="/images/neural.gif" width="200" height="200">
            </a>
        </div>
    </div>
    <div class="button-wrapper">
        <a href="{{ route('desktop') }}">
            <x-primary-button>{{ __('Go Back') }}</x-primary-button>
        </a>
    </div>
</body>
</html>