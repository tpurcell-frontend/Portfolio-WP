# React-based To-Do List Gutenberg Block Plugin

## Overview
I've aggregated each example into this plugin for reviewing convenience:
- PHP in the context of WordPress, ideally a plugin: **wp-content/plugins/todo-list/todo-list.php**
- Gutenberg block(s): **wp-content/plugins/todo-list/patterns**
- JavaScript in the context of WordPress (nice to have): **wp-content/plugins/todo-list/blocks/todo-block/index.js** & **wp-content/plugins/todo-list/src/App.jsx**

## What it is
This plugin creates a **React-based Gutenberg block** under the **Widgets** block category.

## What it does
- Renders a **dynamic To-Do list** with stored values.
- Brings the power of **React development** into the user-friendly WordPress editor.

## What to look for
- React components and JSX markup live in the `src/` directory.
- Code is compiled into the `build/` directory using:
  - `@wordpress/scripts`
  - `@wordpress/components`
  - `@wordpress/element`
- The compiled JavaScript is **Gutenberg-compatible** and renders your block dynamically on the front-end.

## Notes
- The block is registered in PHP with `register_block_type()`.
- The front-end React app mounts to a `<div id="todo-list-root">` rendered by the block’s `render_callback`.
