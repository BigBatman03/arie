(() => {
  const cfg = window.__ARIE__ || {};
  const exercises = cfg.exercises || [];

  let currentIndex = 0;
  let totalPerfect = 0;
  let userSelections = {};

  const els = {
    root: document.getElementById("game-root"),
    results: document.getElementById("results-area"),
    progress: document.getElementById("progress"),
    scenarioTitle: document.getElementById("scenario-title"),
    scenarioText: document.getElementById("scenario-text"),
    scalesContainer: document.getElementById("scales-container"),
    feedback: document.getElementById("feedback"),
    checkBtn: document.getElementById("check-btn"),
    nextBtn: document.getElementById("next-btn"),
    finalScore: document.getElementById("final-score"),
  };

  function init() {
    if (!exercises.length) {
      els.root.innerHTML = "<p>Brak danych w bazie dla tego modułu.</p>";
      return;
    }
    loadScenario();

    els.checkBtn.addEventListener("click", (e) => {
      e.preventDefault();
      checkAnswers();
    });
    els.nextBtn.addEventListener("click", (e) => {
      e.preventDefault();
      currentIndex++;
      loadScenario();
    });
  }

  function loadScenario() {
    if (currentIndex >= exercises.length) return showResults();

    const ex = exercises[currentIndex];
    userSelections = {};

    els.progress.textContent = `Scenariusz ${currentIndex + 1} / ${exercises.length}`;
    els.scenarioTitle.textContent = ex.title || `Sytuacja ${currentIndex + 1}`;
    els.scenarioText.textContent = ex.text || "";

    els.feedback.classList.add("hide");
    els.feedback.innerHTML = "";

    els.checkBtn.classList.remove("hide");
    els.checkBtn.disabled = true;
    els.nextBtn.classList.add("hide");

    renderActions(ex.actions || []);
  }

  function renderActions(actions) {
    els.scalesContainer.innerHTML = "";

    actions.forEach((action, index) => {
      const row = document.createElement("div");
      row.className = "scale-row large-text";

      const label = document.createElement("div");
      label.className = "scale-label";
      label.innerHTML = `${action.text} <strong id="val-${index}">?</strong>`;
      row.appendChild(label);

      const btnContainer = document.createElement("div");
      btnContainer.className = "scale-buttons";

      for (let i = 1; i <= 5; i++) {
        const btn = document.createElement("div");
        btn.className = "scale-btn";
        btn.textContent = i;
        btn.dataset.value = i;
        btn.onclick = () => handleSelection(index, i, btnContainer, actions.length);
        btnContainer.appendChild(btn);
      }

      row.appendChild(btnContainer);
      els.scalesContainer.appendChild(row);
    });
  }

  function handleSelection(actionIdx, value, container, actionsLen) {
    const buttons = container.querySelectorAll(".scale-btn");
    buttons.forEach((b) => b.classList.remove("selected"));
    buttons[value - 1].classList.add("selected");

    document.getElementById(`val-${actionIdx}`).textContent = value + "/5";
    userSelections[actionIdx] = value;

    if (Object.keys(userSelections).length === actionsLen) {
      els.checkBtn.disabled = false;
    }
  }

  function checkAnswers() {
    const ex = exercises[currentIndex];
    const actions = ex.actions || [];
    let correctCount = 0;

    const scales = els.scalesContainer.querySelectorAll(".scale-row");

    actions.forEach((action, idx) => {
      const userVal = userSelections[idx];
      const ideal = action.ideal;

      const container = scales[idx].querySelector(".scale-buttons");
      const buttons = container.querySelectorAll(".scale-btn");
      buttons.forEach((b) => (b.style.pointerEvents = "none"));

      const distance = Math.abs(userVal - ideal);
      const isCorrect = distance <= 1;
      if (isCorrect) correctCount++;

      const userBtn = buttons[userVal - 1];
      if (isCorrect) userBtn.classList.add("good-match");
      else userBtn.classList.add("bad-match");

      buttons[ideal - 1].classList.add("is-ideal");
    });

    const allCorrect = correctCount === actions.length;
    if (allCorrect) totalPerfect++;

    els.feedback.innerHTML = `
      <p><strong>${allCorrect ? "Doskonale!" : "Dobra analiza."}</strong></p>
      <p class="muted" style="margin-top:0.5rem; font-size:0.9rem">${ex.explanation || ""}</p>
      <p class="muted" style="margin-top:0.5rem; font-size: 0.9em">Zielona obwódka wskazuje odpowiedź eksperta.</p>
    `;
    els.feedback.classList.remove("hide");

    els.checkBtn.classList.add("hide");
    els.nextBtn.classList.remove("hide");
  }

  async function showResults() {
    els.root.classList.add("hide");
    els.results.classList.remove("hide");
    els.finalScore.textContent = `Wynik perfekcyjny: ${totalPerfect} / ${exercises.length} scenariuszy`;

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
