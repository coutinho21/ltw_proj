import { buildTicket } from '../utilities/utilities.js';

function buttonOpenFilters() {
    const button = document.getElementById('filters-button');

    if (button) {
        button.addEventListener('click', () => openFilters());
    }
}

function filtersClose() {
    document.addEventListener('click', function clickOutside(event) {
        const getFilters = document.getElementById('filters');
        const getDateFilter = document.getElementById('date-filter');
        const getAgentFilter = document.getElementById('agent-filter');
        const getStatusFilter = document.getElementById('status-filter');
        const getHashtagFilter = document.getElementById('hashtag-filter');
        const exceptionFilters = document.getElementById('filters-button');
        const exceptionDateFilter = document.getElementById('date-filter-li');
        const exceptionAgentFilter = document.getElementById('agent-filter-li');
        const exceptionStatusFilter = document.getElementById('status-filter-li');
        const exceptionHashtagFilter = document.getElementById('hashtag-filter-li');
        if (getFilters && !getDateFilter && !getAgentFilter && !getStatusFilter && !getHashtagFilter && !exceptionFilters.contains(event.target) && !getFilters.contains(event.target)) {
            getFilters.remove();
        }
        if (getDateFilter && getFilters && !getDateFilter.contains(event.target) && !exceptionDateFilter.contains(event.target)) {
            getDateFilter.remove();
        }
        if (getAgentFilter && getFilters && !getAgentFilter.contains(event.target) && !exceptionAgentFilter.contains(event.target)) {
            getAgentFilter.remove();
        }
        if (getStatusFilter && getFilters && !getStatusFilter.contains(event.target) && !exceptionStatusFilter.contains(event.target)) {
            getStatusFilter.remove();
        }
        if (getHashtagFilter && getFilters && !getHashtagFilter.contains(event.target) && !exceptionHashtagFilter.contains(event.target)) {
            getHashtagFilter.remove();
        }
    });
}

function openFilters() {
    const main = document.getElementById("filters-div");

    if (main) {
        // filters div
        const filters = document.createElement("div");
        filters.id = "filters";

        // filters title
        const title = document.createElement("h4");
        title.textContent = "Filter by:";
        filters.appendChild(title);

        // filters list
        const filtersList = document.createElement("ul");

        // date filter list item
        const dateFilter = document.createElement("li");
        dateFilter.id = "date-filter-li";
        dateFilter.onclick = openDateFilter;
        const dateFilterText = document.createElement("p");
        dateFilterText.textContent = "Date";
        dateFilter.appendChild(dateFilterText);
        filtersList.appendChild(dateFilter);

        // agent filter list item
        const agentFilter = document.createElement("li");
        agentFilter.id = "agent-filter-li";
        agentFilter.onclick = openAgentFilter;
        const agentFilterText = document.createElement("p");
        agentFilterText.textContent = "Assigned Agent";
        agentFilter.appendChild(agentFilterText);
        filtersList.appendChild(agentFilter);

        // status filter list item
        const statusFilter = document.createElement("li");
        statusFilter.id = "status-filter-li";
        statusFilter.onclick = openStatusFilter;
        const statusFilterText = document.createElement("p");
        statusFilterText.textContent = "Status";
        statusFilter.appendChild(statusFilterText);
        filtersList.appendChild(statusFilter);

        // hashtag filter list item
        const hashtagFilter = document.createElement("li");
        hashtagFilter.id = "hashtag-filter-li";
        hashtagFilter.onclick = openHashtagFilter;
        const hashtagFilterText = document.createElement("p");
        hashtagFilterText.textContent = "Hashtag";
        hashtagFilter.appendChild(hashtagFilterText);
        filtersList.appendChild(hashtagFilter);

        filters.appendChild(filtersList);

        main.appendChild(filters);
    }
}

async function retrieveDateFilterInput() {
    const dateFilterFrom = document.getElementById("date-filter-input-from").value;
    const dateFilterTo = document.getElementById("date-filter-input-to").value;

    const response = await fetch('../api/filters.php?filter=date&from=' + dateFilterFrom + '&to=' + dateFilterTo);
    const data = await response.json();

    const tickets = document.querySelector('.tickets-list ul');
    tickets.innerHTML = '';

    data.forEach(ticket => {
        tickets.appendChild(buildTicket(ticket));
    });
}

function openDateFilter() {
    const main = document.getElementById("filters-div");

    if (main) {
        const dateFilter = document.createElement("div");
        dateFilter.id = "date-filter";

        const title = document.createElement("h4");
        title.textContent = "Filter by date";
        dateFilter.appendChild(title);

        const labelFrom = document.createElement("label");
        labelFrom.textContent = "From";
        dateFilter.appendChild(labelFrom);
        const inputFrom = document.createElement("input");
        inputFrom.type = "date";
        inputFrom.id = "date-filter-input-from";
        dateFilter.appendChild(inputFrom);

        const labelTo = document.createElement("label");
        labelTo.textContent = "To";
        dateFilter.appendChild(labelTo);
        const inputTo = document.createElement("input");
        inputTo.type = "date";
        inputTo.id = "date-filter-input-to";
        dateFilter.appendChild(inputTo);

        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveDateFilterInput;
        dateFilter.appendChild(button);

        main.appendChild(dateFilter);
    }
}

function retrieveAgentFilterInput() {

}

async function openAgentFilter() {
    /* fazer isto
    <div id="agent-filter">
        <h4>Filter by agent</h4>
        <label>Select agent:</label>
        <select>
            <option value="agent1">Agent 1</option>
        </select>
    </div>

    */

    const main = document.getElementById("filters-div");

    if (main) {
        const response = await fetch('../api/filters.php?filter=agent');
        const data = await response.json();

        const agentFilter = document.createElement("div");
        agentFilter.id = "agent-filter";

        const title = document.createElement("h4");
        title.textContent = "Filter by agent";
        agentFilter.appendChild(title);

        const labelAgent = document.createElement("label");
        labelAgent.textContent = "Select agent:";
        agentFilter.appendChild(labelAgent);
        const selectAgent = document.createElement("select");
        selectAgent.id = "agent-filter-input";
        for (let i = 0; i < data.length; i++) {
            const option = document.createElement("option");
            option.value = data[i].id;
            option.textContent = data[i].name;
            selectAgent.appendChild(option);
        }

        const button = document.createElement("button");
        button.textContent = "Filter";
        button.onclick = retrieveDateFilterInput;
        dateFilter.appendChild(button);

        main.appendChild(dateFilter);
    }
}

function retrieveStatusFilterInput() {

}

function openStatusFilter() {

}

function retrieveHashtagFilterInput() {

}

function openHashtagFilter() {

}


filtersClose();
buttonOpenFilters();
