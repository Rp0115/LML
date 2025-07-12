<x-app-layout>
    {{-- <link rel="stylesheet" href='{{ asset("css/flashcardstyle.css") }}'/>

    <x-sidebar/>

<div class="container">
    <div class="flashcard-container">
        <div id="flashcard">
            <div id="flashcardInner">
                <div class="front">
                    <p id="term"></p>
                </div>
                <div class="back">
                    <p id="definition"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="progress-container">
        <div id="progressBar"></div>
    </div>
    <div id="progressText"></div>

    <button id="flipBtn" class="btn">Flip Card</button>

    <div class="navigation-buttons">
        <button id="prevBtn" class="btn">Previous</button>
        <button id="nextBtn" class="btn">Next</button>
    </div>

    <div class="difficulty-buttons">
        <button class="btn difficulty-btn">Easy</button>
        <button class="btn difficulty-btn">Medium</button>
        <button class="btn difficulty-btn">Hard</button>
    </div>

    <div id="completionMessage">
        <h2>Congratulations! You've completed the flashcards!</h2>
        <button id="restartBtn" class="btn">Restart</button>
    </div>
</div>

<script src='{{ asset("js/flashcardscript.js") }}'></script> --}}

<div class="main-layout-container">

    <!-- DIV 1: The Left Sidebar Column -->
    <div class="left-sidebar-column">
        <x-sidebar/>
    </div>

    <!-- DIV 2: The Right Flashcard Column -->
    <div class="right-flashcard-column">
    
        <!-- 
            Place ALL of your flashcard HTML inside this div.
            The CSS will automatically center it.
        -->
        <link rel="stylesheet" href='{{ asset("css/flashcardstyle.css") }}'>
        <div class="container">  <!-- You already have this class, keep it! -->
            <div class="flashcard-container">
                <div id="flashcard">
                    <div id="flashcardInner">
                        <div class="front">
                            <p id="term"></p>
                        </div>
                        <div class="back">
                            <p id="definition"></p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="progress-container">
                <div id="progressBar"></div>
            </div>
            <div id="progressText"></div>
        
            <button id="flipBtn" class="btn">Flip Card</button>
        
            <div class="navigation-buttons">
                <button id="prevBtn" class="btn">Previous</button>
                <button id="nextBtn" class="btn">Next</button>
            </div>
        
            <div class="difficulty-buttons">
                <button class="btn difficulty-btn">Easy</button>
                <button class="btn difficulty-btn">Medium</button>
                <button class="btn difficulty-btn">Hard</button>
            </div>
        
            <div id="completionMessage">
                <h2>Congratulations! You've completed the flashcards!</h2>
                <button id="restartBtn" class="btn">Restart</button>
            </div>
        </div>

    </div>

</div>

<!-- Your <script> tag for the flashcards remains here, unchanged -->
<script src='{{ asset("js/flashcardscript.js") }}'></script>

</x-app-layout>