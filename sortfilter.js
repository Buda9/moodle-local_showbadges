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

    badgeContainer.innerHTML = '';
    badges.forEach(badge => badgeContainer.appendChild(badge));