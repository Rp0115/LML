<style>
    /* Title bar styling */
   /* .title-bar {
       display: flex;
       justify-content: space-between;
       align-items: center;
       background: rgba(59, 130, 246, 0.3);
       padding: 5px 10px;
       /* border-radius: 8px 8px 0 0;  */
       /* border: 1px solid rgba(59, 130, 246); */
       /* border-bottom: none; */ 
   
   
   .app-title {
       font-family: "Papyrus", fantasy;
       font-size: 18px;
       color: #333;
       padding-left: 10px;
   }
   
     /* Desktop-style window controls */
   .window-controls {
       display: flex;
       gap: 5px;
   }
   
   .window-btn {
       width: 30px;
       height: 25px;
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
   

   .main-layout-container {
        background-image: url("/images/LoginBackground.jpg");
        background-size: cover;
        background-position: center;
        /* background-repeat: no-repeat; */
       font-family: Arial, sans-serif;
       display: flex;
       justify-content: center;
       align-items: center;
       min-height: calc(100vh - 4rem); /* Adjust for navbar */
       /* background-color: rgba(243, 243, 243, 0.3); */
       padding: 2rem;
   }

   .container {
        width: 100%;
        max-width: 600px;
        text-align: center;
        background-color: rgb(212, 229, 245);
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative; /* Add this */
    }

    /* Add these new styles */
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .window-controls {
        position: absolute; /* Change from flex to absolute */
        top: 15px;
        right: 15px;
    }

   h1 {
       color: #3b82f6;
       margin-bottom: 1.5rem;
       font-size: 2rem;
       font-weight: bold;
   }

   .flashcard-container {
       perspective: 1000px;
       margin-bottom: 1.5rem;
   }

   .flashcard {
       width: 100%;
       height: 300px;
       position: relative;
       transform-style: preserve-3d;
       transition: transform 0.6s;
       cursor: pointer;
       margin: 0 auto;
   }

   .flashcard.flipped {
       transform: rotateY(180deg);
   }

   .flashcard-inner {
       position: relative;
       width: 100%;
       height: 100%;
       text-align: center;
       transition: transform 0.6s;
       transform-style: preserve-3d;
   }

   .flashcard-front, .flashcard-back {
       position: absolute;
       width: 100%;
       height: 100%;
       backface-visibility: hidden;
       display: flex;
       justify-content: center;
       align-items: center;
       padding: 2rem;
       box-sizing: border-box;
       border-radius: 0.5rem;
       box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   }

   .flashcard-front {
       background-color: #ffffff;
       color: #1e293b;
       border: 1px solid #e2e8f0;
   }

   .flashcard-back {
       background-color: rgb(59, 130, 246);
       color: white;
       transform: rotateY(180deg);
   }

   .progress-container {
       display: flex;
       align-items: center;
       gap: 0.5rem;
       margin-bottom: 1.5rem;
   }

   .progress-bar {
       flex-grow: 1;
       height: 0.5rem;
       background-color: #e2e8f0;
       border-radius: 0.25rem;
       overflow: hidden;
   }

   #progressBarFill {
       height: 100%;
       background-color: #3b82f6;
       width: 0%;
       transition: width 0.3s;
   }

   .progress-text {
       font-size: 0.875rem;
       color: #64748b;
       min-width: 3rem;
   }

   .navigation-buttons {
       display: flex;
       justify-content: center;
       gap: 0.75rem;
       margin-top: 1.5rem;
   }

   button {
       padding: 0.5rem 1rem;
       border: none;
       border-radius: 0.25rem;
       background-color: #3b82f6;
       color: white;
       cursor: pointer;
       transition: background-color 0.2s;
       font-weight: 500;
   }
   
   button:hover {
       background-color: #2563eb;
   }

   button:disabled {
       background-color: rgb(203, 213, 225,.3);

   }

   #flipBtn {
       background-color: #10b981;
   }

   #flipBtn:hover {
       background-color: #059669;
   }

   p {
       font-size: 1.25rem;
       line-height: 1.6;
   }
</style>


<div class="main-layout-container">
    <div class="container">
        <div class="header-container">
            <h1>FlashQ</h1>
            <div class="window-controls">
                <a href="{{ route('desktop') }}">
                    <button class="window-btn close-btn" title="Close">×</button>
                </a>
            </div>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar">
                <div id="progressBarFill"></div>
            </div>
            <span class="progress-text" id="progressText">0/0</span>
        </div>
        
        <div class="flashcard-container">
            <div class="flashcard" id="flashcard">
                <div class="flashcard-inner" id="flashcardInner">
                    <div class="flashcard-front">
                        <p id="term">Loading flashcards...</p>
                    </div>
                    <div class="flashcard-back">
                        <p id="definition"></p>
                    </div>
                </div>
            </div>
        </div>
       
       <div class="navigation-buttons">
           <button id="prevBtn" disabled>Previous</button>
           <button id="flipBtn">Flip Card</button>
           <button id="nextBtn" disabled>Next</button>
       </div>
   </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
       const flashcardData = [
           {
               "term": "Bias",
               "definition": "The error introduced by approximating a real-world problem with a simplified model."
           },
           {
               "term": "Variance",
               "definition": "The amount that the predicted value would change if we estimated it using a different training dataset."
           },
           {
               "term": "Overfitting",
               "definition": "When a model learns the training data too well, including its noise and outliers, resulting in poor performance on new data."
           }
       ];

       // DOM Elements
       const flashcard = document.getElementById('flashcard');
       const termEl = document.getElementById('term');
       const definitionEl = document.getElementById('definition');
       const prevBtn = document.getElementById('prevBtn');
       const nextBtn = document.getElementById('nextBtn');
       const flipBtn = document.getElementById('flipBtn');
       const progressBarFill = document.getElementById('progressBarFill');
       const progressText = document.getElementById('progressText');

       // State
       let currentCardIndex = 0;
       let isFlipped = false;

       // Initialize
       updateCard();
       updateProgress();

       // Event Listeners
       flashcard.addEventListener('click', flipCard);
       flipBtn.addEventListener('click', flipCard);
       prevBtn.addEventListener('click', showPreviousCard);
       nextBtn.addEventListener('click', showNextCard);

       // Functions
       function updateCard() {
           termEl.textContent = flashcardData[currentCardIndex].term;
           definitionEl.textContent = flashcardData[currentCardIndex].definition;
           
           // Reset to front if flipped
           if (isFlipped) {
               flipCard();
           }
       }

       function updateProgress() {
           const progress = ((currentCardIndex + 1) / flashcardData.length) * 100;
           progressBarFill.style.width = `${progress}%`;
           progressText.textContent = `${currentCardIndex + 1}/${flashcardData.length}`;
           
           // Update button states
           prevBtn.disabled = currentCardIndex === 0;
           nextBtn.disabled = currentCardIndex === flashcardData.length - 1;
       }

       function flipCard() {
           isFlipped = !isFlipped;
           flashcard.classList.toggle('flipped', isFlipped);
       }

       function showPreviousCard() {
           if (currentCardIndex > 0) {
               currentCardIndex--;
               updateCard();
               updateProgress();
           }
       }

       function showNextCard() {
           if (currentCardIndex < flashcardData.length - 1) {
               currentCardIndex++;
               updateCard();
               updateProgress();
           }
       }

       sidebarLinks.forEach(link => {
           link.addEventListener('click', (event) => {
               event.preventDefault();
               const contentId = event.target.dataset.contentId;
               updateView(contentId);
           });
       });

       
       // document.addEventListener('keydown', (e) => {
       //     if (e.key === 'ArrowLeft') {
       //         showPreviousCard();
       //     } else if (e.key === 'ArrowRight') {
       //         showNextCard();
       //     } else if (e.key === ' ' || e.key === 'Enter') {
       //         flipCard();
       //     }
       // });
   });
</script>