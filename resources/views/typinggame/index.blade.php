<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Typing Game</title>
<style>
body { font-family: Arial, sans-serif; max-width: 700px; margin: 50px auto; text-align:center; }
#controls { margin-bottom:20px; }
#typingArea { 
    width:100%; 
    min-height:120px; 
    font-size:18px; 
    line-height:1.5; 
    border:1px solid #ccc; 
    padding:10px; 
    white-space: pre-wrap; 
    text-align:left; 
    font-family: monospace;
}
.correct { color: green; }
.incorrect { color: red; }
.active { text-decoration: underline; }
#info { margin-top:10px; }
#resultForm { margin-top:20px; display:none; }
</style>
</head>
<body>

<h1>Typing Speed Test</h1>

<div id="controls">
    <label for="mode">Difficulty:</label>
    <select id="mode">
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
        <option value="hardcore">Hardcore</option>
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

    let text = '';
    let typed = '';
    let startTime = null;
    let timer = null;

    async function fetchText(mode) {
        const res = await fetch('/typinggame/random/' + mode);
        const data = await res.json();
        return data.text;
    }

    function startTimer() {
        startTime = performance.now();
        timer = setInterval(() => {
            const elapsed = ((performance.now() - startTime)/1000).toFixed(2);
            timeDisplay.textContent = elapsed;
        }, 50);
    }

    function stopTimer() {
        clearInterval(timer);
        return ((performance.now() - startTime)/1000).toFixed(2);
    }

    function renderText() {
        let html = '';
        let errors = 0;

        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            if (i < typed.length) {
                if (typed[i] === char) {
                    html += `<span class="correct">${char}</span>`;
                } else {
                    html += `<span class="incorrect">${char}</span>`;
                    errors++;
                }
            } else if (i === typed.length) {
                html += `<span class="active">${char}</span>`;
            } else {
                html += char;
            }
        }

        typingArea.innerHTML = html;
        errorsDisplay.textContent = errors;
    }

    startBtn.addEventListener('click', async () => {
        text = await fetchText(modeSelect.value);
        typed = '';
        typingArea.contentEditable = true;
        typingArea.focus();
        timeDisplay.textContent = '0.00';
        errorsDisplay.textContent = 0;
        resultForm.style.display = 'none';
        startTimer();
        renderText();
    });

    typingArea.addEventListener('keydown', (e) => {
        e.preventDefault(); // kontrolē rakstīšanu pašam

        if (!text) return;

        if (e.key.length === 1) {
            // rakstāms burts
            typed += e.key;
        } else if (e.key === 'Backspace') {
            typed = typed.slice(0, -1);
        }

        renderText();

        if (typed === text) {
            const totalTime = stopTimer();
            typingArea.contentEditable = false;
            finalTime.textContent = totalTime;
            resultForm.style.display = 'block';
        }
    });

    saveBtn.addEventListener('click', async () => {
        const nickname = nicknameInput.value.trim();
        const mode = modeSelect.value;
        const time = parseFloat(finalTime.textContent);
        if (!nickname) { alert('Enter nickname'); return; }

        const res = await fetch('/typinggame/save', {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({nickname, mode, time})
        });

        if(res.ok){
            alert('Score saved!');
            nicknameInput.value='';
            resultForm.style.display='none';
        } else {
            alert('Error saving score.');
        }
    });
});
</script>

</body>
</html>
