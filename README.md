# Moodle Local Plugin: Show Badges

The `moodle-local_showbadges` plugin is designed to enhance the Moodle learning management system by displaying all available Moodle badges, as well as user-specific badge progress within a single, responsive interface.

## Features

- Display of all available Moodle badges with images, names, and descriptions.
- Visual differentiation between earned and unearned badges.
- A user dashboard to track progress toward badge completion.
- A responsive layout to accommodate various devices.
- Advanced filter and sorting functionality.
- Compatibility with Moodle version 4.3.
- Built with PHP, HTML, CSS3, JavaScript, MySQL and utilizes cron jobs for periodic updates.

## Installation

1. Copy the plugin files to `/your/moodle/path/local/showbadges`.
2. Log in to your Moodle site as an admin and visit the notifications page to complete the plugin installation.

## Usage

Once installed, the plugin will display a new page within Moodle where users can view and filter all badges. Users can see their earned badges highlighted, and their progress towards unearned badges.

## Development and Contribution

The following is a list of files included in the project with their respective roles:

- `index.php`: The main entry point for the plugin that renders the badge display page.
- `lib.php`: Placeholder for callback functions and additional library functions.
- `version.php`: Contains versioning information for the plugin.
- `lang/en/local_showbadges.php`: Language strings for the plugin.
- `db/install.php`: Sets up the database schema upon installation.
- `db/install.xml`: XML database schema definition.
- `db/upgrade.php`: Manages database schema upgrades.
- `classes/badge_fetcher.php`: Contains logic for fetching badge information.
- `styles.css`: Defines the styling for the badge display.
- `sortfilter.js`: Provides client-side filtering and sorting capabilities.

Participation in the development of `moodle-local_showbadges` is encouraged. Developers are advised to follow Moodle's coding guidelines and submit pull requests for any proposed changes.

## Testing

Use `testbadgefetcher.php` to test the badge fetching functionality independently.

## License

The `moodle-local_showbadges` plugin is open-sourced software licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).

---

## Project Status
As of the latest update, this plugin is in a stable state and is ready for deployment to a Moodle instance. Developers are currently focused on refining the user interface and improving performance with future updates focusing on additional functionalities and enhancements based on user feedback.

**Note:** For detailed installation instructions, usage guides, and API references, please refer to the project's wiki or documentation pages, as this README provides only a high-level overview.