(() => {
  const cfg = window.__ARIE__ || {};
  const exercises = cfg.exercises || [];
  let currentIndex = 0;
  let score = 0;

  function init() {
    const root = document.getElementById("game-root");
    if (!exercises.length) {
      root.innerHTML = "<p>Brak danych treningowych w bazie.</p>";
      return;
    }
    loadQuestion();
  }

  function loadQuestion() {
    if (currentIndex >= exercises.length) return finish();

    const q = exercises[currentIndex];
    document.getElementById("progress").innerText = `Zdjęcie ${currentIndex + 1} z ${exercises.length}`;

    const mediaContainer = document.getElementById("media-display");
    mediaContainer.innerHTML = '<div class="muted">Ładowanie zdjęcia...</div>';

    const optionsArea = document.getElementById("options-area");
    optionsArea.style.opacity = "0";

    document.getElementById("question-text").textContent = q.question;

    const img = new Image();
    img.src = q.image;
    img.className = "exercise-image";
    img.style.display = "none";

    img.onload = () => {
      setTimeout(() => {
        mediaContainer.innerHTML = "";
        mediaContainer.appendChild(img);
        img.style.display = "block";
        img.style.animation = "pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)";
        optionsArea.style.opacity = "1";
        optionsArea.style.transition = "opacity 0.3s";
      }, 500);
    };

    optionsArea.innerHTML = "";
    const fb = document.getElementById("feedback");
    fb.textContent = "";
    fb.className = "feedback-msg";

    (q.options || []).forEach((opt) => {
      const btn = document.createElement("button");
      btn.className = "option-btn";
      btn.textContent = opt;
      btn.onclick = () => handleAnswer(btn, opt, q.correct);
      optionsArea.appendChild(btn);
    });
  }

  function handleAnswer(btn, selected, correct) {
    if (document.querySelector(".option-btn:disabled")) return;

    const opts = document.querySelectorAll(".option-btn");
    opts.forEach((b) => (b.disabled = true));

    const fb = document.getElementById("feedback");
    fb.classList.add("visible");

    if (selected === correct) {
      score++;
      btn.classList.add("selected-correct");
      fb.textContent = "Dobrze!";
      fb.classList.add("success");
    } else {
      btn.classList.add("selected-wrong");
      fb.textContent = `Błąd. To ${correct}.`;
      fb.classList.add("error");
    }

    setTimeout(() => {
      currentIndex++;
      loadQuestion();
    }, 1000);
  }

  async function finish() {
    document.getElementById("game-root").classList.add("hide");
    document.getElementById("results-area").classList.remove("hide");
    document.getElementById("final-score").textContent = `Wynik: ${score} / ${exercises.length}`;

    try {
      await fetch(cfg.storeUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": cfg.csrf,
        },
        body: JSON.stringify({ score, max_score: exercises.length }),
      });
    } catch (e) {
      console.error(e);
    }
  }

  init();
})();
