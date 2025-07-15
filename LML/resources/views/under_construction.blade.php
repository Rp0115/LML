<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Under Construction</title>
    {{-- Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/under_constructionstyle.css')}}">
</head>
<body>
    <div class="title-bar">
        <div class="title-bar-page-name">
            Coming Soon
        </div>
        {{-- This link can take the user back to the main models page or another safe route --}}
        <a href="{{ route('models') }}" style="text-decoration: none;">
            <button class="title-bar-close-btn" aria-label="Close">&times;</button>
        </a>
    </div>

    <div class="content-wrapper">
        <div class="icon">
            <i class="fa-solid fa-gear fa-spin"></i>
        </div>
        <h1 class="main-heading">Page Under Construction</h1>
        <p class="sub-heading">
            We're working hard to bring this feature to you. Please check back later!
        </p>
    </div>

</body>
</html>