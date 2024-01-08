# Show All Badges On One Page - Moodle Plugin

[WIP] DON'T INSTALL! [NEED HELP WITH INSTALL.XML](https://moodle.org/mod/forum/discuss.php?d=454153)

## Description

This is a Moodle local plugin designed to enhance the way badges are displayed within a Moodle site. This plugin allows users to see all available badges, including badge images, names, and descriptions, on a single responsive page. It adds functionality to differentiate between earned and unearned badges using color changes and opacity effects.

Furthermore, the plugin integrates a dashboard for tracking user progress towards badge achievement and displays badges in a responsive layout suitable for various devices.

Key functionalities include:
- Advanced filtering and sorting of badges using client-side JavaScript.
- Periodic updating of badge achievement data via a cron job.
- Compatibility tested with Moodle 4.3.

## Installation

To install the plugin, follow the standard Moodle plugin installation process:
1. Place the `showbadges` folder inside your Moodle `local` directory.
2. Log in to your Moodle site as an admin, open Notifications and Moodle will automatically run the installation.

## Technologies
- PHP
- Moodle
- HTML
- CSS3
- JavaScript
- MySQL
- cronjob

## Usage

After installation, users can access the badges display page via `YOURMOODLE/local/showbadges/index.php`. User badges and progress will be automatically fetched and displayed.

## Files and Directories

```
/local/showbadges
├── index.php                     # Main entry point for the plugin.
├── lib.php                       # Contains functions to fetch badges and user achievements.
├── version.php                   # Plugin version information.
├── db
│   ├── access.php                # Defines capabilities for the plugin.
│   ├── install.php               # Custom install steps.
│   └── install.xml               # Definition of the database structure.
├── lang
│   └── en
│       └── local_showbadges.php   # Language strings for the plugin.
├── scripts.js                    # Client-side interactions and filters.
├── styles.css                    # Styling for the badges display.
└── templates
    └── badges_display.mustache   # Mustache template for rendering badges.
```

## Development Notes

- Ensure all new features adhere to Moodle coding guidelines.
- Test the plugin on various device sizes and browsers to confirm responsiveness and compatibility.
- When modifying database interactions, ensure backward compatibility.

## Contributions

Contributions to the `moodle-local_showbadges` plugin are welcome. Please ensure that your pull requests follow Moodle's coding standards and best practices for maintainability.

## License

The `moodle-local_showbadges` plugin is open-source software licensed under the [GNU GPL v3](http://www.gnu.org/licenses/gpl-3.0.en.html).

## Support

Please report issues via the Moodle tracker under the `local_showbadges` component.

This document will be periodically updated to reflect new changes or addition to the plugin's features and functionalities.
