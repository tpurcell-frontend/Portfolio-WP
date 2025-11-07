const { registerBlockType } = wp.blocks;
const { createElement: el } = wp.element;

registerBlockType('todo-list/todo', {
    title: 'To-Do List',
    icon: 'list-view',
    category: 'widgets',
    edit: () => el('p', null, 'To-Do List (renders on front-end)'),
    save: () => null // Front-end will render React
});
