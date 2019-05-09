# Castlegate IT WP Show ID #

Castlegate IT WP Show ID adds an ID column to the tables of posts and pages in the WordPress admin panel. Only admin users will see the column. If the [Castlegate IT WP Admin Tweaks](https://github.com/castlegateit/cgit-wp-admin-tweaks) plugin is installed and an admin user whitelist has been defined, this plugin will respect that list. You will need to add filters and actions to show the ID column for custom post types:

    add_filter("manage_{$post_type}_columns", 'cgit_wp_show_id_register_column');
    add_filter("manage_edit-{$post_type}_sortable_columns", 'cgit_wp_show_id_register_column');
    add_action("manage_{$post_type}_custom_column", 'cgit_wp_show_id_column');

## License

Copyright (c) 2019 Castlegate IT. All rights reserved.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
