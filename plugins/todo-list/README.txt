# React To-Do List Gutenberg Block

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
- The front-end React app mounts to a `<div>` rendered by the block’s `render_callback`.
