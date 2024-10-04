<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header .search-button {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .tabs {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            background-color: #ddd;
            border-radius: 5px;
            margin-right: 5px;
        }
        .tab:last-child {
            margin-right: 0;
        }
        .tab.active {
            background-color: #333;
            color: white;
        }
        .filter-results-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .filter-results {
            background-color: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
        .tender {
            background-color: white;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .tender h2 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }
        .tender .details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .tender .details .icon {
            font-size: 14px;
            color: #666;
            margin-right: 5px;
        }
        .tender .details .location {
            font-size: 14px;
            color: #666;
        }
        .tender .details .view-details {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
        .tender .date-info {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
        }
        .tender .date-info .icon {
            margin-right: 5px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab');
            const tendersContainer = document.querySelector('.tender-list');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    fetchTenders(this.textContent.trim().toLowerCase());
                });
            });

            function fetchTenders(type) {
                let url = '';
                if (type === 'latest tenders') {
                    url = '/api/tenders/latest';
                } else if (type === 'my tenders') {
                    url = '/api/tenders/my';
                }

                fetch(url)
                    .then(response => response.json())
                    .then(tenders => {
                        console.log('Fetched tenders:', tenders); // Debug log
                        renderTenders(tenders);
                    })
                    .catch(error => {
                        console.error('Error fetching tenders:', error);
                    });
            }

            function renderTenders(tenders) {
                tendersContainer.innerHTML = '';
                tenders.forEach(tender => {
                    const tenderElement = document.createElement('div');
                    tenderElement.className = 'tender';
                    tenderElement.innerHTML = `
                        <h2>${tender.title}</h2>
                        <div class="details">
                            <div class="location">
                                <span class="icon">📍</span>
                                ${tender.location}
                            </div>
                            <a href="#" class="view-details">View Details</a>
                        </div>
                        <div class="date-info">
                            <span class="icon">🕒</span>
                            Posted on: ${tender.posted_on}
                        </div>
                        <div class="date-info">
                            <span class="icon">📅</span>
                            Apply by: ${tender.apply_by}
                        </div>
                    `;
                    tendersContainer.appendChild(tenderElement);
                });
            }

            // Fetch and display latest tenders by default
            fetchTenders('latest tenders');
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tenders</h1>
            <button class="search-button">🔍</button>
        </div>
        <div class="tabs">
            <div class="tab active">Latest Tenders</div>
            <div class="tab">My Tenders</div>
        </div>
        <div class="filter-results-container">
            <a href="#" class="filter-results">Filter results</a>
        </div>
        <div class="tender-list">
            <!-- Tenders will be dynamically injected here -->
        </div>
    </div>
</body>
</html>
