import 'datatables.net';
import 'datatables.net-bs5';
import { datatableLanguage } from './datatables/config';
import $ from 'jquery';

$(document).ready(function () {
    $('#liste-utilisateurs').DataTable({
        language: datatableLanguage
    });
});


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


  const initCustomMultiSelect = (containerId, inputName) => {
    const container = document.getElementById(containerId);
    if (!container) return;
  
    const available = container.querySelector(".available-items");
    const selected = container.querySelector(".selected-items");
  
    available.addEventListener("click", (e) => {
      const pill = e.target.closest(".custom-pill");
      if (!pill) return;
      const value = pill.dataset.value;
  
      const selectedPill = document.createElement("span");
      selectedPill.className = "custom-pill selected";
      selectedPill.dataset.value = value;
      selectedPill.innerHTML = `${pill.textContent} <span class="remove">&times;</span>`;
  
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = inputName;
      input.value = value;
      selectedPill.appendChild(input);
  
      selected.appendChild(selectedPill);
      pill.remove();
    });
  
    selected.addEventListener("click", (e) => {
      if (!e.target.classList.contains("remove")) return;
  
      const pill = e.target.closest(".custom-pill");
      const value = pill.dataset.value;
  
      const newAvailable = document.createElement("span");
      newAvailable.className = "custom-pill";
      newAvailable.dataset.value = value;
      newAvailable.textContent = value;
  
      available.appendChild(newAvailable);
      pill.remove();
    });
  };
  
  initCustomMultiSelect("role-selector", "roles[]");
  
});
