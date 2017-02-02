<?php
/*
Plugin Name: Editors Capability Upgrades
Description: Allow editors to manage users, menus, and forms
Author: James Carmichael
Version: 1.0
*/

// On plugin activate, add user capabilities
register_activation_hook( __FILE__, 'umfed_activation' );
function umfed_activation()
{
    foreach( array('editor') as $r )
    {
        $role = get_role( $r );
        if( $role ){
            $role->add_cap( 'create_users' );
            $role->add_cap( 'edit_users' );
            $role->add_cap( 'delete_users' );
            $role->add_cap( 'list_users' );
            $role->add_cap( 'promote_users' );
            $role->add_cap( 'edit_theme_options' );
        }
    }
}


// On plugin deactivate, remove user capabilities
register_deactivation_hook( __FILE__, 'umfed_deactivation' );
function umfed_deactivation()
{
    foreach( array( 'editor') as $r )
    {
        $role = get_role( $r );
        if( $role ){
            $role->remove_cap( 'create_users' );
            $role->remove_cap( 'edit_users' );
            $role->remove_cap( 'delete_users' );
            $role->remove_cap( 'list_users' );
            $role->remove_cap( 'promote_users' );
            $role->remove_cap( 'edit_theme_options' );
        }
    }
}


// Filter roles available to editor when adding a user
add_filter( 'editable_roles', 'umfed_filter_roles' );
function umfed_filter_roles( $roles )
{
    $user = wp_get_current_user();
    if( in_array( 'editor', $user->roles ) )
    {
        $tmp = array_keys( $roles );
        foreach( $tmp as $r )
        {
            if( 'administrator' != $r ) continue;
            unset( $roles[$r] );
        }
    }
    return $roles;
}


// Hide admins from user list (for editors only)
add_action( 'pre_user_query', 'umfed_pre_user_query' );
function umfed_pre_user_query( $user_search )
{
    global $wpdb;
    $user = wp_get_current_user();
    $user->get_role_caps();
    $where = 'WHERE 1=1';

    // Temporarily remove this hook otherwise we might be stuck in an infinite loop
    remove_action( 'pre_user_query', 'umfed_pre_user_query' );

    // If current user can't manage options (is not an admin), hide admins from user list
    if ( ! current_user_can('manage_options') ){
        // Get the list of admin IDs
        $args = array(
            'role' => 'Administrator',
        );
        $user_query = new WP_User_Query( $args );
        $admins = $user_query->get_results();

        $admin_ids = array();
        foreach ( $admins as $admin ) {
            $admin_ids[] = $admin->ID;
        }

        $where .= ' AND '.$wpdb->users.'.ID NOT IN ('.implode(',', $admin_ids).')';
    }

    // Modify original WP_User_Query
    $user_search->query_where = str_replace(
        'WHERE 1=1',
        $where,
        $user_search->query_where
    );

    // Re-add the hook
    add_action( 'pre_user_query', 'umfed_pre_user_query' );
}