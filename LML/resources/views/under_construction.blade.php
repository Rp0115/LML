<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Under Construction</title>
    {{-- Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f7f6;
        }

        /* Title Bar Styles */
        .title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            color: white;
            flex-shrink: 0;
        }
        .title-bar-page-name {
            font-family: Arial, sans-serif;
            font-size: 1.2em;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .title-bar-close-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }
        .title-bar-close-btn:hover {
            background-color: #d9534f;
        }

        /* Main Content Styles */
        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            color: #4a5568;
        }
        .icon {
            font-size: 5rem;
            color: #a0aec0;
            margin-bottom: 1.5rem;
        }
        .main-heading {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .sub-heading {
            font-size: 1.25rem;
            max-width: 500px;
        }
    </style>
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