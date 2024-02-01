document.addEventListener('DOMContentLoaded', function () {
    const tableDropdown = document.getElementById('table');
    const peopleAmountDropdown = document.getElementById('peopleAmount');
    const locationDropdown = document.getElementById('location');

    function updateTables(locationId) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    tableDropdown.innerHTML = xhr.responseText;

                    // After tables are updated, get the initial table value and update people amount
                    const initialTableId = tableDropdown.value;
                    updatePeopleAmount(initialTableId);
                }
            }
        };

        xhr.open('GET', 'api/table/tables?locationId=' + locationId, true);
        xhr.send();
    }

    function updatePeopleAmount(tableId) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    peopleAmountDropdown.innerHTML = xhr.responseText;
                }
            }
        };

        xhr.open('GET', 'api/table/seat?tableId=' + tableId, true);
        xhr.send();
    }

    locationDropdown.addEventListener('change', function () {
        const locationId = this.value;
        updateTables(locationId);
    });

    tableDropdown.addEventListener('change', function () {
        const tableId = this.value;
        updatePeopleAmount(tableId);
    });

    // Initial update based on the default selected location and table
    const initialLocationId = locationDropdown.value;
    updateTables(initialLocationId);
    const initialTableId = tableDropdown.value;
    updatePeopleAmount(initialTableId);
});
