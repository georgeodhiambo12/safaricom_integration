<?php
// Redirect to the login page
header("Location: /sample/login.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TenderSoko</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0288d1;
            color: white;
            padding: 15px 20px;
            flex-wrap: wrap;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
        }

        .logo {
            height: 50px;
            margin-right: 10px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .search-input {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 25px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #0288d1;
        }

        .search-button {
            padding: 8px 15px;
            border: none;
            background-color: #00acc1;
            color: white;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #0097a7;
        }

        .navigation {
            display: flex;
            gap: 10px;
            margin-left: auto;
            flex-wrap: wrap;
        }

        .navigation button {
            background-color: transparent;
            border: 2px solid transparent;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navigation button:hover {
            border-bottom: 2px solid white;
        }

        /* Distinct styling for Login and Register buttons */
        .navigation button:nth-last-child(2),
        .navigation button:last-child {
            border: 2px solid #00acc1;
            border-radius: 25px;
            padding: 8px 15px;
            margin-left: 10px;
        }

        .navigation button:nth-last-child(2):hover,
        .navigation button:last-child:hover {
            background-color: #00acc1;
            color: white;
        }

        .tenders {
            padding: 20px;
            background-color: #f9fafb;
            flex: 1;
        }

        .tender-item {
            background: #fff;
            margin: 15px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tender-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .tender-header {
            font-size: 20px;
            font-weight: bold;
            color: #0288d1;
            margin-bottom: 10px;
        }

        .tender-meta {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 15px;
            color: #777;
            font-size: 14px;
        }

        .tender-meta div {
            display: flex;
            align-items: center;
            flex: 1;
            margin: 5px 0;
        }

        .tender-meta div span {
            margin-left: 10px;
        }

        .view-details {
            background-color: #0288d1;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .view-details:hover {
            background-color: #0277bd;
        }

        .days-left {
            background-color: #4caf50;
            color: white;
            padding: 5px 15px;
            border-radius: 25px;
            font-size: 14px;
            display: inline-block;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .pagination select {
            padding: 10px 15px;
            border: none;
            background-color: #0288d1;
            color: white;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pagination select:hover {
            background-color: #0277bd;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            max-width: 90%;
            max-height: 80%;
            overflow-y: auto;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .footer {
            background-color: #0288d1;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: relative;
            width: 100%;
            flex-shrink: 0;
        }

        .toast {
            visibility: hidden;
            max-width: 50px;
            height: 50px;
            margin: auto;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 25px;
            position: fixed;
            z-index: 1;
            bottom: 30px;
            left: 0;
            right: 0;
            font-size: 17px;
            white-space: nowrap;
        }

        .toast #desc {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .toast.show {
            visibility: visible;
            max-width: 250px;
            transition: all 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .tender-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                margin: 10px 0;
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .navigation {
                flex-direction: column;
                gap: 5px;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <a href="index.php">
                <img src="images/tendersoko.jpg" alt="TenderSoko Logo" class="logo">
            </a>
            <h1>TenderSoko</h1>
        </div>
        <div class="navigation">
            <button data-endpoint="valid_tenders.php">Valid Tenders</button>
            <button data-endpoint="today_tenders.php">Today Tenders</button>
            <button data-endpoint="closing_tenders.php">Closing Tenders</button>
            <button data-endpoint="companies.php">Companies</button>
            <button data-endpoint="sectors.php">Sectors</button>
            <button data-endpoint="categories.php">Categories</button>
            <button onclick="window.location.href='login.php'">Login</button>
            <button onclick="window.location.href='register.php'">Register</button>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search...">
            <button id="searchButton" class="search-button">🔍</button>
        </div>
    </div>

    <div id="tendersContainer" class="tenders">
        <!-- Tenders will be rendered here -->
    </div>

    <div class="pagination" id="pagination">
        <!-- Pagination buttons will be rendered here -->
        <select id="paginationSelect">
            <!-- Pagination options will be rendered here -->
        </select>
    </div>

    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalDetails">
                <!-- Tender details will be rendered here -->
            </div>
        </div>
    </div>

    <div class="loading-overlay">
        <div class="loader"></div>
    </div>

    <div class="footer">
        &copy; 2024 TenderSoko. All Rights Reserved.
    </div>

    <div id="toast" class="toast">
        <div id="desc"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.navigation button');
            const tendersContainer = document.getElementById('tendersContainer');
            const modal = document.getElementById('detailsModal');
            const closeModalBtn = document.querySelector('.close');
            const searchButton = document.getElementById('searchButton');
            const searchInput = document.getElementById('searchInput');
            const loadingOverlay = document.querySelector('.loading-overlay');
            const pagination = document.getElementById('pagination');
            const paginationSelect = document.getElementById('paginationSelect');
            const toast = document.getElementById('toast');

            let currentPage = 1;
            const tendersPerPage = 20;
            let currentEndpoint = 'valid_tenders.php';

            function setActiveTab(activeTab) {
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                });
                activeTab.classList.add('active');
            }

            async function fetchTenders(endpoint, page = 1) {
                currentEndpoint = endpoint;
                try {
                    showLoader();
                    const response = await fetch(`${endpoint}?page=${page}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();
                    renderTenders(data, endpoint);
                } catch (error) {
                    console.error('Error fetching tenders:', error);
                    tendersContainer.innerHTML = `<p>Error fetching data: ${error.message}</p>`;
                    showToast("Error fetching data");
                } finally {
                    hideLoader();
                }
            }

            function searchTenders(query) {
                fetchTenders(currentEndpoint, 1).then(() => {
                    const items = tendersContainer.querySelectorAll('.tender-item');
                    items.forEach(item => {
                        const title = item.querySelector('.tender-header').textContent.toLowerCase();
                        if (title.includes(query.toLowerCase())) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            function renderTenders(data, endpoint) {
                tendersContainer.innerHTML = '';
                const items = data.tenders || data.categories || data.companies || data.sectors || [];
                if (items.length === 0) {
                    tendersContainer.innerHTML = '<p>No data available</p>';
                    return;
                }

                const totalPages = Math.ceil(items.length / tendersPerPage);
                const paginatedItems = paginate(items, currentPage, tendersPerPage);

                paginatedItems.forEach(item => {
                    const tenderItem = document.createElement('div');
                    tenderItem.classList.add('tender-item');

                    const tenderHeader = document.createElement('div');
                    tenderHeader.classList.add('tender-header');
                    tenderHeader.innerHTML = item.title || item.name;

                    const tenderMeta = document.createElement('div');
                    tenderMeta.classList.add('tender-meta');
                    
                    if (endpoint.includes('tenders')) {
                        tenderMeta.innerHTML = `
                            <div><span>Closing Date:</span><span>${item.closing_date}</span></div>
                            <div><span>Company:</span><span>${item.company}</span></div>
                            <div><span>Sector:</span><span>${item.sector}</span></div>
                            <div><span>Category:</span><span>${item.category}</span></div>
                            <div class="days-left">${calculateDaysLeft(item.closing_date)} Days Left</div>
                        `;
                    } else if (endpoint.includes('companies')) {
                        tenderMeta.innerHTML = `<div><span>${item.name}</span></div>`;
                    } else if (endpoint.includes('categories')) {
                        tenderMeta.innerHTML = `<div><span>Category:</span><span>${item.name}</span></div>`;
                    } else if (endpoint.includes('sectors')) {
                        tenderMeta.innerHTML = `<div><span>Sector:</span><span>${item.name}</span></div>`;
                    }

                    const viewDetailsButton = document.createElement('button');
                    viewDetailsButton.classList.add('view-details');
                    viewDetailsButton.textContent = 'View Details';
                    viewDetailsButton.setAttribute('data-id', item.tenderID);
                    viewDetailsButton.addEventListener('click', async function() {
                        const tenderId = this.getAttribute('data-id');
                        showLoader();
                        openTenderDetails(tenderId, item.documents);
                    });

                    tenderItem.appendChild(tenderHeader);
                    tenderItem.appendChild(tenderMeta);
                    if (endpoint.includes('tenders')) {
                        tenderItem.appendChild(viewDetailsButton);
                    }
                    tendersContainer.appendChild(tenderItem);
                });

                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                paginationSelect.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = `Page ${i}`;
                    if (i === currentPage) {
                        option.selected = true;
                    }
                    paginationSelect.appendChild(option);
                }

                paginationSelect.addEventListener('change', function() {
                    currentPage = parseInt(this.value, 10);
                    fetchTenders(currentEndpoint, currentPage);
                });
            }

            function paginate(array, page, pageSize) {
                return array.slice((page - 1) * pageSize, page * pageSize);
            }

            function calculateDaysLeft(closingDate) {
                const today = new Date();
                const closing = new Date(closingDate);
                const timeDiff = closing - today;
                const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                return daysLeft;
            }

            function openTenderDetails(tenderId, documents) {
                const modalDetails = document.getElementById('modalDetails');
                let documentsHtml = '';

                if (documents && documents.length > 0) {
                    documentsHtml = '<ul>';
                    documents.forEach(doc => {
                        documentsHtml += `<li><a href="${doc}" class="document-link" target="_blank">${doc}</a></li>`;
                    });
                    documentsHtml += '</ul>';
                }

                modalDetails.innerHTML = `
                    <iframe src="description.php?id=${tenderId}" width="100%" height="600px" frameborder="0" style="background: #fff;"></iframe>
                    <h3>Tender Documents</h3>
                    ${documentsHtml}
                `;
                modal.style.display = 'block';
                hideLoader();
            }

            function showLoader() {
                loadingOverlay.style.display = 'flex';
            }

            function hideLoader() {
                loadingOverlay.style.display = 'none';
            }

            function showToast(message) {
                toast.innerHTML = `<div id="desc">${message}</div>`;
                toast.className = "show";
                setTimeout(function() {
                    toast.className = toast.className.replace("show", "");
                }, 3000);
            }

            // Set the "Valid Tenders" tab as active by default
            setActiveTab(tabs[0]);

            // Fetch tenders for the home page (Valid Tenders) when the page loads
            fetchTenders('valid_tenders.php');

            searchButton.addEventListener('click', function() {
                const query = searchInput.value.toLowerCase();
                searchTenders(query);
                showToast("Search results updated");
            });

            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const query = searchInput.value.toLowerCase();
                    searchTenders(query);
                    showToast("Search results updated");
                }
            });

            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    setActiveTab(tab);
                    const endpoint = tab.getAttribute('data-endpoint');
                    currentPage = 1; // Reset to the first page whenever a new category is selected
                    fetchTenders(endpoint, currentPage);
                });
            });
        });
    </script>
</body>
</html>
