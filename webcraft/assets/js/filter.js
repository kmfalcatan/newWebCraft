function filterTable() {
    const selectedYear = document.querySelector('.year').value;
    const selectedArticle = document.querySelector('.article').value;
    const selectedCustodian = document.querySelector('.custodian').value;

    const rows = document.querySelectorAll('#tblBody tr');

    rows.forEach(row => {
        const yearCell = row.querySelector('td:nth-child(7)');
        const articleCell = row.querySelector('td:nth-child(3)'); 
        const custodianCell = row.querySelector('td:nth-child(6)');

        const yearMatch = selectedYear === 'All' || yearCell.textContent.trim() === selectedYear;
        const articleMatch = selectedArticle === 'All' || articleCell.textContent.trim() === selectedArticle;
        const custodianMatch = selectedCustodian === 'All' || custodianCell.textContent.trim() === selectedCustodian;

        if ((selectedYear === 'All' || yearMatch) || (selectedArticle === 'All' || articleMatch) || (selectedCustodian === 'All' || custodianMatch)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

document.querySelector('.year').addEventListener('change', filterTable);
document.querySelector('.article').addEventListener('change', filterTable);
document.querySelector('.custodian').addEventListener('change', filterTable);