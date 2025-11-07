const { createElement: el, useState } = wp.element;
const { Button, TextControl } = wp.components;

function TodoApp() {
    const [tasks, setTasks] = useState([]);
    const [newTask, setNewTask] = useState('');

    // Add a new task
    const addTask = function() {
        const trimmed = newTask.trim();
        if (!trimmed) return;
        setTasks(tasks.concat({ text: trimmed, done: false }));
        setNewTask('');
    };

    // Toggle a task's completion
    const toggleTask = function(index) {
        const updated = tasks.slice();
        updated[index].done = !updated[index].done;
        setTasks(updated);
    };

    // Remove a task
    const removeTask = function(index) {
        setTasks(tasks.filter(function(_, i) {
            return i !== index;
        }));
    };

    return el(
        'div',
        { className: 'container' },

        el(
            'div',
            { className: 'row' },
                
            el(
                'div',
                { className: 'col-12 col-md-8' },
                
                el(
                    'div',
                    { className: 'todo-app' },
                    
                    // Title
                    el('h2', null, 'What do I have to do?'),

                    // Input and Add button
                    el(
                        'div',
                        { className: 'todo-input-wrapper' },
                        el(TextControl, {
                            value: newTask,
                            onChange: setNewTask,
                            placeholder: 'Add a new task...'
                        }),
                        el(
                            Button,
                            { isPrimary: true, onClick: addTask, style: { marginLeft: '8px' } },
                            'Add Task'
                        )
                    ),

                    // Task list
                    el(
                        'ul',
                        { className: 'todo-list' },
                        tasks.map(function(task, i) {
                            return el(
                                'li',
                                {
                                    key: i,
                                    style: {
                                        textDecoration: task.done ? 'line-through' : 'none',
                                        display: 'flex',
                                        justifyContent: 'space-between',
                                        alignItems: 'center',
                                        marginBottom: '4px'
                                    }
                                },
                                el(
                                    'span',
                                    { onClick: function() { toggleTask(i); }, style: { cursor: 'pointer' } },
                                    task.text
                                ),
                                el(
                                    Button,
                                    { isDestructive: true, onClick: function() { removeTask(i); } },
                                    'Delete'
                                )
                            );
                        })
                    )
                ),
            ),
        ),
    );
}

// Mount React app after DOM is ready
wp.domReady(function() {
    const root = document.getElementById('todo-list-root');
    if (root) {
        wp.element.render(el(TodoApp), root);
    }
});
