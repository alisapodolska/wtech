document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-link");
    const contents = document.querySelectorAll(".tab-content");

    console.log("Tabs found:", tabs.length);  // Debugging
    console.log("Contents found:", contents.length);  // Debugging

    if (tabs.length === 0 || contents.length === 0) {
        console.error("Tabs or contents not found. Check if they exist in HTML.");
        return;
    }

    tabs.forEach(tab => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            // Remove "active" class from all tabs
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            // Hide all content
            contents.forEach(content => content.style.display = "none");

            // Show the correct content
            const selectedTab = this.getAttribute("data-tab");
            document.querySelectorAll(`.${selectedTab}`).forEach(content => content.style.display = "block");
        });
    });
});