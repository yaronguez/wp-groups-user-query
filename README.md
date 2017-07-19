# Groups User Query

Contributors: yaronguez  
Tags: posts-to-posts  
Tested up to: 4.8  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

Extends [WP_User_Query](https://codex.wordpress.org/Class_Reference/WP_User_Query) to allow filtering by Group IDs from the Groups plugin


## Description

Upon activating this plugin, just add a `group_ids` argument to WP User Query constructor and specify an array of group IDs to filter by: 

```php
// Fetch administrators within group 4 or 6
$query = new WP_Query(array(
    'role' => 'Administrator',
    'group_ids' => [4,6]
));
```

Simple!


## Changelog

= 1.0 =
* Initial version
