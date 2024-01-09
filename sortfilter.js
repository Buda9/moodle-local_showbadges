document.addEventListener('DOMContentLoaded', function() {
    const badgeContainer = document.getElementById('badge-container');
    const searchInput = document.getElementById('badge-search');

    searchInput.addEventListener('input', function(event) {
        filterBadges(event.target.value);
    });
});

function filterBadges(searchTerm) {
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        const name = badge.querySelector('.badge-name').textContent.toLowerCase();
        if (name.includes(searchTerm.toLowerCase())) {
            badge.style.display = '';
        } else {
            badge.style.display = 'none';
        }
    });
}

function sortBadges(sortKey) {
    let badges = Array.from(document.querySelectorAll('.badge'));
    badges = badges.sort((a, b) => {
        let valA, valB;
        if (sortKey === 'name') {
            valA = a.querySelector('.badge-name').textContent;
            valB = b.querySelector('.badge-name').textContent;
        } else if (sortKey === 'date') {
            valA = a.dataset.dateissued || '0';
            valB = b.dataset.dateissued || '0';
        }
        return valA.localeCompare(valB, navigator.languages[0] || navigator.language, {numeric: true});
    });

    // Empty the container and append sorted elements
    badgeContainer.innerHTML = '';
    badges.forEach(badge => badgeContainer.appendChild(badge));
}