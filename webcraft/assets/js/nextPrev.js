document.addEventListener("DOMContentLoaded", function() {
    const subContainers = document.querySelectorAll(".subContainer1");
    const itemsPerPage = 9; 
    let currentPage = 0;

    function showPage(page) {
        const startIndex = page * itemsPerPage;
        const endIndex = (page + 1) * itemsPerPage;

        subContainers.forEach((container, index) => {
            if (index >= startIndex && index < endIndex) {
                container.style.display = "block";
            } else {
                container.style.display = "none";
            }
        });
    }

    function nextPage() {
        if ((currentPage + 1) * itemsPerPage < subContainers.length) {
            currentPage++;
            showPage(currentPage);
        }
    }

    function previousPage() {
        if (currentPage > 0) {
            currentPage--;
            showPage(currentPage);
        }
    }

    showPage(currentPage);

    document.querySelector(".nextbtn").addEventListener("click", nextPage);
    document.querySelector(".previousbtn").addEventListener("click", previousPage);
});