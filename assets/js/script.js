function toggleadd13a(value) {
    const add13a = document.getElementById('pekerjaan_section');
    const inputs = add13a.querySelectorAll('input');
    const selects = add13a.querySelectorAll('select'); // Temukan elemen <select>
    const telepon = document.querySelector('input[name="q18"]');
    const website = document.querySelector('input[name="website"]');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '1') {
        add13a.classList.remove('hidden');
        // Make inputs required when visible
        inputs.forEach(input => input.required = true);
        telepon.required = false;
        website.required = false;
        selects.forEach(select => select.required = true); // Tambahkan atribut required ke <select>
    } else {
        add13a.classList.add('hidden');
        // Remove required attribute when hidden
        inputs.forEach(input => input.required = false);
        selects.forEach(select => select.required = false); // Hapus atribut required dari <select>
    }
}


function toggleadd14(value) {
    const add14 = document.getElementById('kerja_lainnya');
    const inputs = add14.querySelector('input');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '8') {
        add14.classList.remove('hidden');
        // Make inputs required when visible
        input.required = true;
    } else {
        add14.classList.add('hidden');
        // Remove required attribute when hidden
        input.required = false;
    }
}

function toggleadd25(value) {
    const add25 = document.getElementById('pekerjaan_pertama');
    const inputs = add25.querySelectorAll('input');
    const selects = add25.querySelectorAll('select');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '2') {
        add25.classList.remove('hidden');
        // Make inputs required when visible
        inputs.forEach(input => input.required = true);
        selects.forEach(select => select.required = true);
    } else {
        add25.classList.add('hidden');
        // Remove required attribute when hidden
        inputs.forEach(input => input.required = false);
        selects.forEach(select => select.required = false);
    }
}

function toggleadd37(value) {
    const add37 = document.getElementById('aktif_org');
    const select = add37.querySelector('select'); // Temukan elemen <select>
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '1') {
        add37.classList.remove('hidden');
        // Make inputs required when visible
        select.required = true; // Tambahkan atribut required ke <select>
    } else {
        add37.classList.add('hidden');
        // Remove required attribute when hidden
        select.required = false; // Hapus atribut required dari <select>
    }
}

function toggleadd39(value) {
    const add39 = document.getElementById('kursus_apa');
    const inputs = add39.querySelectorAll('input');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '1') {
        add39.classList.remove('hidden');
        // Make inputs required when visible
        inputs.forEach(input => input.required = true);
    } else {
        add39.classList.add('hidden');
        // Remove required attribute when hidden
        inputs.forEach(input => input.required = false);
    }
}


function toggleadd49(value) {
    const add49a = document.getElementById('kes_pilih2');
    const inputs = add49a.querySelectorAll('input');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '2') {
        add49a.classList.remove('hidden');
        // Make inputs required when visible
        inputs.forEach(input => input.required = true);
    } else {
        add49a.classList.add('hidden');
        // Remove required attribute when hidden
        inputs.forEach(input => input.required = false);
    }
}

function toggleadd50(value) {
    const add50 = document.getElementById('kes_pilih');
    const inputs = add50.querySelectorAll('input');
    // Show additional questions if option 'C' is selected, otherwise hide them
    if (value === '2') {
        add50.classList.remove('hidden');
        // Make inputs required when visible
        inputs.forEach(input => input.required = true);
    } else {
        add50.classList.add('hidden');
        // Remove required attribute when hidden
        inputs.forEach(input => input.required = false);
    }
}

