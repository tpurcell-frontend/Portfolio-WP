# React-based To-Do List Gutenberg Block Plugin

## Overview
I've aggregated each example into this plugin for reviewing convenience:
- PHP in the context of WordPress, ideally a plugin: 
  - `wp-content/plugins/todo-list/todo-list.php`
    - Enqueue styles, scripts and blocks, including registering the To-Do list block for the frontend, with the function **register_block_type()**. 
- Gutenberg block(s): 
  - `wp-content/plugins/todo-list/patterns`
    - Registers the **intro section** and **summary section** patterns.
- JavaScript in the context of WordPress (nice to have): 
  - `wp-content/plugins/todo-list/blocks/todo-block/index.js`
    - Register the To-Do List block into the editor UI with the function **registerBlockType()**.
  - `wp-content/plugins/todo-list/src/App.jsx`
    - To-Do List markup & Add, Delete and localStorage functions:

## What it is
This plugin creates a **React-based Gutenberg block** under the **Widgets** block category in the WordPress editor.

## What it does
- Renders a **dynamic To-Do list** where users can add and delete tasks.
- Uses localStorage to save tasks without using the database for demonstration purposes.
  - A production-ready version would write the tasks into the database per user.
- Brings the power of **React development** into the user-friendly WordPress editor. The component styles are mirrored in the editor and on the frontend.

## What to look for
- React components and JSX markup live in the `src/` directory of this plugin.
- Code is compiled into the `build/` directory using:
  - `@wordpress/scripts`
  - `@wordpress/components`
  - `@wordpress/element`
- The compiled JavaScript is **Gutenberg-compatible** and renders your block dynamically on the front-end.

## Notes
- The front-end React app mounts to a `<div id="todo-list-root">` rendered by the block’s `render_callback`.
