document.addEventListener('DOMContentLoaded', function() {
    loadDashboard();
});

function loadDashboard() {
    fetch('local/showbadges/fetch_dashboard.php')
    .then(response => response.json())
    .then(data => {
        displayProgress(data.progress);
        displayRecentBadges(data.recent_badges);
    })
    .catch(error => {
        console.error('Error fetching dashboard data:', error);
    });
}

function displayProgress(progressData) {
    const progressContainer = document.createElement('div');
    progressContainer.classList.add('progress-container');

    progressData.forEach(progress => {
        const progressElement = document.createElement('div');
        progressElement.classList.add('badge-progress');
        progressElement.innerHTML = `
            <div class="badge-image"><img src="${progress.imageurl}" alt="${progress.name}"></div>
            <div class="badge-name">${progress.name}</div>
            <div class="badge-progress-percentage">${progress.progress}%</div>
        `;
        progressContainer.appendChild(progressElement);
    });

    document.body.appendChild(progressContainer);
}

function displayRecentBadges(recentBadges) {
    const recentBadgesContainer = document.createElement('div');
    recentBadgesContainer.classList.add('recent-badges-container');

    recentBadges.forEach(badge => {
        const badgeElement = document.createElement('div');
        badgeElement.classList.add('badge-recent');
        badgeElement.innerHTML = `
            <div class="badge-image"><img src="${badge.imageurl}" alt="${badge.name}"></div>
            <div class="badge-name">${badge.name}</div>
            <div class="badge-issued-date">${new Date(badge.dateissued * 1000).toLocaleDateString()}</div>
        `;
        recentBadgesContainer.appendChild(badgeElement);
    });

    document.body.appendChild(recentBadgesContainer);
}
