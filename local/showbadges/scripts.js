document.addEventListener('DOMContentLoaded', function() {
    const badgesContainer = document.getElementById('badges-container');
    const filterInput = document.getElementById('badge-filter');
    const sortSelect = document.getElementById('badge-sort');

    function filterBadges() {
        const searchTerm = filterInput.value.toLowerCase();
        const badges = badgesContainer.getElementsByClassName('badge-item');

        for (const badge of badges) {
            const name = badge.querySelector('.badge-name').textContent.toLowerCase();
            const description = badge.querySelector('.badge-description').textContent.toLowerCase();
            const isVisible = name.includes(searchTerm) || description.includes(searchTerm);
            badge.style.display = isVisible ? 'block' : 'none';
        }
    }

    function sortBadges(by) {
        const items = Array.from(badgesContainer.getElementsByClassName('badge-item'));
        const sortedItems = items.sort(function(a, b) {
            const contentA = a.querySelector(by).textContent.trim();
            const contentB = b.querySelector(by).textContent.trim();
            return contentA.localeCompare(contentB);
        });

        sortedItems.forEach(item => badgesContainer.appendChild(item));
    }

    filterInput.addEventListener('input', filterBadges);

    sortSelect.addEventListener('change', function() {
        const sortBy = this.value;
        sortBadges(sortBy === 'name' ? '.badge-name' : '.badge-description');
    });

    // Initialize the filter and sort operations
    filterBadges();
    sortBadges('.badge-name'); // Default sort by name
    document.addEventListener('keydown', function(event) {
        // INPUT_REQUIRED {Ensure appropriate keyboard events are handled for custom controls}
        if (event.key === 'Enter') {
            const target = event.target;
            if (target.tagName.toLowerCase() === 'button' || target.classList.contains('custom-control')) {
                target.click();
            }
        }
    });
});