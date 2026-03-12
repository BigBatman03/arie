(() => {
  const cfg = window.__ARIE__ || {};
  const exercises = Array.isArray(cfg.exercises) ? cfg.exercises : [];

  let currentIndex = 0;
  let totalPerfect = 0;
  let userSelections = {};

  const els = {
    root: document.getElementById("game-root"),
    title: document.getElementById("scenario-title"),
    text: document.getElementById("scenario-text"),
    scales: document.getElementById("scales-container"),
    checkBtn: document.getElementById("check-btn"),
    nextBtn: document.getElementById("next-btn"),
    feedback: document.getElementById("feedback"),
    progress: document.getElementById("progress"),
  };

  function init() {
    if (!exercises.length) {
      els.root.innerHTML = "Brak danych.";
      return;
    }

    els.checkBtn.addEventListener("click", (e) => {
      e.preventDefault();
      check();
    });
    els.nextBtn.addEventListener("click", (e) => {
      e.preventDefault();
      currentIndex++;
      loadScenario();
    });

    loadScenario();
  }

  function loadScenario() {
    if (currentIndex >= exercises.length) return finish();

    const ex = exercises[currentIndex];
    userSelections = {};

    els.progress.textContent = `Historia ${currentIndex + 1} / ${exercises.length}`;
    els.title.textContent = ex.title || "";
    els.text.textContent = ex.text || "";

    els.feedback.classList.add("hide");
    els.feedback.innerHTML = "";

    els.checkBtn.disabled = true;
    els.checkBtn.classList.remove("hide");
    els.nextBtn.classList.add("hide");

    renderScales(ex.emotions || []);
  }

  function renderScales(emotions) {
    els.scales.innerHTML = "";

    if (!Array.isArray(emotions) || emotions.length === 0) {
      els.scales.innerHTML = "<p>Brak emocji do oceny.</p>";
      return;
    }

    emotions.forEach((emo, idx) => {
      const row = document.createElement("div");
      row.className = "scale-row usage-scale-row";

      const head = document.createElement("div");
      head.className = "usage-scale-head";

      const title = document.createElement("div");
      title.className = "usage-emotion-title";
      title.textContent = emo?.name ?? "";

      const scoreBox = document.createElement("div");
      scoreBox.className = "usage-emotion-score";
      scoreBox.innerHTML = `<strong id="val-${idx}">?/5</strong>`;

      head.appendChild(title);
      head.appendChild(scoreBox);
      row.appendChild(head);

      const btnContainer = document.createElement("div");
      btnContainer.className = "scale-buttons usage-scale-buttons";

      for (let i = 1; i <= 5; i++) {
        const btn = document.createElement("div");
        btn.className = "scale-btn";
        btn.textContent = i;
        btn.dataset.value = i;
        btn.onclick = () => handleSelection(idx, i, btnContainer, emotions.length);
        btnContainer.appendChild(btn);
      }

      row.appendChild(btnContainer);

      const legend = document.createElement("div");
      legend.className = "usage-scale-legend";
      legend.innerHTML = `<span>nie pomaga</span><span>pomaga</span>`;
      row.appendChild(legend);

      els.scales.appendChild(row);
    });
  }

  function handleSelection(emotionIdx, value, container, emotionsLen) {
    if (!els.checkBtn.classList.contains("hide") && document.querySelector(".is-ideal")) return;

    const buttons = container.querySelectorAll(".scale-btn");
    buttons.forEach((b) => b.classList.remove("selected"));
    buttons[value - 1].classList.add("selected");

    const valEl = document.getElementById(`val-${emotionIdx}`);
    if (valEl) valEl.textContent = `${value}/5`;

    userSelections[emotionIdx] = value;

    if (Object.keys(userSelections).length === emotionsLen) {
      els.checkBtn.disabled = false;
    }
  }

  function check() {
    const ex = exercises[currentIndex];
    const emotions = Array.isArray(ex.emotions) ? ex.emotions : [];

    const rows = els.scales.querySelectorAll(".scale-row");
    let correctCount = 0;

    emotions.forEach((emo, idx) => {
      const ideal = Number(emo.ideal) || 0;
      const userVal = Number(userSelections[idx]);

      const row = rows[idx];
      const buttons = row.querySelectorAll(".scale-btn");

      const distance = Math.abs(userVal - ideal);
      const ok = distance <= 1;
      if (ok) correctCount++;

      buttons.forEach((b) => (b.style.pointerEvents = "none"));

      const userBtn = buttons[userVal - 1];
      if (ok) userBtn.classList.add("good-match");
      else userBtn.classList.add("bad-match");

      if (ideal >= 1 && ideal <= 5) buttons[ideal - 1].classList.add("is-ideal");
    });

    const allCorrect = emotions.length > 0 && correctCount === emotions.length;
    if (allCorrect) totalPerfect++;

    els.feedback.innerHTML = `
      <p><strong>${allCorrect ? "Świetnie!" : "Dobra próba."}</strong></p>
      <p class="muted" style="margin-top:0.5rem; font-size:0.95rem">
        ${ex.explanation || ""}
      </p>
      <p class="muted" style="margin-top:0.5rem; font-size:0.9rem">
        Zielona obwódka wskazuje ocenę ekspercką.
      </p>
    `;
    els.feedback.classList.remove("hide");

    els.checkBtn.classList.add("hide");
    els.nextBtn.classList.remove("hide");
  }

  async function finish() {
    els.root.classList.add("hide");
    document.getElementById("results-area").classList.remove("hide");
    document.getElementById("final-score").textContent =
      `Wynik perfekcyjny: ${totalPerfect} / ${exercises.length} historii`;

    try {
      await fetch(cfg.storeUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": cfg.csrf },
        body: JSON.stringify({ score: totalPerfect, max_score: exercises.length }),
      });
    } catch (e) {
      console.error(e);
    }
  }

  init();
})();
