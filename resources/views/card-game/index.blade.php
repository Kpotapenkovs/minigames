<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Card Game</title>
    @vite(['resources/css/card-game.css'])
</head>
<body>

<nav>
    <ul>
        <li><a href="{{ route('minigames.index') }}">Sākums</a></li>
        <li><a href="{{ route('typingSpeed') }}">typing speed game</a></li>
    </ul>
</nav>

    <header>
        <h1>Memory Card Game</h1>
        <div class="stats">
            <p>Moves: <span id="moves">0</span></p>
            <p>Time: <span id="time">0</span></p>
            <button id="restart">restart</button>
        </div>

        <div class="level-selector" aria-label="Choose difficulty">
            <label>
                <input type="radio" name="level" value="easy" checked> Easy (2x2)
            </label>
            <label>
                <input type="radio" name="level" value="medium"> Medium (3x4)
            </label>
            <label>
                <input type="radio" name="level" value="hard"> Hard (4x5)
            </label>
        </div>
    </header>

    <div class="game-container" id="game"></div>

    <aside id="high-scores">
        <h3>High Scores</h3>
        <div class="scores-list" id="scores-easy">
            <h4>Easy (2x2)</h4>
            <ol></ol>
        </div>
        <div class="scores-list" id="scores-medium">
            <h4>Medium (3x4)</h4>
            <ol></ol>
        </div>
        <div class="scores-list" id="scores-hard">
            <h4>Hard (4x5)</h4>
            <ol></ol>
        </div>
    </aside>

    <div id="popup" class="hidden">
        <h2>Congratulations!</h2>
        <p>You finished in <span id="final-moves">0</span> moves and <span id="final-time">0</span> seconds!</p>
        <button id="play-again">Play Again</button>
    </div>

    @vite(['resources/js/card-game-manager.js', 'resources/js/card-game.js'])
</body>
</html>
