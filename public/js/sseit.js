(() => {
  const cfg = window.__ARIE__ || {};
  const form = document.getElementById("sseit-form");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const btn = document.getElementById("submit-btn");
    btn.disabled = true;
    btn.textContent = "Obliczanie wyników...";

    const formData = new FormData(form);

    try {
      const response = await fetch(cfg.sseitStoreUrl, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "X-CSRF-TOKEN": cfg.csrf,
        },
        body: formData,
      });

      if (!response.ok) {
        const errData = await response.json().catch(() => ({}));
        alert("Błąd zapisu: " + (errData.message || "Wystąpił nieoczekiwany błąd."));
        btn.disabled = false;
        btn.textContent = "Zapisz wynik";
        return;
      }

      const respJson = await response.json();
      const results = respJson.results;

      document.getElementById("res-total").textContent = `${results.total_score} / ${results.max_total}`;
      document.getElementById("res-perception").textContent = results.perception;
      document.getElementById("res-usage").textContent = results.use_emotions;
      document.getElementById("res-own").textContent = results.manage_own;
      document.getElementById("res-others").textContent = results.manage_others;

      document.getElementById("sseit-result").classList.remove("hide");
      btn.classList.add("hide");

      form.querySelectorAll("input").forEach((i) => (i.disabled = true));

      setTimeout(() => window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" }), 100);
    } catch (err) {
      console.error(err);
      alert("Błąd połączenia z serwerem.");
      btn.disabled = false;
      btn.textContent = "Zapisz wynik";
    }
  });
})();
