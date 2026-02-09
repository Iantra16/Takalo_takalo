document.addEventListener("DOMContentLoaded", () => {
  function setupValidation(config) {
    const form = document.querySelector(config.formSelector);
    if (!form) return;

    const statusBox = document.querySelector(config.statusSelector || "#formStatus");
    const map = config.map;

    function setStatus(type, msg) {
      if (!statusBox) return;
      if (!msg) {
        statusBox.className = "alert d-none";
        statusBox.textContent = "";
        return;
      }
      statusBox.className = `alert alert-${type}`;
      statusBox.textContent = msg;
    }

    function clearFeedback() {
      Object.keys(map).forEach((k) => {
        const input = document.querySelector(map[k].input);
        const err = document.querySelector(map[k].err);
        if (input) input.classList.remove("is-invalid", "is-valid");
        if (err) err.textContent = "";
      });
      setStatus(null, "");
    }

    function applyServerResult(data) {
      if (config.applyValues) config.applyValues(data);

      Object.keys(map).forEach((k) => {
        const input = document.querySelector(map[k].input);
        const err = document.querySelector(map[k].err);
        const msg = (data.errors && data.errors[k]) ? data.errors[k] : "";

        if (!input) return;

        if (msg) {
          input.classList.add("is-invalid");
          input.classList.remove("is-valid");
          if (err) err.textContent = msg;
        } else {
          input.classList.remove("is-invalid");
          input.classList.add("is-valid");
          if (err) err.textContent = "";
        }
      });

      if (config.applyServerResultExtra) {
        config.applyServerResultExtra(data, setStatus);
      }
    }

    async function callValidate() {
      const fd = new FormData(form);
      const res = await fetch(config.endpoint, {
        method: "POST",
        body: fd,
        headers: { "X-Requested-With": "XMLHttpRequest" },
      });
      if (!res.ok) throw new Error("Erreur serveur lors de la validation.");
      return res.json();
    }

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      clearFeedback();

      try {
        const data = await callValidate();
        applyServerResult(data);

        if (data.ok) {
          setStatus("success", config.successMessage);
          form.submit();
        } else {
          setStatus("danger", "Veuillez corriger les erreurs.");
        }
      } catch (err) {
        setStatus("warning", err.message || "Une erreur est survenue.");
      }
    });

    Object.keys(map).forEach((k) => {
      const input = document.querySelector(map[k].input);
      if (!input) return;
      input.addEventListener("blur", async () => {
        try {
          const data = await callValidate();
          applyServerResult(data);
        } catch (_) {}
      });
    });
  }

  setupValidation({
    formSelector: "#loginForm",
    endpoint: "/api/validate/login",
    successMessage: "Validation OK ✅ Envoi en cours...",
    map: {
      email: { input: "#email", err: "#emailError" },
      password: { input: "#password", err: "#passwordError" },
    },
    applyServerResultExtra: (data, setStatus) => {
      if (data.errors && data.errors._global) {
        setStatus("warning", data.errors._global);
      }
    },
  });

  setupValidation({
    formSelector: "#completeForm",
    endpoint: "/api/validate/complete-profile",
    successMessage: "Validation OK ✅ Création du compte...",
    map: {
      nom: { input: "#nom", err: "#nomError" },
      prenom: { input: "#prenom", err: "#prenomError" },
      telephone: { input: "#telephone", err: "#telephoneError" },
    },
    applyValues: (data) => {
      if (data.values && data.values.telephone) {
        const tel = document.querySelector("#telephone");
        if (tel) tel.value = data.values.telephone;
      }
    },
  });
});
