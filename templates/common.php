<?php 
    function outputHeader(){
?>
        <!DOCTYPE html>
        <html lang="en-US">

        <head>
            <title>Trouble Tickets</title>
            <meta charset="UTF-8">
            <meta name="css/viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" href="../icons/ticket.png" type="image/png" sizes="16x16">
            <link rel="stylesheet" href="../css/homepage_client_style.css">
            <link rel="stylesheet" href="../css/ticket.css">
            <link rel="stylesheet" href="../css/profile.css">
            <link rel="stylesheet" href="../css/faqs.css">
            <script src="../javascript/script.js" defer></script>
            <script src="../javascript/filters.js" defer></script>
            <script src="../errors/errors.js" defer></script>
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><a class="main-title" href="index.php">Trouble<br/>Tickets</a></li>
                        <li>
                            <div class="nav-right">
                                <a href="faqs.php">FAQs</a>
                                <a href="profile.php"><img class="profile" src="../icons/user.png" alt="user"/></a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>
<?php 
    } 

    function outputFooter(){ ?>
            <footer>
                <p>&copy; Trouble Tickets, 2023</p>
            </footer>
        </body>
        </html>
<?php 
    } 

    function outputAddSearchFilter($content, $departments, $role){
?>
        <nav class="add-and-search">
            <a href="../pages/new_ticket.php">New ticket</a>
            <input name="search_ticket" placeholder="Search ticket" class="search-ticket"/>
            <?php if($role != 'client') { ?>
                <button type="button" id="filters-button" onclick="openFilters()"><img src="../icons/filter.png" alt="filter"/></button>
                <div id="filters">
                    <h4>Filter by:</h4>
                    <ul>
                        <li onclick="openDateFilter()"><p>Date</p></li>
                        <li onclick="openAgentFilter()"><p>Assigned agent</p></li>
                        <li id="status-filter"><p>Status</p></li>
                        <li id="hashtag-filter"><p>Hashtag</p></li>
                    </ul>
                </div>
                <div id="date-filter">
                    <h4>Filter by date</h4>
                    <label>From:</label>
                    <input type="date" id="date-filter-input-from"/>
                    <label>To:</label>
                    <input type="date" id="date-filter-input-to"/>
                </div>
                <div id="agent-filter">
                    <h4>Filter by agent</h4>
                    <label>Select agent:</label>
                    <select>
                        <option value="agent1">Agent 1</option>
                    </select>
                </div>

            <?php }?>
        </nav>
        <main class="main-content">
            <ul class="departments">
                <?php foreach($departments as $department){ ?>
                    <li><p><?=$department['name']?></p></li>
                <?php } ?>
            </ul>
            <?=$content?>
        </main>
<?php
    }
?>