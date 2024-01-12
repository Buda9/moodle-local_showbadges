# Moodle Local Plugin: Show/Display All Badges

The `local_showbadges` plugin is designed to enhance the Moodle LMS by displaying all available Moodle badges, as well as earned badge, in a single, responsive page.

![Screenshot_10](https://github.com/Buda9/moodle-local_showbadges/assets/1422662/fd95be4f-95a5-432e-8daf-fb6579285578)

## Features

- Display of all available Moodle badges with images, names, and descriptions
- Visual differentiation between earned and unearned badges
- Responsive layout
- Compatibility with Moodle 4.x (not tested with earlier versions)
- Built with PHP, HTML, CSS3, JavaScript, MySQL and utilizes cron jobs for periodic updates

## TODO:
- [ ] Advanced filter and sorting functionality
- [ ] A user dashboard to track progress toward badge completion

## Installation

1. Copy the plugin files to `/your/moodle/path/local/showbadges`.
2. Log in to your Moodle site as an admin and visit the notifications page to complete the plugin installation.

## Usage

Once installed, visit `/local/showbadges/` where your users can view all available badges on Moodle, including earned ones. Earned badges will be highlighted with green border.

## Development and Contribution

The following is a list of files included in the project with their respective roles:

- `index.php`: The main entry point for the plugin that renders the badge display page.
- `lib.php`: Placeholder for callback functions and additional library functions.
- `version.php`: Contains versioning information for the plugin.
- `db/install.php`: Sets up the database schema upon installation.
- `db/install.xml`: XML database schema definition.
- `db/upgrade.php`: Manages database schema upgrades.
- `classes/badge_fetcher.php`: Contains logic for fetching badge information.
- `styles.css`: Defines the styling for the badge display.

## License

The `moodle-local_showbadges` plugin is open-sourced software licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).

---

## Project Status
As of the latest update, this plugin is in a stable state and is ready for deployment to a Moodle instance. Developers are currently focused on refining the user interface and improving performance with future updates focusing on additional functionalities and enhancements based on user feedback.

# PR's are welcome!

---

**Note:** For detailed installation instructions, usage guides, and API references, please refer to the project's wiki or documentation pages, as this README provides only a high-level overview.
