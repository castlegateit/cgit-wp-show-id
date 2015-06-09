# Castlegate IT WP Show ID #

Castlegate IT WP Show ID adds an ID column to the tables of posts and pages in the WordPress admin panel. Only admin users will see the column. If the [Castlegate IT WP Admin Tweaks](https://github.com/castlegateit/cgit-wp-admin-tweaks) plugin is installed and an admin user whitelist has been defined, this plugin will respect that list. You will need to add filters and actions to show the ID column for custom post types:

    add_filter("manage_{$post_type}_columns", 'cgit_wp_show_id_register_column');
    add_filter("manage_edit-{$post_type}_sortable_columns", 'cgit_wp_show_id_register_column');
    add_action("manage_{$post_type}_custom_column", 'cgit_wp_show_id_column');
