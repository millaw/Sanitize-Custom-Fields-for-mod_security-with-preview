# Sanitize Custom Fields for mod_security

## Description
This WordPress plugin prevents `mod_security` from blocking HTTP POST requests containing `<style>` and `<script>` tags in custom fields. It replaces these tags with placeholders before saving and restores them when displaying or previewing content.

## Features
- ✅ **Automatically applies to all custom fields**
- ✅ **Prevents mod_security from blocking form submissions**
- ✅ **Ensures correct rendering of `<style>` and `<script>` tags when displaying posts**
- ✅ **Supports live preview of changes before saving a post**
- ✅ **No settings required – works out of the box**

## Installation
1. Download the plugin ZIP file or clone the repository.
2. Upload the plugin folder to `wp-content/plugins/`.
3. Activate the plugin from the WordPress **Plugins** menu.

## How It Works
1. **On Save**: The plugin replaces `<style>` and `<script>` tags with placeholders (`[STYLE-OPEN]`, `[STYLE-CLOSE]`, etc.) before saving the custom field data.
2. **On Display**: When retrieving data, the placeholders are converted back to real `<style>` and `<script>` tags.
3. **On Preview**: If the post is in preview mode, the placeholders are dynamically replaced so the content renders correctly.

## Example
### Before Saving:
```html
<style>body { background: red; }</style>
```

### Saved in Database:
```html
[STYLE-OPEN]body { background: red; }[STYLE-CLOSE]
```

### Displayed on the Page:
```html
<style>body { background: red; }</style>
```

## Compatibility
- Tested with **WordPress 6.x**
- Works with **Gutenberg** and **Classic Editor**
- No conflicts with other meta field plugins

## License
This plugin is licensed under the **MIT License**. Feel free to modify and contribute!

## Contribution
Pull requests are welcome! If you encounter any issues, please open an issue on GitHub.

## Author
Your Name – [Your GitHub Profile](https://github.com/millaw)

---

🚀 **Enjoy a mod_security-friendly WordPress experience!**

