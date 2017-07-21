<?php

namespace Cgit\ShowPostId;

class Columnizer
{
    /**
     * Unique identifier for the post ID column
     *
     * @var string
     */
    private $columnId = 'post_id';

    /**
     * Post types that will display an column ID
     *
     * @var array
     */
    private $types = ['page', 'post'];

    /**
     * Constructor
     *
     * Allow the list of post types to be altered using a WordPress filter,
     * register and display the columns, and insert the column styles.
     *
     * @return void
     */
    public function __construct()
    {
        $this->types = apply_filters('cgit_show_id_post_types', $this->types);
        $this->registerColumnsByType();
        add_action('admin_head', [$this, 'insertColumnStyles']);
    }

    /**
     * Register columns for each post type
     *
     * @return void
     */
    private function registerColumnsByType()
    {
        foreach ($this->types as $type) {
            // Add the column
            add_filter('manage_' . $type . 's_columns',
                [$this, 'appendColumn']);

            // Make the column sortable
            add_filter('manage_edit-' . $type . '_sortable_columns',
                [$this, 'appendColumn']);

            // Add post IDs to the column
            add_action('manage_' . $type . 's_custom_column',
                [$this, 'showId']);
        }
    }

    /**
     * Register an ID column by appending it to an array
     *
     * @param array $columns
     * @return array
     */
    public function appendColumn($columns)
    {
        if ($this->isAdmin()) {
            $columns[$this->columnId] = 'ID';
        }

        return $columns;
    }

    /**
     * Show post ID
     *
     * @param string $name
     * @return string
     */
    public function showId($name)
    {
        global $post;

        if ($name == $this->columnId) {
            echo $post->ID;
        }
    }

    /**
     * Insert CSS for the custom table column
     *
     * @return void
     */
    public function insertColumnStyles()
    {
        ?>
        <style>
            .column-<?= $this->columnId ?> {
                width: 5%;
            }
        </style>
        <?php
    }

    /**
     * Is the current user an administrator?
     *
     * By default, checks the current user capabilities to determine whether
     * they are an administrator. The capability checked, and the boolean
     * result, can be modified using WordPress filters.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        $cap = apply_filters('cgit_show_id_admin_cap', 'manage_options');
        $admin = apply_filters('cgit_show_id_admin', current_user_can($cap));

        return $admin;
    }
}
