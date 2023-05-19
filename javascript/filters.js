function filterClose() {
    document.addEventListener('click', function clickOutside(event) {
        const getFilters = document.getElementById('filters');
        const getDateFilter = document.getElementById('date-filter');
        const exception = document.getElementById('filters-button');
        if (!exception.contains(event.target) && !getFilters.contains(event.target) && getFilters.style.display == 'block') {
            getFilters.style.display = 'none';
            getDateFilter.style.display = 'none';
        }
    });
}

function openFilters() {
    if (document.getElementById("filters").style.display == "block") {
        document.getElementById("filters").style.display = "none";
        return;
    }
    document.getElementById("filters").style.display = "block";
}

function retrieveDateFilterInput() {
    const dateFilterFrom = document.getElementById("date-filter-input-from").value;
    const dateFilterTo = document.getElementById("date-filter-input-to").value;
    console.log("From: " + dateFilterFrom);
    console.log("To: " + dateFilterTo);
}

function openDateFilter() {
    if (document.getElementById("date-filter").style.display == "block") {
        document.getElementById("date-filter").style.display = "none";
        return;
    }
    document.getElementById("date-filter").style.display = "block";
}

function retrieveAgentFilterInput() {

}

function openAgentFilter() {
    if (document.getElementById("agent-filter").style.display == "block") {
        document.getElementById("agent-filter").style.display = "none";
        return;
    }
    document.getElementById("agent-filter").style.display = "block";
}


filterClose();