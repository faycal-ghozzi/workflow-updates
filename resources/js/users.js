document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".custom-select-wrapper").forEach(wrapper => {
    const input = wrapper.querySelector(".custom-select-input");
    const hiddenInput = wrapper.querySelector("input[type=hidden]");
    const optionsWrapper = wrapper.querySelector(".custom-select-options");

    const searchInput = document.createElement("input");
    searchInput.type = "text";
    searchInput.className = "form-control";
    searchInput.placeholder = "Rechercher...";
    searchInput.style.marginBottom = "5px";

    const allOptions = Array.from(optionsWrapper.querySelectorAll(".custom-option"));

    input.addEventListener("click", () => {
      optionsWrapper.classList.toggle("d-none");
      if (!optionsWrapper.classList.contains("d-none")) {
        optionsWrapper.prepend(searchInput);
        searchInput.focus();
      }
    });

    searchInput.addEventListener("input", () => {
      const searchTerm = searchInput.value.toLowerCase();
      optionsWrapper.querySelectorAll(".custom-option").forEach(opt => {
        const text = opt.textContent.toLowerCase();
        opt.style.display = text.includes(searchTerm) ? "block" : "none";
      });
    });

    optionsWrapper.addEventListener("click", e => {
      if (e.target.classList.contains("custom-option")) {
        const selected = e.target;
        input.value = selected.textContent;
        hiddenInput.value = selected.dataset.value;
        optionsWrapper.classList.add("d-none");
      }
    });

    document.addEventListener("click", e => {
      if (!wrapper.contains(e.target)) {
        optionsWrapper.classList.add("d-none");
      }
    });
  });
});
