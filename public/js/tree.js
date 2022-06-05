(function setListeners() {
    const nodes = document.querySelectorAll(".nodeLabel");
    nodes.forEach((node) => {
        node.addEventListener("click", () => {
            const nodeContent = node.nextElementSibling;
            if (node.classList.contains("closed")) {
                node.classList.remove("closed");
                $(nodeContent).slideDown();
            } else {
                $(nodeContent).slideUp(() => {
                    node.classList.add("closed");
                });
            }
        });
    });
})();
