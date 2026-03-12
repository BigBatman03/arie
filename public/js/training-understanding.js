(() => {
  const cfg = window.__ARIE__ || {};
  const exercises = cfg.exercises || [];

  let currentIndex = 0;
  let totalScore = 0;

  const els = {
    root: document.getElementById("game-root"),
    results: document.getElementById("results-area"),
    progress: document.getElementById("progress"),
    scenarioText: document.getElementById("scenario-text"),
    options: document.getElementById("options-area"),
    feedback: document.getElementById("feedback"),
    nextBtn: document.getElementById("next-btn"),
    finalScore: document.getElementById("final-score"),
  };

  function init() {
    if (!exercises.length) {
      els.root.innerHTML = "<p>Brak danych w bazie dla tego modułu.</p>";
      return;
    }
    load();
    els.nextBtn.addEventListener("click", (e) => {
      e.preventDefault();
      currentIndex++;
      load();
    });
  }

  function load() {
    if (currentIndex >= exercises.length) return finish();

    const ex = exercises[currentIndex];
    els.progress.textContent = `Pytanie ${currentIndex + 1} / ${exercises.length}`;
    els.scenarioText.textContent = ex.text || "";
    els.feedback.classList.add("hide");
    els.feedback.innerHTML = "";
    els.nextBtn.classList.add("hide");

    renderOptions(ex);
  }

  function renderOptions(ex) {
    els.options.innerHTML = "";
    (ex.options || []).forEach((opt) => {
      const btn = document.createElement("button");
      btn.className = "option-btn";
      btn.textContent = opt.text;
      btn.onclick = () => check(opt, ex, btn);
      els.options.appendChild(btn);
    });
  }

  function check(selectedOpt, ex, btnClicked) {
    const btns = els.options.querySelectorAll("button");
    btns.forEach((b) => (b.disabled = true));

    const isCorrect = Number(selectedOpt.is_correct) === 1;
    if (isCorrect) {
      totalScore++;
      btnClicked.classList.add("selected-correct");
    } else {
      btnClicked.classList.add("selected-wrong");
    }

    // pokaż poprawną
    Array.from(btns).forEach((b) => {
      const opt = (ex.options || []).find((o) => o.text === b.textContent);
      if (opt && Number(opt.is_correct) === 1) b.classList.add("selected-correct");
    });

    els.feedback.innerHTML = `
      <p><strong>${isCorrect ? "Dobrze!" : "Nie do końca."}</strong></p>
      <p class="muted" style="margin-top:0.5rem; font-size:0.9rem">${ex.explanation || ""}</p>
    `;
    els.feedback.classList.remove("hide");
    els.nextBtn.classList.remove("hide");
  }

  async function finish() {
    els.root.classList.add("hide");
    els.results.classList.remove("hide");
    els.finalScore.textContent = `Wynik: ${totalScore} / ${exercises.length}`;

    try {
      await fetch(cfg.storeUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": cfg.csrf },
        body: JSON.stringify({ score: totalScore, max_score: exercises.length }),
      });
    } catch (e) {
      console.error(e);
    }
  }

  init();
})();
