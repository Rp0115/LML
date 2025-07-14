<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Page with Linked Boxes</title>
    <link rel="stylesheet" href='{{asset("css/modelsstyle.css")}}'>
  
</head>
<body>
    <div class="title-bar">
        <div class="title-bar-page-name">
            Machine Learning Topics
        </div>
        <a href='{{ route('desktop') }}' style="text-decoration: none;">
            <button class="title-bar-close-btn">
                &times;
            </button>
        </a>
    </div>
    
    <h1 style="font-size: 50px";>Machine Learning Topics</h1>

    <div class="container">
        <!-- Box 1 -->
        <div class="box">
            <a href='{{ route('linearReg') }}'>
                <div style="margin-bottom: 20px;">Linear Regression</div>
                <img src = "/images/linear.gif"  width="200" height="200">
            </a>
        </div>
        
        <!-- Box 2 -->
        <div class="box">
            <a href='{{ route('logisticReg') }}'>
                <div style="margin-bottom: 20px;">Logistic Regression</div>
                <img src = "/images/logisitc.gif" width="200" height="200">
            </a>
        </div>
        
        <!-- Box 3 -->
        <div class="box">
            <a href="page3.html">
                <div style="margin-bottom: 20px;">Decision Tree</div>
                 <img src = "/images/decision.gif" width="200" height="200">
            </a>
        </div>
        
        <!-- Box 4 -->
        <div class="box">
            <a href="page4.html">
                <div style="margin-bottom: 20px;">Neural Networks</div>
                <img src = "/images/neural.gif" width="200" height="200">
            </a>
        </div>
    </div>
</body>
</html>