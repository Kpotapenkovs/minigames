<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Typing Game</title>
<link rel="stylesheet" href="{{ asset('css/typinggame.css') }}">
</head>
<body>

<nav>
    <ul>
        <li><a href="{{ route('minigames.index') }}">Sākums</a></li>
        <li><a href="{{ route('memoryCard') }}">Memory Card</a></li>
    </ul>
</nav>

<h1>Typing Speed Test</h1>

<div id="controls">
    <p id="wpmResult"></p>
    <label for="mode">Difficulty:</label>
    <select id="mode">
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
        <option value="hardcore">Hardcore</option>
    </select>

    <label for="timeLimit">Time (seconds):</label>
    <select id="timeLimit">
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="30">30</option>
    </select>

    <button id="startBtn">Start</button>
</div>

<div id="typingArea" contenteditable="true" spellcheck="false"></div>

<div id="info">
    Time: <span id="time">0.00</span> s | Errors: <span id="errors">0</span>
</div>

<div id="resultForm">
    Your time: <span id="finalTime"></span> s<br>
    <input type="text" id="nickname" placeholder="Enter your nickname">
    <button id="saveBtn">Save Score</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const startBtn = document.getElementById('startBtn');
    const typingArea = document.getElementById('typingArea');
    const timeDisplay = document.getElementById('time');
    const errorsDisplay = document.getElementById('errors');
    const resultForm = document.getElementById('resultForm');
    const finalTime = document.getElementById('finalTime');
    const nicknameInput = document.getElementById('nickname');
    const saveBtn = document.getElementById('saveBtn');
    const modeSelect = document.getElementById('mode');
    const timeSelect = document.getElementById('timeLimit');
    const wpmResult = document.getElementById('wpmResult');

    let text = '';
    let typed = '';
    let timeLeft = 0;
    let timer = null;

    async function fetchText(mode) {
        const res = await fetch('/typinggame/random/' + mode);
        const data = await res.json();
        return data.text;
    }

    function renderText() {
        let html = '';
        let errors = 0;
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            if (i < typed.length) {
                if (typed[i] === char) html += `<span class="correct">${char}</span>`;
                else { html += `<span class="incorrect">${char}</span>`; errors++; }
            } else if (i === typed.length) html += `<span class="active">${char}</span>`;
            else html += char;
        }
        typingArea.innerHTML = html;
        errorsDisplay.textContent = errors;
    }

    function endTest() {
        typingArea.contentEditable = false;
        clearInterval(timer);

        const totalTime = parseInt(timeSelect.value);
        finalTime.textContent = totalTime;

        const wordCount = typed.trim().split(/\s+/).length;
        const timeMinutes = totalTime / 60;
        const wpm = Math.round(wordCount / timeMinutes);

        resultForm.style.display = 'block';
        wpmResult.textContent = `Words per minute: ${wpm}`;
    }

    startBtn.addEventListener('click', async () => {
        text = await fetchText(modeSelect.value);
        typed = '';
        typingArea.contentEditable = true;
        typingArea.focus();
        errorsDisplay.textContent = 0;
        resultForm.style.display = 'none';
        wpmResult.textContent = '';

        timeLeft = parseInt(timeSelect.value);
        timeDisplay.textContent = timeLeft.toFixed(2);
        renderText();

        timer = setInterval(() => {
            timeLeft -= 0.1;
            if (timeLeft <= 0) endTest();
            else timeDisplay.textContent = timeLeft.toFixed(2);
        }, 100);
    });

    typingArea.addEventListener('keydown', (e) => {
        e.preventDefault();
        if (!text || !typingArea.isContentEditable) return;

        if (e.key.length === 1) typed += e.key;
        else if (e.key === 'Backspace') typed = typed.slice(0, -1);

        renderText();
    });

    saveBtn.addEventListener('click', async () => {
        const nickname = nicknameInput.value.trim();
        const mode = modeSelect.value;
        const totalTime = parseInt(timeSelect.value);
        const wordCount = typed.trim().split(/\s+/).length;
        const wpm = Math.round(wordCount / (totalTime / 60));

        if (!nickname) { alert('Enter nickname'); return; }

        // Check if nickname is unique
        const check = await fetch('/typinggame/check-nickname', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nickname })
        });

        const data = await check.json();
        if (data.exists) {
            alert('This nickname is already used! Choose a different one.');
            return;
        }

        const res = await fetch('/typinggame/save', {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({nickname, mode, time: totalTime, wpm })
        });

        if(res.ok){
            alert(`Score saved! Your WPM: ${wpm}`);
            nicknameInput.value='';
            resultForm.style.display='none';
        } else alert('Error saving score.');
    });
});
</script>

</body>
</html>
