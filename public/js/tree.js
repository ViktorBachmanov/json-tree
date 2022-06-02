(function setListeners() {
    const nodes = document.querySelectorAll(".nodeLabel");
    nodes.forEach((node) => {
        node.addEventListener("click", () => {
            node.classList.toggle("closed");
            node.nextElementSibling.classList.toggle("hidden");
        });
    });
})();
