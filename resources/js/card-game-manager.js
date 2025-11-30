(function(){
    const levels = {
        easy:  { rows: 2, cols: 2 },
        medium:{ rows: 3, cols: 4 },
        hard:  { rows: 4, cols: 5 }
    };

    function getKey(level){ return 'memgame_highscores_' + level; }

    function loadHighScores(level){
        const raw = localStorage.getItem(getKey(level));
        return raw ? JSON.parse(raw) : [];
    }

    function saveHighScores(level, arr){
        localStorage.setItem(getKey(level), JSON.stringify(arr));
    }

    window.saveHighScore = function(level, time, moves){
        const list = loadHighScores(level);
        list.push({ time: Number(time), moves: Number(moves), date: new Date().toISOString() });
        list.sort((a,b)=> a.time - b.time || a.moves - b.moves);
        saveHighScores(level, list.slice(0,5));
        updateHighScoresUI();
    };

    function renderList(el, entries){
        const ol = el.querySelector('ol');
        ol.innerHTML = '';
        if (!entries.length){
            ol.innerHTML = '<li class="empty">--</li>';
            return;
        }
        entries.forEach(e=>{
            const d = new Date(e.date);
            const label = `${e.time}s • ${e.moves} moves • ${d.toLocaleDateString()} ${d.toLocaleTimeString()}`;
            const li = document.createElement('li');
            li.textContent = label;
            ol.appendChild(li);
        });
    }

    window.updateHighScoresUI = function(){
        renderList(document.getElementById('scores-easy'), loadHighScores('easy'));
        renderList(document.getElementById('scores-medium'), loadHighScores('medium'));
        renderList(document.getElementById('scores-hard'), loadHighScores('hard'));
    };

    function setLevel(level){
        const cfg = levels[level] || levels.easy;
        window.GAME_CONFIG = { level: level, rows: cfg.rows, cols: cfg.cols };
        window.dispatchEvent(new CustomEvent('levelChange', { detail: window.GAME_CONFIG }));
    }

    document.querySelectorAll('input[name="level"]').forEach(r=>{
        r.addEventListener('change', function(){
            if (this.checked) setLevel(this.value);
        });
    });

    const initial = document.querySelector('input[name="level"]:checked').value || 'easy';
    setLevel(initial);
    updateHighScoresUI();
})();
