function calculateTotals() {
    const rows = document.querySelectorAll('tbody tr:not(.total-row)');
    const totalOBD = document.querySelector('.total-obd');
    const totalCBD = document.querySelector('.total-cbd');
    const totalOBP = document.querySelector('.total-obp');
    const totalCBP = document.querySelector('.total-cbp');
    const totalOBR = document.querySelector('.total-obr');
    const totalCBR = document.querySelector('.total-cbr');
    const totalOBL = document.querySelector('.total-obl');
    const totalCBL = document.querySelector('.total-cbl');
    const totalUND = document.querySelector('.total-und');
    const totalJumlah = document.querySelector('.total-jumlah');

    let obdSum = 0, cbdSum = 0, obpSum = 0, cbpSum = 0, obrSum = 0, cbrSum = 0, oblSum = 0, cblSum = 0, undSum = 0, jumlahSum = 0;

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const obd = parseInt(cells[1].innerText) || 0;
        const cbd = parseInt(cells[2].innerText) || 0;
        const obp = parseInt(cells[3].innerText) || 0;
        const cbp = parseInt(cells[4].innerText) || 0;
        const obr = parseInt(cells[5].innerText) || 0;
        const cbr = parseInt(cells[6].innerText) || 0;
        const obl = parseInt(cells[7].innerText) || 0;
        const cbl = parseInt(cells[8].innerText) || 0;
        const und = parseInt(cells[9].innerText) || 0;

        const jumlah = obd + cbd + obp + cbp + obr + cbr + obl + cbl + und;
        cells[10].innerText = jumlah;

        obdSum += obd;
        cbdSum += cbd;
        obpSum += obp;
        cbpSum += cbp;
        obrSum += obr;
        cbrSum += cbr;
        oblSum += obl;
        cblSum += cbl;
        undSum += und;
        jumlahSum += jumlah;
    });

    totalOBD.innerText = obdSum;
    totalCBD.innerText = cbdSum;
    totalOBP.innerText = obpSum;
    totalCBP.innerText = cbpSum;
    totalOBR.innerText = obrSum;
    totalCBR.innerText = cbrSum;
    totalOBL.innerText = oblSum;
    totalCBL.innerText = cblSum;
    totalUND.innerText = undSum;
    totalJumlah.innerText = jumlahSum;
}

// Call the function to calculate totals on page load
calculateTotals();