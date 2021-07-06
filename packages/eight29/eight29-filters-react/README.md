# NPM Commands

### Installation & Set Up
```
npm install
```

### Watch & compile css/js
```
npm run start
```

### Compile and minify assets for production
```
npm run build:production
```

### Compile for production and export into zip file
```
npm run zip
```

# Filter Data

You must pass down the post types, taxonomies, and filters you'd like to use into the plugin as an associative array. By default the plugin works with the "post" post type, "category" taxonomy, and uses the select filter. Below is how the default data is formatted and you can use this as a base to customize or add in more data.

Each post type (slug) is an array that contains an array of the taxonomies expected. Each taxonomy (slug) is rendered on the page as a filter. The type of filter is determined by the "type" parameter in the array.

```
<?php
$eight29_filter_data = [
  "post" => [
    "category" => [
      "label" => "Categories", 
      "type" => "select" 
    ]
  ]
]
?>
```

To pass the data into the plugin call the set_post_data() method in the functions.php section of your theme as follows:

```
<?php
if (class_exists('eight29_filters')) {
  $eight29_filters->set_post_data($eight29_filter_data);
}
?>
```

### Filter Types

The "type" attribute accepts the following options:

- button-group
- checkbox
- accordion-multi-select
- accordion-single-select
- select
- search

Some support for non taxonomy post data has been added

Post Dates
```
<?php
$eight29_filter_data = [
  "post" => [
    "date" => [
      "label" => "Insert Label Here", 
      "type" => "select", 
    ]
  ]
]
?>
```

Post Authors
```
<?php
$eight29_filter_data = [
  "post" => [
    "author" => [
      "label" => "Insert Label Here", 
      "type" => "select", 
    ]
  ]
]
?>
```

# Customizing, Adding New Filters & Post Components

By default the plugin enqueues and loads the compiled JS for React components and Sass from the dist folder (domain.com/wp-content/plugins/eight29-filters-react/dist)

To customize the components or add your own make a new directory in the root of your theme called "eight29-filters" (domain.com/wp-content/themes/your-theme/eight29-filters) and copy the package.json file, src directory, and dist directory into the eight29-filters directory in your theme.

### Filter Components

Each filter is a component located in the components/filters directory. Filters should follow the "FilterType" naming convention. Filters are imported into the "Sidebar" component and are dynamically selected from the components object. 

To add new filters add your filter to the component object and be sure to import into the sidebar by the handle you give it.

```javascript
const components = {
  'checkbox': FilterCheckbox,
  'select' : FilterSelect,
  'button-group' : FilterButtonGroup,
  'accordion-multi-select' : FilterAccordionMultiSelect,
  'accordion-single-select' : FilterAccordionSingleSelect
}
```

Filters use two methods to update the "selected" state:

- **replaceSelected** - This accepts two arguments (id, taxSlug) and will **replace** all selected ids in the array with the id being passed in for that particular term.  
- **toggleSelected** - This also accepts two arguments (id, taxSlug) and will **add** to the array of selected ids with the id being passed in that for that particular term. If the id being passed in is already in the selected array it will remove it.

### Filter Component Attributes
- **collapsible** - Places the component inside of an accordion style collapsible element
- **dropdown** - Places the component inside of a faux scrollable dropdown container (useful for creating custom select/checkbox menus)

PHP
```
<?php
$eight29_filter_data = [
  "post" => [
    "category" => [
      "label" => "Categories", 
      "type" => "accordion-multi-select", 
      "collapsible" => true,
      "dropdown" => true
    ]
  ]
]
?>
```

JSX
```
<FilterAccordionMultiSelect
  label={filters.category.label}
  taxonomy={filters.category.terms}
  taxSlug={'category'}
  selected={selected}
  collapsible={true}
  dropdown={true}
></FilterAccordionMultiSelect>
```
### Post Components

Each post type is a component located in the components/posts directory. Post types are imported into the "Posts" component. By default every post type you add into your plugin data array uses the "Post" component. 

To add in your own post type components add your new custom components into the "components" object. Be sure to import your new components into the posts component by the handle you give it.

```javascript
const components = {
  'post': Post,
  'custom_post_type': CustomPostType 
};
```

### Custom Layouts

By default the plugin uses the "LayoutDefault.js" file in the layouts folder. To create your own custom layouts you can duplicate this file using the same naming scheme "LayoutCustomName.js". (You will need some basic knowledge of React.) You will need to import the layout into App.js and add it to the layouts object in this file.

```javascript
const layouts = {
    'default': LayoutDefault,
    'blog_A': LayoutBlogA,
    'blog_B': LayoutBlogB,
    'blog_C': LayoutBlogC,
    'blog_D': LayoutBlogD,
    'staff': LayoutStaff,
    'custom_name': LayoutCustomName
}
```

To use the layout specify it in your shortcode as follows:

```
[eight29_filters layout="layout_custom_name" post_type="post"]
```

# Endpoints

The plugin uses the following endpoints to gather data:

- domain.com/wp-json/eight29/v1/filters/<post_type> - Outputs an object of each taxonomy and it's children for the requested post type from filter data
- domain.com/wp-json/eight29/v1/post_types - Outputs an array of all post types from filter data
- domain.com/wp-json/wp/v2/<post_type> - Outputs an object of posts for the requested post type

# Shortcode

To render the posts and filters use the following shortcode in your theme or WYSIWYG editor:

```
[eight29_filters]
```

### Shortcode Attributes

The shortcode includes the following attributes:

- **post_type** - Post type slug (Default is "post")
- **posts_per_row** - Number of posts per row (Default is 3)
- **taxonomy** - Choose a taxonomy to pre filter
- **term_id** - Choose a taxonomy term to pre filter from the selected taxonomy
- **exclude_posts** - Exclude post(s) ids from displaying. Separate by comma for more than one.
- **tax_relation** - Choose to have filters use "AND or "OR" relation (Default is "AND") 
- **remember_filters** - Choose to have allow filter selections to persist after page refresh (uses localStorage)
- **order_by** - Choose what order posts display as (Default is "date").
    - Accepted values: date, abc, xyz 
- **mobile_style** - Choose to have filters scroll horizontally, open in a modal, or stack vertically (Default).
    - Accepted values: scroll, modal
- **display_sidebar** - Choose to display the sidebar and it's position (Default is "left").
    - Accepted values: left, right, bottom, top, false
- **display_author** - Choose to display the author's name with the post (Default is "true").
    - Accepted values: true, false
- **display_excerpt** - Choose to display the post excerpt along with the post (Default is "false").
    - Accepted values: true, false
- **display_date** - Choose to display the post date with the post (Default is "false").
    - Accepted values: true, false
- **display_categories** - Choose to display categories/taxonomies that each post has (Default is "true").
    - Accepted values: true, false
- **display_post_counts** - Choose to display the post counts for each taxonomy term in the sidebar (Default is "false").
    - Accepted values: true, false
- **display_results** - Choose to display the total number of available posts in the sidebar (Default is "false").
    - Accepted values: true, false
- **display_reset** - Choose to display a button to reset filters (Default is "false").
    - Accepted values: true, false
- **display_search** - Choose to display a search input in the sidebar (Default is "false").
    - Accepted values: true, false
- **display_sort** - Choose to display a select input with sort options for posts (Default is "false").
    - Accepted values: true, false
- **pagination_style** - Choose to display pagination as a traditional style with page numbers or use a "load more" button
    - Accepted values: pagination, more