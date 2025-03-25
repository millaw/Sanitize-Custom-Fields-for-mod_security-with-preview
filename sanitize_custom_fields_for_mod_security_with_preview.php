<?php
/**
 * Plugin Name: Sanitize Custom Fields for mod_security
 * Plugin URI:  https://github.com/millaw
 * Description: Prevents mod_security from blocking custom fields with <style> and <script> by replacing them with placeholders.
 * Version:     1.1.0
 * Author:      Milla Wynn
 * License:     MIT
 */

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Replace <style> and <script> tags with placeholders before saving custom fields
 */
function sanitize_custom_fields_before_save($meta_id, $post_id, $meta_key, $meta_value) {
    if (!is_string($meta_value)) {
        return;
    }

    $sanitized_value = str_replace(
        ['<style>', '</style>', '<script>', '</script>'],
        ['[STYLE-OPEN]', '[STYLE-CLOSE]', '[SCRIPT-OPEN]', '[SCRIPT-CLOSE]'],
        $meta_value
    );
    
    // Update with sanitized content
    update_post_meta($post_id, $meta_key, $sanitized_value);
}
add_action('updated_post_meta', 'sanitize_custom_fields_before_save', 10, 4);
add_action('added_post_meta', 'sanitize_custom_fields_before_save', 10, 4);

/**
 * Convert placeholders back to real HTML tags when displaying custom fields
 */
function restore_custom_fields_display($value, $post_id, $meta_key, $single) {
    if (!is_string($value)) {
        return $value;
    }

    return str_replace(
        ['[STYLE-OPEN]', '[STYLE-CLOSE]', '[SCRIPT-OPEN]', '[SCRIPT-CLOSE]'],
        ['<style>', '</style>', '<script>', '</script>'],
        $value
    );
}
add_filter('get_post_metadata', 'restore_custom_fields_display', 10, 4);

/**
 * Ensure correct rendering of <style> and <script> tags during post previews
 */
function restore_custom_fields_in_preview($post) {
    if (is_preview() && isset($post->ID)) {
        $custom_fields = get_post_meta($post->ID);
        foreach ($custom_fields as $key => $values) {
            if (is_array($values)) {
                foreach ($values as &$value) {
                    $value = str_replace(
                        ['[STYLE-OPEN]', '[STYLE-CLOSE]', '[SCRIPT-OPEN]', '[SCRIPT-CLOSE]'],
                        ['<style>', '</style>', '<script>', '</script>'],
                        $value
                    );
                }
            }
        }
    }
    return $post;
}
add_filter('the_post', 'restore_custom_fields_in_preview');

?>
